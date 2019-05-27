<? if($template): foreach($template as $t): ?>
<script>
 function ajax(zapr) {
              $.ajax({
                  url: zapr,
                  type: "POST",
                  data: {
					  yes: "plus"
				  },
                  cache: false,
                  success: function(html) {
                      eval(html);
                  }
              });
  }
</script>

<div class="row">
   <div class="col-md-8">
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title"><?=$t->name;?></h3>
         </div>
         <div class="box-body no-padding">
            <center><img style=" width: 98%; " src="<?=$t->img;?>"></center>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="box box-success">
         <div class="box-body no-padding">
            <center><h3 class="box-title"><?=$t->name;?></h3></center>
			<hr>
			<center><h3><?if($t->price == 0) { echo '<i class="fa fa-download"></i> Бесплатно';} else { echo $t->price.' <i class="fa fa-rub"></i>'; }?></h3></center>
         </div>
		 <?if($t->price == 0 or $buy == 1) { ?>
         <a onclick="ajax('/admin/market/install/<?=$t->id;?>')" class="btn btn-primary" style="width:100%">Установить</a>
		 <? } elseif($buy == 0) { ?>
		 <a onclick="ajax('/admin/market/buy/<?=$t->id;?>')" class="btn btn-primary" style="width:100%">Купить</a>
		 <? } ?>
      </div>
   </div>
<div class="col-md-4">
   <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Описание</h3>
         </div>
         <div class="box-body">
		 <?=$t->descr;?>
         </div>
      </div>
   </div>
</div>
<? endforeach; ?>
<? else: ?>
Ошибка доступа
<? endif; ?>