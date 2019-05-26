<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
	{headers}
    <link href='https://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>

    <link rel="apple-touch-icon" sizes="57x57" href="{THEME}/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{THEME}/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{THEME}/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{THEME}/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{THEME}/favicon/apple-touch-icon-114x114.png">
    <link rel="icon" type="image/png" href="{THEME}/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{THEME}/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{THEME}/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="{THEME}/favicon/manifest.json">
    <link rel="mask-icon" href="{THEME}/favicon/safari-pinned-tab.svg" color="#999">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <script src="https://use.fontawesome.com/a0ba4cf766.js"></script>

    <link href='{THEME}/styles/lib.css' rel='stylesheet' type='text/css'>
    <link href='{THEME}/styles/app.css' rel='stylesheet' type='text/css'>
    
<script src="{THEME}/scripts/vendor/modernizr.js?v=1511460319"></script>
<script src="{THEME}/scripts/jquery-2.2.4.min.js?v=1511460213"></script>
  
</head>
<body>


    
<div class="page ">
    <div class="page-inner">
        <header class="header js-header">
    <div class="header__top">
        <div class="wrapper">

            <div class="header-mob">

                <div class="header-mob-btn js-mob-btn">
                    <button type="button" class="header-mob-btn__bars">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button type="button"
                            class="header-mob-btn__close iconic iconic--cross"></button>
                </div>

                <nav class="header-mob__menu wrapper">
                    <ul class="header-mob__list">
                        <li>
                            <a href="/catalogs">Каталог игр</a>
                        </li>
                        
                        <li>
                            <a href="/catalogs/leaders">Лидеры продаж</a>
                        </li>
                        <li>
                            <a href="/catalogs/new">Новинки</a>
                        </li>                        
                        <li>
                            <a href="/catalogs/sale">Экстра скидки</a>
                        </li>
                        
                    </ul>

                    <ul class="header-mob__list header-mob__list--sm">
                        <li>
                            <a href="/">Главная</a>
                        </li>
                        <li>
                            <a href="/how-to-buy.html">Как купить?</a>
                        </li>
                        <li>
                            <a href="/payment.html">Оплата</a>
                        </li>
                        
                        <li>
                            <a href="/guarantee.html">Гарантии</a>
                        </li>
                        
                        
                        <li>
                            <a href="/profile/my-purchases">Мои покупки</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <a href="/" class="header__logo">
                <img src="{THEME}/images/logo.png" alt="GabeShop">
            </a>

            <div class="currency__dropdown">
              <div class="dropdown js-dropdown" id="currency-listall">
                <div class="dropdown__head-mob">
                  <select class="dropdown__head" id="currency-list" onchange="currencyList()">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="RUB">RUB</option>
                    <option value="UAH">UAH</option>
                  </select>
                </div>
                <div class="dropdown__head-main">
                  <div class="dropdown__head js-dropdown-btn">
                    <font id="currency_now">RUB</font>
                  </div>
                  <div class="dropdown__cont">
                    <ul class="currency__list">
                      <li class="currency__list-item" onclick="currencySelect('USD')"  id="currency_USD">
                        USD<span class="currency__symbol">$</span>
                      </li>
                      <li class="currency__list-item" onclick="currencySelect('EUR')" id="currency_EUR">
                        EUR<span class="currency__symbol">€</span>
                      </li>
                      <li class="currency__list-item" onclick="currencySelect('RUB')" id="currency_RUB">
                        RUB<span class="currency__symbol"><span class='rub'>P</span></span>
                      </li>
                      <li class="currency__list-item" onclick="currencySelect('UAH')" id="currency_UAH">
                        UAH<span class="currency__symbol">₴</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
                var poolCurrency = {"RUB" : 1, "USD" : 56, "EUR" : 68, "UAH" : 2};
            </script>

            <div class="header__main-col">

                <div class="header__info-wr">
                   <ul class="header__info-links">
                        <li>
                            <a href="/" class="link link--black">
                                Главная
                            </a>
                        </li>
                        <li>
                            <a href="/how-to-buy.html" class="link link--black">
                                Как купить?
                            </a>
                        </li>
                        <li>
                            <a href="/payment.html" class="link link--black">
                                Оплата
                            </a>
                        </li>
                        
                        <li>
                            <a href="/guarantee.html" class="link link--black">
                                Гарантии
                            </a>
                        </li>
                        
                    </ul>


                   
                                            <a href="https://primearea.biz/customer/" class="header-ico-link">
                            <span class="header-ico-link__ico header-ico-link__ico--cart">
                            </span>
                            <span class="header-ico-link__txt">
                                Мои покупки
                            </span>
                        </a>
                    
                </div>

                <div class="search-div">

                    <div class="search-wr js-live-search"
                         data-delay="300" data-url="/search/autocomplete">
                       <form method="post" action="" class="search-wr__main">
				<input type="hidden" name="do" value="search"><input type="hidden" name="subaction" value="search">
				<input name="story" type="text" class="search-wr__input js-live-search_input" id="story" placeholder="Поиск Игр" onfocus="if(this.value=='поиск по сайту') this.value='';" title="наберите Ваш запрос и нажмите enter">
				
				   <div class="search-wr__btns-pair">
                                <button type="submit" class="iconic iconic--lupa search-wr__submit"></button>
                            </div>
				
			</form>

                        <div class="search-wr__loadout-wr js-live-search_loadout-wr">
                            <div class="search-wr__loadout js-live-search_loadout"></div>
                            <div class="search-wr__loadout-bot">
                                <a href="#" class="search-wr__loadout-bot-link js-live-search_all-link">
                                    Все результаты
                                </a>
                            </div>
                        </div>
                    </div>
                    <p class="search-div__txt">
                        В лавке дядюшки Гейба более 900 игр
                    </p>
                </div>
            </div>

            <button type="button" class="iconic iconic--lupa header__mob-search js-search-toggle"></button>
        </div>
    </div>

        <div class="header__nav">
        <div class="wrapper">
            <nav class="header-nav">
                <div class="header-nav__group">
                    <a href="/catalogs" class="header-nav__gr-link">
                        <span class="header-nav__gr-link-txt">
                            Каталог игр
                        </span>
                    </a>

                    <div class="header-nav__submenu">
                        <div class="wrapper">
                            <a href="/catalogs/action" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <!--<img src="/images/mario_body.png" alt="">-->
                                                                        <span class="iconic iconic--cat-action"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    Экшн
                                </p>
                            </a>

                            <a href="/catalogs/adventure" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-adventure"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    приключения
                                </p>
                            </a>

                            <a href="/catalogs/rpg" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-rpg"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    ролевые (RPG)
                                </p>
                            </a>

                            <a href="/catalogs/simulator" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-sim"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    симуляторы
                                </p>
                            </a>

                            <a href="/catalogs/strategy" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-strategy"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    стратегии
                                </p>
                            </a>

                            <a href="/catalogs/online" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-mmo"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    онлайн
                                </p>
                            </a>

                            <a href="/catalogs/arcade" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-arcade"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    аркады
                                </p>
                            </a>
                            <a href="/catalogs/sport-racing" class="header-nav__smenu-item">
                                <div class="header-nav__smenu-ico">
                                    <span class="iconic iconic--cat-sport"></span>
                                </div>
                                <p class="header-nav__smenu-name" >
                                    спорт и гонки
                                </p>
                            </a>

                        </div>
                    </div>

                </div>

                

                <div class="header-nav__group">
                    <a href="/catalogs/leaders" class="header-nav__gr-link">
                        <span class="header-nav__gr-link-txt">
                            Лидеры продаж
                        </span>
                    </a>

                </div>

                <div class="header-nav__group">
                    <a href="/catalogs/new" class="header-nav__gr-link">
                        <span class="header-nav__gr-link-txt">
                            Новинки
                        </span>
                    </a>

                </div>



                

                <div class="header-nav__group">
                    <a href="/catalogs/sale" class="header-nav__gr-link">
                        <span class="header-nav__gr-link-txt">
                            Экстра скидки
                            <sup>
                                до 90%
                            </sup>
                        </span>
                    </a>

                </div>

                

            </nav>
        </div>
    </div>
