/* custom js here */
$(function() { $('.carousel').carousel(); });

/**
 * Created by ado on 2016/4/5.
 */
/******** start upload by ado *********/
function getExt(file){
    return (-1!==file.indexOf('.'))?file.replace(/.*[.]/, ''):'';
}
function valid(el){
    var ext = getExt(el.value);
    var lc = ext.toLowerCase();
    var maxsize = 2*1048576;
    if(lc!=='jpg' && lc!=='jpeg' && lc!=='png' && lc!=='gif' && lc!=='bmp'){
        el.value = '';
        alert(window.parent.litb.jpg_only);
    }else if(el.files && el.files[0] ){
        if (el.files[0].size > maxsize) {
            el.value = '';
            window.parent.alert("3 images max, 2MB max per image.");
        }else{
            autoFillLiarLabel(el);
        }
    }else{
        var img = document.createElement("img");
        el.select();
        window.parent.document.body.focus();
        var imgSrc = document.selection.createRange().text;
        img.onload = function ()
        {
            var filesize = img.fileSize;
            if(filesize < maxsize && filesize > 0){
                autoFillLiarLabel(el);
            }else{
                img = null;
                el.value = '';
                window.parent.alert("3 images max, 2MB max per image.");
            }
        };
        img.src = imgSrc;
    }
}
function valfrm(frm){
    for(var o in frm.elements){
        var el = frm.elements[o];
        if(el.type=='file'&&el.value!=''){
            var ext = getExt(el.value);
            var lc = ext.toLowerCase();
            if(lc!=='jpg' && lc!=='jpeg' && lc!=='png' && lc!=='gif' && lc!=='bmp'){
                el.value = '';
            }
        }
    }
}

var _fileFields = jQuery('.review_image_files');
var _fileFieldsNumber = _fileFields.size();
var _alertMsg=_fileFieldsNumber+' images max, 2MB max per image.';
if(_fileFieldsNumber>0){
    jQuery(_fileFields).change(function(){
        validField(this);
        fileFieldsChange();
    });
}


function validField(el){
    var ext = getExt(el.value);
    var lc = ext.toLowerCase();
    var maxsize = 2*1048576;
    if(lc!=='jpg' && lc!=='jpeg' && lc!=='png' && lc!=='gif' && lc!=='bmp'){
        el.value = '';
        alert('file is not a jpg/png file format');
    }else if(el.files && el.files[0] ){
        if (el.files[0].size > maxsize) {
            el.value = '';
            alert(_alertMsg);
        }else{
            fileFieldsChange(el);
        }
    }else{
        var img = document.createElement("img");
        el.select();
        window.document.body.focus();
        var imgSrc = document.selection.createRange().text;
        img.onload = function ()
        {
            var filesize = img.fileSize;
            if(filesize < maxsize && filesize > 0){
                fileFieldsChange(el);
            }else{
                img = null;
                el.value = '';
                alert(_alertMsg);
            }
        };
        img.src = imgSrc;
    }
}

function _bisIe(){
    var userAgent = navigator.userAgent.toLowerCase();
    /*IE11*/
    var isIE = ((/msie/.test(userAgent) && !/opera/.test(userAgent)) || (/Trident\/7\./).test(navigator.userAgent) ) ? true : false;
    return isIE;
}

var count = 0;

/**
 * 文件域叠放
 * 显示 隐藏某个文件域
 * @param index
 * @param idpx
 */
