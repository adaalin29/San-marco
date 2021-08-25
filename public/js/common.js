 $(document).ready(function() {
    AOS.init();
    $( ".cont-select" ).on('change',function(){
        if($('.cont-select').val()=='date-personale'){
            $('.puncte-container').hide().fadeOut();
            $('.adrese-container').hide().fadeOut();
            $('.istoric-comenzi').hide().fadeOut();
            $('.cont').hide().fadeIn();
            $('.adauga-adresa').hide().fadeOut();
        }
        if($('.cont-select').val()=='punctele-mele'){
            $('.adrese-container').hide().fadeOut();
            $('.istoric-comenzi').hide().fadeOut();
            $('.cont').hide().fadeOut();
            $('.puncte-container').hide().fadeIn();
            $('.adauga-adresa').hide().fadeOut();
        }
        if($('.cont-select').val()=='adrese-livrare'){
            $('.puncte-container').hide().fadeOut();
            $('.istoric-comenzi').hide().fadeOut();
            $('.cont').hide().fadeOut();
            $('.adrese-container').hide().fadeIn();
            $('.adauga-adresa').hide().fadeOut();
        }
        if($('.cont-select').val()=='istoric-comenzi'){
            $('.puncte-container').hide().fadeOut();
            $('.adrese-container').hide().fadeOut();
            $('.cont').hide().fadeOut();
            $('.istoric-comenzi').hide().fadeIn();
            $('.adauga-adresa').hide().fadeOut();
        }
    });

	$('.menu-sidenav').click(function(){
        $('.sidenav').css('left','0%');
    });
	$('.close-sidenav').click(function(){
        $('.sidenav').css('left','100%');
    });

	$(window).scroll(function() {
        if($(window).scrollTop() > 0) {
            $(".scroll-up").css("display","block");
        } else {
            $(".scroll-up").css("display","none");
        }

        if($(window).scrollTop() > 10) {
            $('.header-menu').css('position','fixed');
            $('.header-menu').css('top','0%');
            $('.logo').css('height','80px');
        } else {
            $('.header-menu').css('position','initial');
            $('.logo').css('height','120px');
        }
    }); 

    $(".scroll-up").click(function() {
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    });

    // inchide magazin

    $('#close-magazin').click(function(){
        $('.magazin-inchis').show().fadeOut();
        $('.overlay').show().fadeOut();

    });
    $('#close-cont-nou').click(function(){
        $('.cont-nou').css('display','none');
        $('.overlay').css('display','none');

    });
    $('#close-log-in').click(function(){
        $('.login').css('display','none');
        $('.overlay').css('display','none');

    });
    $('#login-button').click(function(){
        $('.login').css('display','flex');
        $('.overlay').css('display','flex');

    });
    $('#super-oferta-button').click(function(){
        $('.super-oferta').css('display','flex');
        $('.overlay').css('display','flex');

    });
    $('#confirma-actiunea-button').click(function(){
        $('.confirma-actiunea').css('display','flex');
        $('.overlay').css('display','flex');

    });
    $('#magazin-inchis-button').click(function(){
        $('.magazin-inchis').css('display','flex');
        $('.overlay').css('display','flex');

    });
    
    $('#detaliu-cos-button').click(function(){
        $('.detaliu-cos').css('display','grid');
        $('.overlay').css('display','flex');

    });
    $('#cont-existent').click(function(){
        $('.login').css('display','flex');
        $('.cont-nou').css('display','none');

    });
    $('#register-button').click(function(){
        $('.cont-nou').css('display','flex');
        $('.overlay').css('display','flex');

    });
    $('#close-recuperare').click(function(){
        $('.recuperare').css('display','none');
        $('.login').css('display','flex');

    });
    $('#recuperare-buton').click(function(){
        $('.login').css('display','none');
        $('.recuperare').css('display','flex');

    });
    $('#close-oferta').click(function(){
        $('.super-oferta').show().fadeOut();
        $('.overlay').show().fadeOut();

    });

    $('#ai-cont').click(function(){
        $('.cont-nou').show().fadeOut();
        $('.login').show().fadeIn();
    });

    $('#date-personale').click(function(){
        $('.puncte-container').hide().fadeOut();
        $('.adrese-container').hide().fadeOut();
        $('.istoric-comenzi').hide().fadeOut();
        $('.cont-item').css('color','#FFFFFF');
        $(this).css('color','#FFD101');
        $('.cont').hide().fadeIn();
        $('.adauga-adresa').hide().fadeOut();
    });
    $('#punctele-mele').click(function(){
        $('.adrese-container').hide().fadeOut();
        $('.istoric-comenzi').hide().fadeOut();
        $('.cont').hide().fadeOut();
        $('.cont-item').css('color','#FFFFFF');
        $(this).css('color','#FFD101');
        $('.puncte-container').hide().fadeIn();
        $('.adauga-adresa').hide().fadeOut();
    });
    $('#adrese-livrare').click(function(){
        $('.puncte-container').hide().fadeOut();
        $('.istoric-comenzi').hide().fadeOut();
        $('.cont').hide().fadeOut();
        $('.cont-item').css('color','#FFFFFF');
        $(this).css('color','#FFD101');
        $('.adrese-container').hide().fadeIn();
        $('.adauga-adresa').hide().fadeOut();
    });
    $('#istoric-comenzi').click(function(){
        $('.puncte-container').hide().fadeOut();
        $('.adrese-container').hide().fadeOut();
        $('.cont').hide().fadeOut();
        $('.cont-item').css('color','#FFFFFF');
        $(this).css('color','#FFD101');
        $('.istoric-comenzi').hide().fadeIn();
        $('.adauga-adresa').hide().fadeOut();
    });

    $headerSwiperSlides = 4
    if(screen.width<=1024)
        $headerSwiperSlides = 5
    if(screen.width<=768)
        $headerSwiperSlides = 4
    var headerSwiper = new Swiper('.header-produse .swiper-container', {
        scrollbar: {
            el: '.swiper-scrollbar',
            hide: false,
          },
          slidesPerView: $headerSwiperSlides,
      });
})