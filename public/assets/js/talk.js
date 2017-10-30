/**
 * Created by 杜兵 on 2016/4/24.
 */
function html5Reader(file,pic_id){
    var file = file.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(e){
        var pic = document.getElementById(pic_id);
        pic.src=this.result;
    };
}
function preview_pic(pic_id,file_id) {
    var pic = document.getElementById(pic_id);
    var file = document.getElementById(file_id);

    // IE娴忚鍣�
    if (document.all) {
        file.select();
        window.parent.document.body.focus();
        var reallocalpath = document.selection.createRange().text;
        var ie6 = /msie 6/i.test(navigator.userAgent);
        // IE6娴忚鍣ㄨ缃甶mg鐨剆rc涓烘湰鍦拌矾寰勫彲浠ョ洿鎺ユ樉绀哄浘鐗�
        if (ie6) pic.src = reallocalpath;
        else {
            // 闈濱E6鐗堟湰鐨処E鐢变簬瀹夊叏闂鐩存帴璁剧疆img鐨剆rc鏃犳硶鏄剧ず鏈湴鍥剧墖锛屼絾鏄彲浠ラ€氳繃婊ら暅鏉ュ疄鐜�
            pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src=\"" + reallocalpath + "\")";
            // 璁剧疆img鐨剆rc涓篵ase64缂栫爜鐨勯€忔槑鍥剧墖 鍙栨秷鏄剧ず娴忚鍣ㄩ粯璁ゅ浘鐗�
            pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
        }
    }else{
        html5Reader(file,pic_id);
    }
}


function getImageSize(cfg){
    var img=document.createElement('img');
    callback=cfg.oncomplete;
    img.src = typeof cfg.img == 'string'?cfg.img:cfg.img.src;
    img.setAttribute('style','position:absolute;dispaly:none;');
    document.body.appendChild(img);
    if(!+[1,]){  //判断是否为IE浏览器
        if(img.complete){
            callback.call({"width":img.width,"height":img.height},null);
        }
    }
    img.onload=img.onerror=img.onreadystatechange=function(){
        if(img&&img.readyState&&img.readyState!='loaded'&&img.readyState!='complete'){
            return false;
        }
        img.onload = img.onreadystatechange = img.onerror = null;
        callback.call({"width":img.width,"height":img.height},null);
        img.parentNode.removeChild(img);
        img=null;
    };

    /*
    // 调用方法：
    getImageSize({
        img: 'http://www.ikuku.cn/wp-content/uploads/user/u1497/POST/p215549/1406871283484744-818x534.jpg',
        oncomplete: function () {
            console.log('宽度：' + this.width + '，' + '高度：' + this.height);
        }
    });
    */
}
   // 注：在非IE浏览器下，即使是缓存的图片载入也有onload触发。而在IE下却没有，所以用complete属性。

function getDomFromUrl(url){
    var _iframe=$('<iframe marginheight="0" marginwidth="0" frameborder="0" scrolling="no" width="400" height="400" id="iframepage" onerror="return false;"></iframe>');

    $(_iframe).attr('src',url);

    $('body').append(_iframe);

    var iframe = document.getElementById('iframepage'),
        iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

    $(iframeDoc).one('load',function (event) {
        alert($(iframeDoc).find('body').html());
    });

    var checkLoaded = function(){
        $('#iframepage').ready(function(){
            console.log($('#iframepage').contents().html());
        });
    };



var i=0;
  var _manipIframe =  function manipIframe() {
        el =$('#iframepage').contents().find('body');
        console.log(el.length);
        //if (el.length != 1) {
      i++;
      if(i>15)return;
            setTimeout(_manipIframe, 100);

         //   return;
      //  }
       console.log(el.contents());
  };
    _manipIframe();

}



$(function(){


    // 调用方法：
    getImageSize({
        img: 'http://www.ikuku.cn/wp-content/uploads/user/u1497/POST/p215549/1406871283484744-818x534.jpg',
        oncomplete: function () {
            console.log('宽度：' + this.width + '，' + '高度：' + this.height);
            //alert('宽度：' + this.width + '，' + '高度：' + this.height);
        }
    });
    getImageSize({
        img: 'http://www.ikuku.cn/wp-content/uploads/user/u1497/POST/p215549/1406871283484744-818x534.jpg',
        oncomplete: function () {
            console.log('宽度：' + this.width + '，' + '高度：' + this.height);
            //alert('宽度：' + this.width + '，' + '高度：' + this.height);
        }
    });

    getDomFromUrl('https://www.baidu.com');
});