function fileFieldsChange(el){
    var _file_label = 'file';
    var _imgIdEndWith='LiarLabel';
    var _maskIdLabelClassName = '.liar-label';
    var _fileFields = jQuery('.review_image_files');
    var _fileFieldsNumber = _fileFields.size();
    if(_fileFields && _fileFieldsNumber>0){
        var _shown=false;
        var _showIndex = 1;
        jQuery(_fileFields).each(function(index,element){
            var _index=index+1;
            var _cur_file_label = _file_label+_index;
            if(jQuery(this).val()){
                _showIndex = _index+1;
                if(_index>=_fileFieldsNumber)_showIndex=1;
                var _cur_file_img_label = _file_label+_index+_imgIdEndWith;
                if(jQuery("#"+_cur_file_img_label).size() == 0){
                    //  console.log(_cur_file_img_label);
                    jQuery(_maskIdLabelClassName).append(jQuery('<span><img class="img" id="'+_cur_file_img_label+'"/><a></a></span>'));
                    preview_pic(_cur_file_img_label,_cur_file_label);
                }
                jQuery("#"+_cur_file_label).css("display","none");
            }

            if(!_shown && _index==_showIndex){
                jQuery("#"+_cur_file_label).css("display","inline-block");
                _shown = true;
            }
        });

        jQuery(_maskIdLabelClassName).delegate("a","click", function() {
            if(_bisIe()){
                for(i=1;i<=_fileFieldsNumber;i++){
                    jQuery(this).closest("span").remove();
                    var _cur_fileField = jQuery('#'+_file_label+i);
                    var _cur_file_img_label = _file_label+i+_imgIdEndWith;
                    if(jQuery(this).prev("img").attr("id") == _cur_file_img_label){
                        _cur_fileField.after(_cur_fileField.clone().val(""));
                        _cur_fileField.remove();
                        _cur_fileField.css("display","inline-block");
                    }else{
                        _cur_fileField.css("display","none");
                    }
                }
            }else{
                for(i=1;i<=_fileFieldsNumber;i++){
                    jQuery(this).closest("span").remove();
                    var _cur_fileField = jQuery('#'+_file_label+i);
                    var _cur_file_img_label = _file_label+i+_imgIdEndWith;
                    if(jQuery("#"+_cur_file_img_label).size() == 0){
                        jQuery(_cur_fileField).val('');
                        _cur_fileField.css("display","inline-block");
                    }else{
                        _cur_fileField.css("display","none");
                    }
                }
            }
        }).delegate("img","click", function() {
            return false;
        });
    }
}

function checkChinese(str) {
    var len = 0;
    var reg = /^[\u4E00-\u9FA5]+jQuery/;
    for(var i = 0;i< str.length;i++) {
        len++;
        if(reg.test(str[i])) {
            len++;
        }
    }
    return len;
}

function cutChinese(str) {
    for(var i = 0;i<str.length;i++) {
        if(reg.test(str[i])) {
            len++;
        }
    }
}

function getFileNameFromPath(str) {
    var n = str.lastIndexOf("\\");
    var filename = str.substring(n + 1);
    var str1 = filename.subCHString(0, 10);
    var str2 = filename.subCHStr((filename.strLen()-10), 10);
    if (checkChinese(filename) > 23) {
        filename = str1 + '...' + str2;
    }
    return filename;
}

String.prototype.strLen = function() {
    var len = 0;
    for (var i = 0; i < this.length; i++) {
        if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0) len += 2; else len++;
    }
    return len;
};
//将字符串拆成字符，并存到数组中
String.prototype.strToChars = function(){
    var chars = new Array();
    for (var i = 0; i < this.length; i++){
        chars[i] = [this.substr(i, 1), this.isCHS(i)];
    }
    String.prototype.charsArray = chars;
    return chars;
};
//判断某个字符是否是汉字
String.prototype.isCHS = function(i){
    if (this.charCodeAt(i) > 255 || this.charCodeAt(i) < 0)
        return true;
    else
        return false;
};
//截取字符串（从start字节到end字节）
String.prototype.subCHString = function(start, end){
    var len = 0;
    var str = "";
    this.strToChars();
    for (var i = 0; i < this.length; i++) {
        if(this.charsArray[i][1])
            len += 2;
        else
            len++;
        if (end < len)
            return str;
        else if (start < len) {
            str += this.charsArray[i][0];
        }

    }
    return str;
};
//截取字符串（从start字节截取length个字节）
String.prototype.subCHStr = function(start, length){
    return this.subCHString(start, start + length);
};

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

    // IE浏览器
    if (document.all) {
        file.select();
        window.parent.document.body.focus();
        var reallocalpath = document.selection.createRange().text;
        var ie6 = /msie 6/i.test(navigator.userAgent);
        // IE6浏览器设置img的src为本地路径可以直接显示图片
        if (ie6) pic.src = reallocalpath;
        else {
            // 非IE6版本的IE由于安全问题直接设置img的src无法显示本地图片，但是可以通过滤镜来实现
            pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src=\"" + reallocalpath + "\")";
            // 设置img的src为base64编码的透明图片 取消显示浏览器默认图片
            pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
        }
    }else{
        html5Reader(file,pic_id);
    }
}
/******** end upload by ado *********/