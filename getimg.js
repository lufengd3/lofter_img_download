var http = require('http')
var fs = require('fs');
var parse = require('url').parse

var counter = 1;
var dateObj = new Date();
var start = dateObj.getTime();

console.log(start);

for (var i = 1; i < 30; i += 1) {
	console.log("page " + i);
	getFile(i);
}

function getFile(page) {
	var options = {
		hostname: 'wanimal.lofter.com',
		path: '/?page=' + page,
		method: 'GET'
	};

	var req = http.request(options, function(res) {
		var chunks = [], length = 0;
		res.on('data', function(chunk) {
			length += chunk.length;
			chunks.push(chunk);
		});
		res.on('end', function() {
			var data = new Buffer(length), pos = 0
			, l = chunks.length;
			for(var i = 0; i < l; i++) {
				chunks[i].copy(data, pos);
				pos += chunks[i].length;
			}
			res.body = data.toString();
			getImgUrl(res.body);
		});
		res.on('error', function(err) {
        	console.log('Res Error: ' + err);
        });
	});

	req.end();
}

function getImgUrl(html) {
	var pattern = /<img src="(.*?)" .*\/>/g;
	var result = '';
	while(result = pattern.exec(html)) {
		saveImg(result[1]);
	};
}

function saveImg(url) {
	var savefile = './images/' + counter + '.jpg';
	var urlinfo = parse(url);
    var options = {
        method: 'GET',
        host: urlinfo.host,
        path: urlinfo.pathname
    };
    
    if(urlinfo.search) {
        options.path += urlinfo.search;
    }

    var req = http.request(options, function(res) {
        var writestream = fs.createWriteStream(savefile);
        res.pipe(writestream);
        writestream.on('close', function() {
            console.log(savefile + " Done!");
        });
        res.on('error', function(err) {
        	console.log('Res Error: ' + err);
        });
    });

    req.on('error', function(err) {
    	// req.abort();
		console.log('Download ' + savefile + ' Req Error!! ' + err);
	});

    req.end();

	counter += 1;
}