</header>
  [available=main]  <div class="page-body">
                <div class="promo-slider js-promo-slider">
                        {custom category="13" template="slide"}
        </div><!-- promo-slider -->

<section class="promo-luck-wr">
    <div class="wrapper">
        <div class="h3 promo-luck-wr__title">
            <span class="ico ico--roulette"></span>
            Испытай удачу
        </div>

        <div class="get-luck-cont js-luck-slider">

                                            {include file="random.tpl"}
                            
        </div>

    </div>
</section><!-- promo-luck-wr -->


<div class="promo-cats">
    <div class="wrapper">
        <div class="tabs js-tabs">

            <div class="oblique-btns tabs__controlls">
                
                
                <h2 class="oblique-btns__btn-wr">
                    <button type="button">
                       
                        Лидеры Продаж
                   
                    </button>                    
                </h2>
                
                
            </div>

             <div class="tabs__group">
                

                <div class="tabs__tab js-tabs-tab _active">
                    <div class="franchises">
                                                                                                                                                                                                                                         {custom category="1-12" template="shortstory" available="global"}           
                                            </div>
                </div>

               
                <a href="/catalogs" class="btn btn--round btn--white products-wr__btn-more">
                <span class="iconic iconic--grid"></span>
                Весь каталог
            </a>
			
                                            </div>
                </div>
            </div>
        </div><!-- promo-cats -->

