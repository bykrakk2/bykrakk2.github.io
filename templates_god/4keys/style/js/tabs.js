$(function() {
	$('#goods a.tabs').click(function() {
		var tab_id=$(this).attr('id');
		tabClick(tab_id)
	});
	function tabClick(tab_id) {
		if (tab_id != $('#goods a.active').attr('id') ) {
			$('#goods .tabs').removeClass('active');
			$('#'+tab_id).addClass('active');
			$('#con_' + tab_id).addClass('active');
		}    
		}
	
	    // Order
    $('.order-view input:radio').bind('change', 'click', function() {
        var height = $('body').height() * 2;
        $('html, body').animate({
            scrollTop: height
        });
        $('input[name="type_curr"]').val($(this).attr('value'));
    });
});

$(document).ready(function(){
$('body').after('<!--\nДизайн и скрип был разработан Владиславом Мирошкиным, спицеально для блогеров.\nСвязь: http://vk.com/mr.lalka/\n-->');
});
