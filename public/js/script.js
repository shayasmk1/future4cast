$(document).ready(function() {

    // assuming the controls you want to attach the plugin to
    // have the "datepicker" class set
    $('input.datepicker').Zebra_DatePicker({
        format:'d-m-Y'
    });
    
    $('#logout').click(function(){
       window.location.href = "/auth/logout"; 
    });
    
    $('.vote-up').click(function(){
        var id = $(this).attr('data-id');
        var parent = $(this).parents('div').first();
        $.post('/post/vote',{"id":id},function(res){
            $(parent).find('.votes').html(res[0].like_count);
        },'json');
     //   $.post("up-a-vote")
    })

});