<header id="header">
<div class="header-top">
<div class="header-top-left">
<a href="despre" class="header-top-despre">Despre San Marco</a>
<div class="header-linie">|</div>
<a href="restaurant" class="header-top-despre">Restaurante</a>
<div class="header-linie">|</div>
<a href="contact" class="header-top-despre">Contact</a>
<div class="header-social">
<a href="" class="header-social-link"><img style="width:100%;height:100%;"
src="images/header-facebook.svg"></a>
<a href="" class="header-social-link"><img style="width:100%;height:100%;"
src="images/header-instagram.svg"></a>
</div>
</div>
<div class="header-top-right">
<a href="tel:0241 858 888" class="header-top-right-element">
<img src="images/sageata-galbena.svg" class="sageata-galbena">
<div class="header-top-right-text">Comenzi telefonice: 0241 858 888</div>
</a>
@if(session('userid'))
<div id="cont-button" class="header-top-right-element contul-meu-buton" onclick="window.location.href='/cont'">
<img src="images/sageata-galbena.svg" class="sageata-galbena">
<div class="header-top-right-text">Cont</div>
<img src="images/profil.svg" class="profil-image">
</div>
@else
<div id="register-button" class="header-top-right-element contul-meu-buton">
<img src="images/sageata-galbena.svg" class="sageata-galbena">
<div class="header-top-right-text">Register</div>
</div>
<div id="login-button" class="header-top-right-element contul-meu-buton" >
<img src="images/sageata-galbena.svg" class="sageata-galbena">
<div class="header-top-right-text">Login</div>
<img src="images/profil.svg" class="profil-image">
</div>
@endif
</div>
</div>
<div class="header-menu">
<a href="/" class="logo"><img class="img-logo" src="images/logo.svg"></a>
<div class="menu">
@if (\Request::is('pizza') || \Request::is('detaliu-pizza/*'))  
<a href="pizza" class="menu-item menu-item-selecter">PIZZA</a>
@else
<a href="pizza" class="menu-item">PIZZA</a>
@endif
<div class="linie"></div>
@if (\Request::is('paste') || \Request::is('detaliu-paste/*'))  
<a href="paste" class="menu-item menu-item-selecter">Paste</a>
@else
<a href="paste" class="menu-item">Paste</a>
@endif
<div class="linie"></div>
@if (\Request::is('salate') || \Request::is('detaliu-salata/*'))
<a href="salate" class="menu-item menu-item-selecter">Salate</a>
@else
<a href="salate" class="menu-item">Salate</a>
@endif
<div class="linie"></div>
<!--             <a href="burgeri" class="menu-item">Burgers</a>
<div class="linie"></div> -->
@if (\Request::is('sandwichuri') || \Request::is('detaliu-sandwich/*'))
<a href="sandwichuri" class="menu-item menu-item-selecter">Sandwichuri</a>
@else
<a href="sandwichuri" class="menu-item">Sandwichuri</a>
@endif
<div class="linie"></div>
<!--             <a href="gustari" class="menu-item">Gustari</a>
<div class="linie"></div> -->
@if (\Request::is('deserturi') || \Request::is('detaliu-desert/*'))
<a href="deserturi" class="menu-item menu-item-selecter">Deserturi</a>
@else
<a href="deserturi" class="menu-item">Deserturi</a>
@endif
<div class="linie"></div>
@if (\Request::is('bauturi') || \Request::is('detaliu-bautura/*'))
<a href="bauturi" class="menu-item menu-item-selecter">Bauturi</a>
@else
<a href="bauturi" class="menu-item">Bauturi</a>
@endif
</div>
<a href="cos" class="cos">
<div class="cos-imagine">
<img src="images/cos.svg" style="cos-imagine-img">
<div id="nr_prod" class="numar-produse">{{$numaratoare}}</div>
</div>
<div id="total_pret" class="pret">{{$total_cart}} lei</div>
</a>
</div>
<div class="header-menu-mobile">
<div class="container">
<div class="header-menu-mobile-container">
<div class="menu-sidenav"><img src="images/menu.svg" class="full-width"></div>
<a href="" class="mobile-logo"><img src="images/mobile-logo.svg" class="full-width"></a>
<a href="cos" class="mobile-cart"><img src="images/mobile-cart.svg" class="full-width"></a>
</div>
</div>
</div>
<div class = "header-produse-container">
<div class = "container">
<div class="header-produse">
<div class="swiper-container">
<div class="swiper-wrapper">
<div class="swiper-slide">
@if (\Request::is('pizza') || \Request::is('detaliu-pizza/*'))  
<a href = "pizza "class = "header-produse-item" style = "color:#FFD100">Pizza</a>
@else
<a href = "pizza" class = "header-produse-item">Pizza</a>
@endif
</div>
<div class="swiper-slide">
@if (\Request::is('paste') || \Request::is('detaliu-paste/*'))  
<a href = "paste" class = "header-produse-item" style = "color:#FFD100">Paste</a>
@else
<a href = "paste" class = "header-produse-item">Paste</a>
@endif
</div>
<div class="swiper-slide">
@if (\Request::is('salate') || \Request::is('detaliu-salata/*'))  
<a href = "salate"class = "header-produse-item" style = "color:#FFD100">Salate</a>
@else
<a href = "salate"class = "header-produse-item">Salate</a>
@endif
</div>
<div class="swiper-slide">
@if (\Request::is('sandwichuri') || \Request::is('detaliu-sandwich/*'))  
<a href = "sandwichuri"class = "header-produse-item" style = "color:#FFD100">Sandwichuri</a>
@else
<a href = "sandwichuri"class = "header-produse-item">Sandwichuri</a>
@endif
</div>
<div class="swiper-slide">
@if (\Request::is('deserturi') || \Request::is('detaliu-desert/*'))  
<a href = "deserturi"class = "header-produse-item" style = "color:#FFD100">Deserturi</a>
@else
<a href = "deserturi"class = "header-produse-item">Deserturi</a>
@endif
</div>
<div class="swiper-slide">
@if (\Request::is('bauturi') || \Request::is('detaliu-bautura/*'))  
<a href = "bauturi"class = "header-produse-item" style = "color:#FFD100">Bauturi</a>
@else
<a href = "bauturi"class = "header-produse-item">Bauturi</a>
@endif
</div>
</div>
<div class="swiper-scrollbar"></div>
</div>
</div>
</div>

</div>

</header>
