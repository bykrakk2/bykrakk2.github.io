function responses(id_goods,page){
type = $("#resp_type").val();
$.get("type_resp.php?type_responses=" + type);
	$.get("resp_block.php?id_goods=" + id_goods + "&page=" + page, function(result){
		if (result.length>10){
			$(".digiseller-reviews_content").html(result);}});}

function SubCat(SubID,Url){
	if(SubID > 0){
		if(document.getElementById("sub_" + SubID).style.display == 'none'){
			document.cookie = "sub_" + SubID + '=block';}
		else{
			document.cookie = "sub_" + SubID + '=none';}}
document.location.href = Url;}


$(document).ready(function(){
	$("#goods_resp_tab").click(function(){
		$(this).attr("class","digiseller-activeTab");
				$("#goods_desc_tab").removeAttr("class");
		$(".digiseller-description_content").css("display","none");
		$(".digiseller_dop_content").css("display","none");
		$(".digiseller-reviews_content").css("display","block");});
	$("#goods_desc_tab").click(function(){
		$(this).attr("class","digiseller-activeTab");
		$("#goods_resp_tab").removeAttr("class");
		$(".digiseller-description_content").css("display","block");
		$(".digiseller_dop_content").css("display","none");
		$(".digiseller-reviews_content").css("display","none");});});
	$("#goods_dop_tab").click(function(){
		$(this).attr("class","digiseller-activeTab");
		$("#goods_dop_tab").removeAttr("class");
		$(".digiseller-description_content").css("display","none");
		$(".digiseller_dop_content").css("display","block");
		$(".digiseller-reviews_content").css("display","none");});

(function($){				
    jQuery.fn.lightTabs = function(options){
        
        var createTabs = function(){
            tabs = this;
            i = 0;
            
            showPage = function(i){
                $(tabs).children("div").children("div").hide();
                $(tabs).children("div").children("div").eq(i).show();
                $(tabs).children("ul").children("li").removeClass("active");
                $(tabs).children("ul").children("li").eq(i).addClass("active");
            }
            
            showPage(0);				
            
            $(tabs).children("ul").children("li").each(function(index, element){
                $(element).attr("data-page", i);
                i++;                        
            });
            
            $(tabs).children("ul").children("li").click(function(){
                showPage(parseInt($(this).attr("data-page")));
            });				
        };		
        return this.each(createTabs);
    };	
})(jQuery);
$(document).ready(function(){
    $(".tabs").lightTabs();
});