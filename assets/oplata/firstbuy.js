	  $(document).ready(function(){
	  $.ajax({ url: "/admin/market/balance", cache: true, success: function(html){ $("#money").html(html); } });
	  $.ajax({ url: "/admin/market/login", cache: true, success: function(html){ $("#LoginSt").html(html); } });
	  });
  $(function () {
    $(".textarea").wysihtml5();
  });
  