<div class="promo-cats">
    <div class="wrapper">
        <div class="tabs js-tabs">

            <div class="oblique-btns tabs__controlls">
                <h2 class="oblique-btns__btn-wr _active js-tabs-btn">
                    <button type="button" class="btn btn--oblique  ">
                        Жанры
                    </button>
                </h2>
               
            </div>

            <div class="tabs__group">
                <div class="tabs__tab _active js-tabs-tab">
                    <div class="cats-list">

                        <div class="cats-list__col">
                            <a href="/games/action" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-action"></span>
                                </div>
                                <p class="category__name">
                                    Экшн
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/adventure" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-adventure"></span>
                                </div>
                                <p class="category__name">
                                    приключения
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/rpg" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-rpg"></span>
                                </div>
                                <p class="category__name">
                                    ролевые (rpg)
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/simulator" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-sim"></span>
                                </div>
                                <p class="category__name">
                                    симуляторы
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/strategy" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-strategy"></span>
                                </div>
                                <p class="category__name">
                                    стратегии
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/online" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-mmo"></span>
                                </div>
                                <p class="category__name">
                                    Онлайн
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/arcade" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-arcade"></span>
                                </div>
                                <p class="category__name">
                                    аркады
                                </p>
                            </a>
                        </div>

                        <div class="cats-list__col">
                            <a href="/games/sport-racing" class="category">
                                <div class="category__ico">
                                    <span class="iconic iconic--cat-sport"></span>
                                </div>
                                <p class="category__name">
                                    спорт и гонки
                                </p>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- promo-cats -->

<section class="reg-sl-block promo-comms">
    <div class="wrapper">
        <h3 class="h4">
            <a href="/reviews" class="link link--black">
                Отзывы
            </a>
        </h3>

        <div class="reg-sl-block__slider  promo-comms__slider js-promo-comm">
            
                                {custom category="14" template="commapp" available="global"}
								 </div>
        
    </div>
</section>
    </div>
[/available][not-available=main]<div class="page-body">
        <div class="main-wr">
        <div class="wrapper">
                        <div class="catalog-wr js-catalog-wr" style="">
<div class="catalog js-catalog">
    <div class="wrapper">


<div class="products-list js-catalog-loadout">
{info}
{content}
            
            </div>


                    
        
    </div>
</div><!-- catalog -->
</div>
        </div>
    </div><!-- /page-body -->
</div>[/not-available]
<section class="online-sells">
    <div class="wrapper">
        <div class="h4">
            Покупают прямо сейчас
        </div>
    </div>

    <div class="online-sells__track-wr">
        <div class="online-sells__loadout-cont js-sells-loadout">
        </div>
        <div class="online-sells__track js-sells-tracker">
                      {custom category="1-13,15-5000000" template="app" available="global"}
                    </div>
    </div>
</section>

<footer class="footer">
    <div class="footer__main">
        <div class="wrapper">

            <nav class="footer__nav">
                <ul>
                    <li>
                        <a href="/catalogs" class="footer__nav-link">
                            Каталог игр
                        </a>
                    </li>
                    
                    <li>
                        <a href="/catalogs/leaders" class="footer__nav-link">
                            Топ продаж
                        </a>
                    </li>
                    <li>
                        <a href="/catalogs/new" class="footer__nav-link">
                            Новинки
                        </a>
                    </li>
                    
                    <li>
                        <a href="/catalogs/sale" class="footer__nav-link">
                            Экстра скидки
                        </a>
                    </li>
                    <li>
                        <a href="/catalogs/sale" class="footer__nav-link">
                            Экономия
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="footer__info">

                <div class="footer__info-commerc">
                    <p class="footer__legal">
                        Все продаваемые ключи закупаются у официальных дистрибьюторов и издателей. В том числе у 1C-СофтКлаб, Бука, Новый Диск и Enaza.
                    </p>
                    <div class="footer__pay-syst">
                        <img src="../images/pay-systems.png" alt="">
                    </div>
                </div>

                <div class="footer__info-soc">
                    <div class="footer__yt-wr">
                        <a target="_blank" href="https://www.youtube.com/user/onlinegamercentral" class="footer__youtube">
                            <span>
                                Смотрите обзор игр
                                на Youtube-канале
                            </span>
                        </a>
                    </div>

                    <div class="social-links social-links--grey">
                        <a target="_blank" href="https://vk.com/gabestore" class="fa fa-vk"></a>
                        <a target="_blank" href="https://twitter.com/gabestoreru" class="fa fa-twitter"></a>
                        <a target="_blank" href="http://t.me/gabestore" class="fa fa-telegram"></a>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="footer__bottom">
        <div class="wrapper">
            <p class="footer__cr">
                GABESTORE.RU © 2014-2017
            </p>

          
        </div>
    </div>


</footer>    </div><!-- /page-inner -->

    <!-- popups -->

    <div class="pswp js-pswp"  aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
</div><!-- /page -->
<script src="{THEME}/assets/d8666640/jquery.js?v=1511460290"></script>
<script src="{THEME}/assets/cd488b53/yii.js?v=1511460288"></script>
<script src="{THEME}/assets/cd488b53/yii.validation.js?v=1511460288"></script>
<script src="{THEME}/assets/cd488b53/yii.activeForm.js?v=1511460288"></script>
<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<script src="{THEME}/scripts/lib.js?v=1511460213"></script>
<script src="{THEME}/scripts/app.js?v=1511460212"></script>
<script src="{THEME}/scripts/currency.js?v=1511460213"></script>

</body>
</html>
