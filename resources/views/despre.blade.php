@extends('parts.template') @section('content')
<div class="container page-container">
    <div class="breadcrumb-container">
        <a href="" class="breadcrumb-element">Homepage</a>
        <div class="breadcrumb-line">|</div>
        <a href="" class="breadcrumb-element">Despre noi</a>
    </div>
    <div class="page-title">Despre noi</div>
    <div class="despre">
        <div class="despre-left" data-aos="fade-right">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum.
        </div>
        <div class="despre-right" data-aos="fade-left"><img src="images/despre.jpg" class="full-width object-cover"></div>
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
    <div class = "despre-contact">
        <div class = "despre-contact-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </div>
        <a href = "contact" class = "despre-buton">
            <div class = "produs-buton-custom-text">CONTACTEAZA-NE</div>
            <div class = "produs-buton-custom-img"><img src = "images/despre.svg" class = "full-width" style = "object-fit:cover"></div>
        </a>
    </div>
    <div class = "restaurante" style = "background-color: transparent;">
        <div class = "restaurante-container" style = "margin-top: 0">
            <div class = "restaurant">
                <div class = "restaurant-title">San marco - I.C. Bratianu</div>
                <div class = "restaurant-image"><img src = "images/restaurant.png" class = "full-width object-cover"></div>
                <div class = "restaurant-descriere">I.C. Bratianu 48 - Constanta</div>
            </div>
            <div class = "restaurant">
                <div class = "restaurant-title">San marco - I.C. Bratianu</div>
                <div class = "restaurant-image"><img src = "images/restaurant.png" class = "full-width object-cover"></div>
                <div class = "restaurant-descriere">I.C. Bratianu 48 - Constanta</div>
            </div>
        </div>

    </div>
</div>
@endsection