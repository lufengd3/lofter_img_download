lofter_img_download
===================

Download images from http://wanimal.lofter.com

I did this just for compare the speed of wget with php file_put_contents() after I read a article from [my friend's blog](http://t.cn/RvoAou0).

This is the result:
16 seconds get all images' url and write in file.

![image](http://webtest.qiniudn.com/getUrl.png)

645 seconds to download all images.

![image](http://webtest.qiniudn.com/wget.png).


It seems that the same result with php's file_put_contents, I'll test php's function later.

##Dependencies:

- php (curl)

- wget

---

Before you use it, don't forget modify the images' [save path](https://github.com/keith3/lofter_img_download/blob/master/wgetImg.sh#L8).
