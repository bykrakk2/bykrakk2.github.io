<link href="http://demos.creative-tim.com/css/rotating-card.css" rel="stylesheet" />
<style>
body {
    margin-top: 0px;
    font-size: 14px;
    font-family: "Helvetica Nueue",Arial,Verdana,sans-serif;
    background-color: #E5E9ED;
}
</style>
<section class="content-header">
   <h1>
      Маркет шаблонов
   </h1>
</section>
<section class="content">
      <div class="box-body">
<? if($templates): foreach($templates as $t): ?>
<div class="col-md-4 col-sm-6" style="width: 235px;">
             <div class="card-container manual-flip" style=" height: 250px; ">
                <div class="card">
                    <div class="front" style=" height: 250px; ">
                        <div class="cover">
                            <img src="<?=$t->img;?>">
                        </div>
                        <div class="content">
                            <div class="main">
                                <h3 class="name"><?=$t->name;?></h3>
                                <p class="profession"><?if($t->price == 0) { echo '<i class="fa fa-download"></i> Бесплатно';} else { echo $t->price.' <i class="fa fa-rub"></i>'; }?></p>
                            <div class="footer">
                                <div class="rating">
                                   <a class="btn btn-simple" href="/admin/market/view/<?=$t->id;?>"> <i class="fa fa-mail-forward"></i> Подробнее </a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
        </div>
                
<? endforeach; ?>
<? else: ?>
                  <tr>
                     <td colspan="3">Сайты отсутствуют</td>
                  </tr>
<? endif; ?>
</section>