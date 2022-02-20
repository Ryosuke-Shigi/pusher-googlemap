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
                latitude:$('#latitude').val(),
                longitude:$('#longitude').val(),
                zoom:$('#zoom').val()
            },
            method:"POST"
        });
    });




});
