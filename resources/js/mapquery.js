$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});


$(function(){


    $('#mapButtonA').click(function(){
        const url="/check/checker";
        $.ajax({
            url:url,
            data:{
                roomName:$('#roomName').val(),
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
                    roomName:$('#roomName').val(),
                    name:$('#name').val(),
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
    });


});
