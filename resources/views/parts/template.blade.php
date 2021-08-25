<!DOCTYPE html>
<html>

<head>
  <base href="{{ URL::to('/') }}" />
  <title>Pizza San Marco</title>
  <meta charset="utf-8" />
  <meta name="description" content="@yield('description')" />
  <meta name="keywords" content="@yield('keywords')" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{ URL::asset('favicon.png') }}" type="image/x-icon"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- responsive use only -->
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/responsive.css" rel="stylesheet" type="text/css" />
  <link href="css/aos.css" rel="stylesheet" type="text/css" />
  <link href="css/fancybox.min.css" rel="stylesheet" type="text/css" />
  <link href="css/swiper.min.css" rel="stylesheet" type="text/css" />
  <!-- responsive use only -->
  @stack('styles')
</head>

<body>
  
  <div class="overlay">
    <div class = "login">
          <div class = "close-btn" id = "close-log-in"><img class = "full-width" src = "images/close.svg"></div>
          <div class = "magazin-inchis-title">Log in</div>
            <input id="login-email" type="email" name="email" placeholder="Email" class="">
            <input id="login-password" type="password" name="password" placeholder="Parola" class="">
              <div class="termeni">
                <label class="checkbox">
                    <input type="checkbox" id="accept-privacy" name="terms" value="checkbox">
                    <span></span>
                </label>
                <div class="termeni-text">Da, sunt de acord cu Politica de confidentialitate.</div>
            </div>
              <button class = "despre-buton">
                <div class = "produs-buton-custom-text" onclick="login()">LOG IN</div>
                <div class = "produs-buton-custom-img"><img src = "images/despre.svg" class = "full-width" style = "object-fit:cover"></div>
            </button>
            {{-- <button class = "facebook-button">Login cu facebook</button> --}}
            {{-- <div id="recuperare-buton" class = "uitat-parola">Ai uitat parola? Click aici</div> --}}
    </div>
    <div class = "recuperare">
          <div class = "close-btn" id = "close-recuperare"><img class = "full-width" src = "images/close.svg"></div>
          <div class = "magazin-inchis-title">Recuperare parola</div>
          <div class = "magazin-inchis-text">Nici o problema, o sa-ti trimitem un link pe email pentru a modifica parola.</div>
          <form class = "cont-nou-form">
            <input type="email" name="email" placeholder="Email" class="">
              <button class = "despre-buton">
                <div class = "produs-buton-custom-text">TRIMITE PAROLA</div>
                <div class = "produs-buton-custom-img"><img src = "images/despre.svg" class = "full-width" style = "object-fit:cover"></div>
            </button>
          </form>
    </div>
    <div class = "cont-nou">
        <div class = "close-btn" id = "close-cont-nou"><img class = "full-width" src = "images/close.svg"></div>
        <div class = "magazin-inchis-title">CONT NOU</div>
        <div class = "magazin-inchis-text">Creeaza un cont nou pentru a face mai rapid o comanda.</div>

          <input id="register-name" type="text" name="name" placeholder="Nume" class="">
          <input id="register-prenume" type="text" name="prenume" placeholder="Prenume" class="">
          <input id="register-email" type="email" name="email" placeholder="Email" class="">
          <input id="register-telefon" type="text" name="telefon" placeholder="Telefon" class="">
          <input id="register-password" type="password" name="password" placeholder="Parola" class="">
            <div class="termeni">
              <label class="checkbox">
                  <input type="checkbox" id="accept-privacy" name="terms" value="checkbox">
                  <span></span>
              </label>
              <div class="termeni-text">Da, sunt de acord cu Politica de confidentialitate.</div>
          </div>
            <button class = "despre-buton" onclick="register()">
              <div class = "produs-buton-custom-text">INREGISTRARE</div>
              <div class = "produs-buton-custom-img"><img src = "images/despre.svg" class = "full-width" style = "object-fit:cover"></div>
          </button>
          <!-- <button class = "facebook-button">Inregistrare cu facebook</button> -->
          <div style="margin-top: 10px;" id="cont-existent" class = "ai-cont">Ai deja cont? Log in aici</div>

    </div> 
    
    <div class = "super-oferta">
        <div class = "close-btn" id = "close-oferta"><img class = "full-width" src = "images/close.svg"></div>
        <div class = "super-oferta-img"><img src = "images/super-oferta.png" class = "full-width object-cover"></div>
        <div class = "magazin-inchis-title">Super oferta</div>
        <div class = "magazin-inchis-text">Doar in perioada 1 Iulie - 15 Iulie toate produsele noastre sunt la 10% reducere.
          Profita acum de oferta!
        </div>
        <a href = "" class = "despre-buton">
          <div class = "produs-buton-custom-text">Cumpara</div>
          <div class = "produs-buton-custom-img"><img src = "images/despre.svg" class = "full-width" style = "object-fit:cover"></div>
        </a>
      </div>
      <div class = "magazin-inchis">
        <div class = "close-btn" id = "close-magazin"><img class = "full-width" src = "images/close.svg"></div>
        <div class = "magazin-inchis-image"><img src = "images/zzz.svg" class = "full-width"></div>
        <div class = "magazin-inchis-title">Magazinul este inchis</div>
        <div class = "magazin-inchis-text">Te asteptam intre 10:00 si 22:00, de Luni pana Duminica pentru comenzi online sau la telefon.</div>
      </div> 
  </div>

  <div id="page">
