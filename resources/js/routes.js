/* $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
 */

$(function(){

    $('.chatRoom').click(function(){
        $('#roomName').val($(this).data('room_name'));
        $('#nextActionA').submit();

    });
    $('.nextButtonA').click(function(){
        $('#nextActionA').submit();
    });
    $('.nextButtonB').click(function(){
        $('#nextActionB').submit();
    });
    $('.backButtonA').click(function(){
        $('#backActionA').submit();
    });
    $('.nextButtonC').click(function(){
        $('#nextActionC').submit();
    });


/*     $('#mapButtonA').click(function(){
        const url="/check/checker";
        $.ajax({
            url:url,
            data:{
                latitude:$('#latitude').val(),
                longitude:$('#longitude').val(),
                zoom:$('#zoom').val()
            },
            method:"POST"
        });
    });

    $('#sendButtonA').click(function(){
        if($('#comment').val()!=""){
            const url="/check/commenter";
            $.ajax({
                url:url,
                data:{
                    comment:$('#comment').val(),
                },
                method:"POST"
            });
            $('#comment').val("");
        }
    });

    //コメント入力画面 ENTERで更新
    $('#comment').change(function(e){
        $('#sendButtonA').trigger('click');
    }); */


});
