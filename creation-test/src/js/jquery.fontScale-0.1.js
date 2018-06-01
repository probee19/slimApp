/*
Plugin: jQuery Font Scaler
Version 0.1
Author: James McKennay
Plugin URL: https://github.com/jmckennay/jquery-fontscaler
Licensed under the MIT license:
http://www.opensource.org/licenses/mit-license.php
*/

$.fn.fontScale = function(text, font, maxLines) {
    if (!$.fn.fontScale.fakeEl) $.fn.fontScale.fakeEl = $('<span>').appendTo(document.body);
    var htmlText = text || this.val() || this.text();
    htmlText = $.fn.fontScale.fakeEl.text(htmlText).html();
    htmlText = htmlText.replace(/\s/g, "&nbsp;");
    $.fn.fontScale.fakeEl.html(htmlText).css('font', font || this.css('font'));
    var textWidth = $.fn.fontScale.fakeEl.width();
    var containerWidth = parseFloat(this.width());
    var lineEstimate = textWidth/containerWidth;
    maxLines = maxLines || this.data('maxlines') || 3;
    if(maxLines>1) maxLines-=0.5;
    if(lineEstimate > maxLines){
        var fontSize = parseFloat(this.css('font-size').replace('px',''));
        fontSize = fontSize * ((maxLines*.9)/lineEstimate) + 'px';
        this.css('font-size', fontSize);
    }
    $.fn.fontScale.fakeEl.hide();
}
