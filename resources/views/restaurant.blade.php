@extends('parts.template') @section('content')
<div class="container page-container">
    <div class="breadcrumb-container">
        <a href="" class="breadcrumb-element">Homepage</a>
        <div class="breadcrumb-line">|</div>
        <a href="" class="breadcrumb-element">Restaurant</a>
    </div>
    <div class="page-title">Restaurant</div>
    <div class="despre">
        <div class="despre-left" data-aos="fade-right">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum.
        </div>
        <div class="despre-right despre-right-restaurant" data-aos="fade-left">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                  <div class="swiper-slide"><a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-imagine"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a></div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class = "restaurant-poze">
      <a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-poza"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a>
      <a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-poza"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a>
      <a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-poza"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a>
      <a data-fancybox="gallery" href="images/restaurant-poza.png" class = "restaurant-poza"><img src = "images/restaurant-poza.png" class = "full-width object-cover"></a>
    </div>

    <div class="despre reverse-row">
        <div class="despre-left" data-aos="fade-right">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum.
        </div>
        <div class="despre-right" data-aos="fade-left"><img src="images/despre.jpg" class="full-width object-cover"></div>
    </div>

    <div class = "map-container">
        <img src = "images/map.png" class = "full-width object-cover">
    </div>
</div>
@endsection
@push('scripts')
<script>
    var swiperRestaurant = new Swiper('.restaurant-poze .swiper-container', {
      slidesPerView: 4,
      spaceBetween: 30,
      freeMode: true,
    });
    var RestaurantPoze = new Swiper('.despre-right .swiper-container', {
        pagination: {
        el: '.swiper-pagination',
      },
    });
  </script>
@endpush