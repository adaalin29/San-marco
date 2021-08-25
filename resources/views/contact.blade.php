@extends('parts.template') @section('content')
<div class="container page-container">
    <div class="breadcrumb-container">
        <a href="" class="breadcrumb-element">Homepage</a>
        <div class="breadcrumb-line">|</div>
        <a href="" class="breadcrumb-element">Contact</a>
    </div>
    <div class="page-title titlu-left">CONTACTEAZA-NE!</div>
    <div class="contact-container">
        <form class="contact-left">
            <div class="contact-descriere contact-descriere-left">Ai intrebari? Lasa-ne un mesaj in acest formular</div>
            <input type="text" name="name" placeholder="Nume" class="">
            <input type="text" name="email" placeholder="Email" class="">
            <textarea name="message" placeholder="Mesaj" class=""></textarea>
            <div class="termeni">
                <label class="checkbox">
                    <input type="checkbox" id="accept-privacy" name="terms" value="checkbox">
                    <span></span>
                </label>
                <div class="termeni-text">Da, sunt de acord cu <a href = "" style = "color:#FFD100">Politica de confidentialitate.</a></div>
            </div>
            <button class = "despre-buton contact-button">
                <div class = "produs-buton-custom-text">TRIMITE</div>
                <div class = "produs-buton-custom-img"><img src = "images/despre.svg" class = "full-width" style = "object-fit:cover"></div>
            </button>
        </form>
        <div class="contact-right">
            <div class = "contact-titlu">Program de lucru:</div>
            <div class = "contact-descriere">Luni-Duminic, 10:00-22:00</div>
            <div class = "contact-titlu">Contact:</div>
            <div class = "contact-descriere">0733 968 615</div>
            <div class = "contact-titlu">Adrese:</div>
            <div class = "contact-descriere">
                I. C. Bratianu 48, Constanta<br>
                A. Lapusneanu 116 C, City Mall, et. 1
            </div>

        </div>

    </div>
    <div class="map-container">
        <img src="images/map.png" class="full-width object-cover">
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