<!--      <div class = "overlay"> 
      
      
       
  
      
       <div class = "detaliu-cos">
        <div class = "close-btn" id = "close-comanda"><img class = "full-width" src = "images/close-black.svg"></div>
        <div class = "detaliu-cos-top">
          <div class = "detaliu-cos-title">Comanda: 001</div>
          <div class = "detaliu-cos-data">22.06.2020</div>
          <div class = "detaliu-cos-comanda-container">
            <div class = "detaliu-cos-produs">
              <div class = "detaliu-cos-produs-left">
                <div class = "detaliu-cos-imagine"><img src = "images/pizza.png" class = "full-width object-contain"></div>
                <div class = "detaliu-cos-descriere">
                  <div class = "detaliu-cos-descriere-titlu">Pizza San Marco</div>
                  <div class = "detaliu-cos-descriere-informatii">L (30 cm); Sos: Dulce; 
                    Topping: Mozzarella (3 lei), Ciuperci (2.5 lei)</div>
                    <div class = "detaliu-cos-produs-right desktop-hidden">
                      <div class = "detaliu-cos-cantitate">X1</div>
                      <div class = "detaliu-cos-pret">32.00 Lei</div>
                  </div>
                </div>
              </div>
              <div class = "detaliu-cos-produs-right mobile-hidden">
                  <div class = "detaliu-cos-cantitate">X1</div>
                  <div class = "detaliu-cos-pret">32.00 Lei</div>
              </div>
            </div>
            <div class = "detaliu-cos-produs">
              <div class = "detaliu-cos-produs-left">
                <div class = "detaliu-cos-imagine"><img src = "images/pizza.png" class = "full-width object-contain"></div>
                <div class = "detaliu-cos-descriere">
                  <div class = "detaliu-cos-descriere-titlu">Pizza San Marco</div>
                  <div class = "detaliu-cos-descriere-informatii">L (30 cm); Sos: Dulce; 
                    Topping: Mozzarella (3 lei), Ciuperci (2.5 lei)</div>
                    <div class = "detaliu-cos-produs-right desktop-hidden">
                      <div class = "detaliu-cos-cantitate">X1</div>
                      <div class = "detaliu-cos-pret">32.00 Lei</div>
                  </div>
                </div>
              </div>
              <div class = "detaliu-cos-produs-right mobile-hidden">
                  <div class = "detaliu-cos-cantitate">X1</div>
                  <div class = "detaliu-cos-pret">32.00 Lei</div>
              </div>
            </div>
            <div class = "detaliu-cos-produs">
              <div class = "detaliu-cos-produs-left">
                <div class = "detaliu-cos-imagine"><img src = "images/pizza.png" class = "full-width object-contain"></div>
                <div class = "detaliu-cos-descriere">
                  <div class = "detaliu-cos-descriere-titlu">Pizza San Marco</div>
                  <div class = "detaliu-cos-descriere-informatii">L (30 cm); Sos: Dulce; 
                    Topping: Mozzarella (3 lei), Ciuperci (2.5 lei)</div>
                    <div class = "detaliu-cos-produs-right desktop-hidden">
                      <div class = "detaliu-cos-cantitate">X1</div>
                      <div class = "detaliu-cos-pret">32.00 Lei</div>
                  </div>
                </div>
              </div>
              <div class = "detaliu-cos-produs-right mobile-hidden">
                  <div class = "detaliu-cos-cantitate">X1</div>
                  <div class = "detaliu-cos-pret">32.00 Lei</div>
              </div>
            </div>
          </div>
        </div>
        <div class = "detaliu-cos-bottom">
            <div class = "puncte-acumulate">Puncte acumulate: 2</div>
            <div class = "detaliu-cos-informatii">
              <div class= "detaliu-cos-informatii-element-container">
                <div class = "detaliu-cos-informatii-element">Transport:</div>
                <div class = "detaliu-cos-informatii-element">5.00 lei</div>
              </div>
              <div class= "detaliu-cos-informatii-element-container">
                <div class = "detaliu-cos-informatii-element">Sub-total:</div>
                <div class = "detaliu-cos-informatii-element">5.00 lei</div>
              </div>
              <div class= "detaliu-cos-informatii-element-container">
                <div class = "detaliu-cos-informatii-element">Discount puncte:</div>
                <div class = "detaliu-cos-informatii-element">5.00 lei</div>
              </div>
              <div class = "detaliu-cos-total">
                <div class = "detaliu-cos-total-element">TOTAL: 3 produse</div>
                <div class = "detaliu-cos-total-element">72.00 lei</div>
              </div>
              <button class = "despre-buton retrimite-comanda">
                <div class = "produs-buton-custom-text">Retrimite comanda</div>
                <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
            </button>
            </div>
        </div>
      </div>  -->
