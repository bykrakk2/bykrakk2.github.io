<!DOCTYPE html>
<html>
  <head>
    <title><? echo $this->config->item('site_name'); ?> Админ-панель</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->	
	 <link href="/full/shop/script/admin/bs3/css/bootstrap.min.css" rel="stylesheet">	
    <link href="/assets/css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
    <link href="<? echo site_url('/assets/css/bootstrap-glyphicons.css'); ?>" rel="stylesheet" media="screen">
    <link href="<? echo site_url('/assets/css/error.alert.css'); ?>" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/navi.css" media="screen" />
<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>


	<script language="javascript" type="text/javascript" src="http://www.cdolivet.com/editarea/editarea/edit_area/edit_area_full.js"></script>
<script language="javascript" type="text/javascript">
editAreaLoader.init({
	id : "textarea_1"		// textarea id
	,syntax: "css"			// syntax to be uses for highgliting
	,start_highlight: true		// to display with highlight mode on start-up
});
</script>


	<script src="http://code.jquery.com/jquery.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script type="text/javascript" src="<? echo site_url('/assets/js/tinymce/tinymce.min.js'); ?>"></script>
	<script type="text/javascript" src="<? echo site_url('/assets/js/custom.js'); ?>"></script>
	<script type="text/javascript">
	tinymce.init({
		selector: "textarea.tinymce",
		plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
	var fixHelper = function(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	};
    $( ".tblsort tbody" ).sortable({
		helper: fixHelper,
        opacity: 0.8, 
        cursor: 'move', 
        tolerance: 'pointer',  
        items:'tr',
        placeholder: 'state', 
        forcePlaceholderSize: true,
        update: function(event, ui){
            $.ajax({
                url: "/admin/goods/chg_order_ajax",
                type: 'POST',
                data: $(this).sortable("serialize"), 
            });
//-------------------------------                                
            }
                
        });

		$( ".tblsort tbody" ).disableSelection();
	});  
	</script>
 </head>
