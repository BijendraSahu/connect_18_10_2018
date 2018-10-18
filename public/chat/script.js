var arr = [];

	$('.chat_head').click(function(){
		$('.chat_body').slideToggle('slow');
	});
	$('.chat_body').slideToggle('slow');
	
$(document).ready(function(){


	
	$('textarea').keypress(
    function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            var msg = $(this).val();
			$(this).val('');
			if(msg!='')
			$('<div class="msg_b">'+msg+'</div>').insertBefore('.msg_push');
			$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
        }
    });
	
});

	function slowdown(idss)
{
	$('#minimize_'+ idss).slideToggle('slow');
	
}
