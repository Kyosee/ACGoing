$(function(){
    $(".captcha").click(function(){
        var _this = $(this);
        _this.attr('src', _this.data('url') + '?' + Math.random());
    })
})
