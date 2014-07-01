lofter_img_download
===================

Download images from http://wanimal.lofter.com

##File Desc:

- **getimg.php**---This is php download way.
- **getimg.js**---Download by nodejs.(The code need to be cleaned...)
- **wgetImg.sh**---If you use the php way, choose the getPage() function, you have to execute this shell script after exec the php file.

---

I did this just for compare the speed of wget with php file_put_contents() after I read a article from [my friend's blog](http://t.cn/RvoAou0).

This is the result:
16 seconds get all images' url and write in file.

![image](http://webtest.qiniudn.com/getUrl.png)

645 seconds to download all images.

![image](http://webtest.qiniudn.com/wget.png).


It seems that the same result with php's file_put_contents, I'll test php's function later.

And the node way:
![iamge](http://webtest.qiniudn.com/node_lofter.png)

##Dependencies(choose one of them):

- php (curl)

- wget

- node
---
You have 3 chooice to download the images.

1. execute ``` node getimg.js``` Modify the images' [save path](https://github.com/keith3/lofter_img_download/blob/master/getimg.js#L56)
2. execute ``` php getimg.php```. Modify the images' [save path](https://github.com/keith3/lofter_img_download/blob/master/getimg.php#L84)
3. modify getimg.php, comment #Line9 and uncomment #line8, execute ```php getimg.php; ./wgetImg.sh```.   Modify the images' [save path](https://github.com/keith3/lofter_img_download/blob/master/wgetImg.sh#L8).