<!--     </div>  -->
    <div class = "sidenav">
      <div class = "container full-height">
        <div class = "close-sidenav"><img src = "images/close-sidenav.svg" class = "full-width"></div>
        <div class = "sidenav-container">
          <div class = "sidenav-inside">
            <a href = "cont" id = "login-btn" class="produs-banner-buton">
              <div class="produs-buton-custom-text">Log in</div>
              <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </a>
            <a href = "despre" class = "sidenav-element">Despre San marco</a>
            <a href = "restaurant" class = "sidenav-element">Restaurante</a>
            <a href = "contact" class = "sidenav-element">Contact</a>
            <div class = "sidenav-social">
              <a href = "" class  ="header-social-link"><img style = "width:100%;height:100%;" src = "images/header-facebook.svg"></a>
              <a href = "" class  ="header-social-link"><img style = "width:100%;height:100%;" src = "images/header-instagram.svg"></a>
            </div>
            <div class = "comenzi-telefonice">
              <div class = "comenzi-telefonice-text">Comenzi telefonice:</div>
              <a href = "" class = "comenzi-telefonice-text">0241 858 888</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('parts.header')
    <div id="wrapper" class="slide-right">
      <main id="content">
        @yield('content')
      </main>
        @include('parts.footer')
    </div>
  </div>
  <button class="scroll-up"> <img src="images/arrow.svg"> </button>

  <!--[if lt IE 9]> <script src="js/html5shiv.js"></script> <![endif]-->
  <script src="js/jquery.js" type="text/javascript"></script>
  <script src="js/common.js" type="text/javascript"></script>
  <script src="js/aos.js" type="text/javascript"></script>
  <script src="js/fancybox.min.js" type="text/javascript"></script>
  <script src="js/swiper.min.js" type="text/javascript"></script>
  <script src="js/main.js" type="text/javascript"></script>
  <script src="js/notiflix-aio.js" type="text/javascript"></script>
  <script>
  $( document ).ready(function() {
    if(location.hash == '#login'){
      $('.login').css('display','flex');
        $('.overlay').css('display','flex');
    }
  });
  


  function register(){
  $.ajax({
            url  : '/register',
            type :  'POST',
            data: 
            {
              name: $('#register-name').val(),
              prenume: $('#register-prenume').val(),
              email: $('#register-email').val(),
              parola: $('#register-password').val(),
              telefon: $('#register-telefon').val(),
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              console.log('success', resp)
              
              if(resp.success == true){
              location.reload();
              }else{
                if(Array.isArray(resp.msg)){
                  resp.msg.forEach(function(msg){
                    Notiflix.Notify.Failure(msg);
                  })
                }else{
                  Notiflix.Notify.Failure(resp.msg);
                }
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
            },
          })
}
function login(){
  $.ajax({
            url  : '/login',
            type :  'POST',
            data: 
            {
              email: $('#login-email').val(),
              parola: $('#login-password').val(),
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              
              $('#login-email').val('')
              $('#login-password').val('')
              if(resp.success == true){
              console.log('success', resp)
              window.location.hash = ''
              location.reload();
              
              }else{
                if(Array.isArray(resp.msg)){
                  resp.msg.forEach(function(msg){
                    Notiflix.Notify.Failure(msg);
                  })
                }else{
                  Notiflix.Notify.Failure(resp.msg);
                }
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
              Notiflix.Notify.Failure('Sol lucet omnibus');
            },
          })
}

  </script>
  @stack('scripts')
</body>

</html>