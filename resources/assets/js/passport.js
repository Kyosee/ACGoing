$(function(){
    $(".captcha").click(function(){
        var _this = $(this);
        _this.attr('src', _this.data('url') + '?' + Math.random());
    })

    /**
     * signup form
     */
    var passportForm = $(".passport-form");

    if(!passportForm.length) return;

    passportForm.submit(function(){
        var _this = $(this);

        $.ajax({
            type: 'post',
            data: _this.serialize(),
            url: _this.attr('action'),
            success: function(response){
                if(response.result){
                    location.href = response.url
                }else{
                    layer.msg(response.msg);
                }
            },
            error: function(error){
                $.each(error.responseJSON, function(index, val) {
                    $("input[name="+index+"]").focus();
                    layer.msg(val[0]);
                    return false;
                });
            }
        });

        return false;
    })

})
