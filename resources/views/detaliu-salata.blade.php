
@extends('parts.template') @section('content')
<?php
    $tipDressingCesar     = $detaliu_salata['optionals'][0]['optionalsContent'][0];
    $tipDressingVinegreta = $detaliu_salata['optionals'][0]['optionalsContent'][1];
    $tipDressingFara      = $detaliu_salata['optionals'][0]['optionalsContent'][2];
?>
<div class="overlay-cos">
    <div class = "alege-cantitatea">
        <div class = "close-btn" id = "close-confirma"><img class = "full-width" src = "images/close.svg"></div>
        <div class = "magazin-inchis-text">Alege cantitatea</div>
        <div class = "adauga-cantitate">
            <div id="minus" class = "adauga-buton cursor-pointer" >-</div>
            <div class = "cantitate">1</div>
            <div id="plus" class = "adauga-buton cursor-pointer">+</div>
        </div>
        <div class = "confirma-btn" id = "fuck-yes" onclick="confirmaAdaugaSos()">Confirma</div>
        
    </div>
</div>

<div class="container page-container">
    <div class="breadcrumb-container">
        <a href="/" class="breadcrumb-element">Homepage</a>
        <div class="breadcrumb-line">|</div>
        <a href="/paste" class="breadcrumb-element">Paste</a>
        <div class="breadcrumb-line">|</div>
        <a href="/detaliu-paste/{{$detaliu_salata['productId']}}" class="breadcrumb-element">{{str_replace(" XXL", "",$detaliu_salata['name'])}}</a>
    </div>
    
    <div class = "pizza-container">
        <div class = "pizza-left">
            <img
            src = "{{isset($detaliu_salata['image']) ? Voyager::image($detaliu_salata['image']) : 'images/pizza.png'}}" class = "full-width-2 object-cover">
        </div>
        <div class = "pizza-right">
            <div class = "pizza-title-container">
                <div class = "pizza-title">{{str_replace(" XXL", "", $detaliu_salata['name'])}}</div>
                <div class = "pizza-pret-container">
                    <div id="pizza-pret" class  = "pizza-pret">{{number_format($detaliu_salata['price'],2)}}</div>
                    <div class  = "lei">lei</div>
                </div>
            </div>
            <div class = "ingrediente-title">Ingrediente:</div>
            <div class = "ingrediente-container">
                
                @if(isset($detaliu_salata['ingredienteBlocate']) && count($detaliu_salata['ingredienteBlocate']) > 0)
                @foreach($detaliu_salata['removableToppings'] as $ingredient)
                <div class = "ingredient">
                    @if(!in_array($ingredient['toppingId'], $detaliu_salata['ingredienteBlocate']))
                    <label class="checkbox">
                        <input type="checkbox" id="{{$ingredient['toppingId']}}" name="ingrediente" value="{{json_encode($ingredient)}}" checked>
                        <span></span>
                    </label>
                    @else
                    <div class="sos-tag-image" style="margin-right:10px;"><img src="images/x-button-small.svg" alt=""></div>
                    @endif
                    <div class = "ingredient-text">{{strtolower($ingredient['name'])}}</div>
                </div>
                @endforeach
                @else
                @foreach($detaliu_salata['removableToppings'] as $ingredient)
                <div class = "ingredient">
                    <label class="checkbox">
                        <input type="checkbox" id="{{$ingredient['toppingId']}}" name="ingrediente" value="{{json_encode($ingredient)}}" checked>
                        <span></span>
                    </label>
                    <div class = "ingredient-text">{{strtolower($ingredient['name'])}}</div>
                </div>
                @endforeach
                @endif
            </div>
            <div class = "ingredient-descriere">* Poti elimina ceea ce nu doresti si inlocui acel ingredient cu alt topping din aceeasi categorie (de ex. o leguma cu alta leguma), gratuit.</div>
            <div class = "ingrediente-title">Alege dressingul:</div>
            <div class = "dimensiune-container">
                    
                
                    
                    <div id="cesar" class = "dimensiune-item" onclick="selecteazaTipul('{{json_encode($tipDressingCesar)}}', 'cesar')">
                        <div class = "dimensiune-img" ><img src = "images/small.svg" class  ="full-width"></div>
                        <div class = "dimensiune-check-container">
                            
                            <div class = "ingredient-text">Cesar</div>
                        </div>
                    </div>
                    <div id="vinegreta" class = "dimensiune-item" onclick="selecteazaTipul('{{json_encode($tipDressingVinegreta)}}', 'vinegreta')">
                        <div class = "dimensiune-img" ><img src = "images/small.svg" class  ="full-width"></div>
                        <div class = "dimensiune-check-container">
                            
                            <div class = "ingredient-text">Vinegreta</div>
                        </div>
                    </div>

                    <div id="fara" class = "dimensiune-item" onclick="selecteazaTipul('{{json_encode($tipDressingFara)}}', 'fara')">
                            <div class = "dimensiune-img"><img src = "images/small.svg" class  ="full-width"></div>
                            <div class = "dimensiune-check-container">
                                
                                <div class = "ingredient-text">Fara Dressing</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class = "ingrediente-container-title">
                        <div class = "ingrediente-title">Adauga topping:</div>
                        <div class = "pizza-pret-container">
                            <div id="topping-pret" class  = "pizza-pret">0</div>
                            <div class  = "lei">lei</div>
                        </div>
                    </div>
                    <div id="topping-tag" class="sosuri-lista-tag">
                    </div>
                    <div></div>
                    <div id='topping-container' class = "topping-container">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if(isset($detaliu_salata['toppinguriBlocate']) && count($detaliu_salata['toppinguriBlocate']) > 0)
                                @foreach($extraToppingsSalate as $extra)
                                @if(!in_array($extra['productId'], $detaliu_salata['toppinguriBlocate']))
                                <div class="swiper-slide">
                                    <div id="{{$extra['productId']}}" class = "topping-item" onclick="adaugatopping('{{$extra['productId']}}', '{{$extra['name']}}', '{{$extra['price']}}')">
                                        <div class = "topping-image"><img class="icon-detaliu" src = "{{isset($extra['image']) ? Voyager::image($extra['image']) : 'images/dulce.svg'}}" class = "full-width"></div>
                                        <div class = "dimensiune-check-container sos-element">
                                            
                                            <div class = "ingredient-text">{{strtolower($extra['name'])}} <span class="no-wrap">
                                                ({{$extra['price']}} lei) 
                                                </span></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach($extraToppingsSalate as $extra)
                                    <div class="swiper-slide">
                                        <div id="{{$extra['productId']}}" class = "topping-item" onclick="adaugatopping('{{$extra['productId']}}', '{{$extra['name']}}', '{{$extra['price']}}')">
                                            <div class = "topping-image"><img class="icon-detaliu" src = "{{isset($extra['image']) ? Voyager::image($extra['image']) : 'images/dulce.svg'}}" class = "full-width"></div>
                                            <div class = "dimensiune-check-container sos-element">
                                                
                                                <div class = "ingredient-text">{{strtolower($extra['name'])}} <span class="no-wrap">
                                                    ({{$extra['price']}} lei)
                                                    </span></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <!--             <div class = "tip-sos">
                                <div class = "dimensiune-check-container sos-element">
                                    <label class="checkbox">
                                        <input type="checkbox" id="accept-privacy" name="terms" value="checkbox">
                                        <span></span>
                                    </label>
                                    <div class = "ingredient-text">Mozzarella</div>
                                </div>
                                <div class = "dimensiune-check-container sos-element">
                                    <label class="checkbox">
                                        <input type="checkbox" id="accept-privacy" name="terms" value="checkbox">
                                        <span></span>
                                    </label>
                                    <div class = "ingredient-text">Bacon</div>
                                </div>
                            </div> -->
                            <div class="despre-buton adauga-produs" onclick="adaugaInCos('{{$detaliu_salata['name']}}', '{{$detaliu_salata['productId']}}', '{{json_encode($detaliu_salata)}}')">
                                <div class="produs-buton-custom-text">Adauga in cos</div>
                                <div class="produs-buton-custom-img"><img src="images/despre.svg" class="full-width" style="object-fit:cover"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class = "recomandari">
                    <div class = "recomandari-title">Recomandari</div>
                    <div class = "container">
                        <div class="produse">
                            <div class="produs">
                                <a data-fancybox="gallery" href="images/pizza.png" class="lupa"><img src="images/lupa.svg" class="full-width"></a>
                                <a data-fancybox="gallery" href="images/pizza.png" class="produs-imagine">
                                    <img src="images/pizza.png" class="produs-img">
                                </a>
                                <div class="produs-title">Internationale</div>
                                <div class="produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
                                <div class="tags">
                                    <div class="tag"><div class="tag-text" style="color:#FFD100">Artigianale</div></div>
                                    <div class="tag"><div class="tag-text" style="color:#E3051B">Piccante</div></div>
                                </div>
                                <div class="produs-butoane">
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">L</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">XL</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-custom">
                                        <div class="produs-buton-custom-text">Cum vrei tu</div>
                                        <div class="produs-buton-custom-img"><img src="images/produs-custom.svg" class="full-width" style="object-fit:cover"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="produs">
                                <a data-fancybox="gallery" href="images/pizza.png" class="lupa"><img src="images/lupa.svg" class="full-width"></a>
                                <a data-fancybox="gallery" href="images/pizza.png" class="produs-imagine">
                                    <img src="images/pizza.png" class="produs-img">
                                </a>
                                <div class="produs-title">Internationale</div>
                                <div class="produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
                                <div class="tags">
                                    <div class="tag"><div class="tag-text" style="color:#FFD100">Artigianale</div></div>
                                    <div class="tag"><div class="tag-text" style="color:#E3051B">Piccante</div></div>
                                </div>
                                <div class="produs-butoane">
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">L</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">XL</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-custom">
                                        <div class="produs-buton-custom-text">Cum vrei tu</div>
                                        <div class="produs-buton-custom-img"><img src="images/produs-custom.svg" class="full-width" style="object-fit:cover"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="produs">
                                <a data-fancybox="gallery" href="images/pizza.png" class="lupa"><img src="images/lupa.svg" class="full-width"></a>
                                <a data-fancybox="gallery" href="images/pizza.png" class="produs-imagine">
                                    <img src="images/pizza.png" class="produs-img">
                                </a>
                                <div class="produs-title">Internationale</div>
                                <div class="produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
                                <div class="tags">
                                    <div class="tag"><div class="tag-text" style="color:#FFD100">Artigianale</div></div>
                                    <div class="tag"><div class="tag-text" style="color:#E3051B">Piccante</div></div>
                                </div>
                                <div class="produs-butoane">
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">L</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">XL</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-custom">
                                        <div class="produs-buton-custom-text">Cum vrei tu</div>
                                        <div class="produs-buton-custom-img"><img src="images/produs-custom.svg" class="full-width" style="object-fit:cover"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="produs">
                                <a data-fancybox="gallery" href="images/pizza.png" class="lupa"><img src="images/lupa.svg" class="full-width"></a>
                                <a data-fancybox="gallery" href="images/pizza.png" class="produs-imagine">
                                    <img src="images/pizza.png" class="produs-img">
                                </a>
                                <div class="produs-title">Internationale</div>
                                <div class="produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
                                <div class="tags">
                                    <div class="tag"><div class="tag-text" style="color:#FFD100">Artigianale</div></div>
                                    <div class="tag"><div class="tag-text" style="color:#E3051B">Piccante</div></div>
                                </div>
                                <div class="produs-butoane">
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">L</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-marime">
                                        <div class="produs-marime-container">
                                            <div class="produs-marime">XL</div>
                                            <div class="produs-cm">30 cm</div>
                                        </div>
                                        <div class="produs-pret">
                                            <div class="produs-pret-text">22.50 lei</div>
                                        </div>
                                        <div class="produs-pret-img"><img class="full-width" style="object-fit:cover;" src="images/buton-cart.svg"></div>
                                    </div>
                                    <div class="produs-buton-custom">
                                        <div class="produs-buton-custom-text">Cum vrei tu</div>
                                        <div class="produs-buton-custom-img"><img src="images/produs-custom.svg" class="full-width" style="object-fit:cover"></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endsection
                @push('scripts')
                <script>
                    var selected = null
                    function selecteazaTipul(data, tip){
                        $('#vinegreta').removeClass('topping-cos-checked')
                        $('#cesar').removeClass('topping-cos-checked')
                        $('#fara').removeClass('topping-cos-checked')
                        $('#'+tip).addClass('topping-cos-checked')

                        selected = JSON.parse(data)
                    }
                    $(document).ready(function(){
                        $swiperSlides = 4;
                        if(screen.width<=1366)
                        $swiperSlides = 2;
                        if(screen.width<=1024)
                        $swiperSlides = 3;
                        
                        var toppingSwiper = new Swiper('.topping-container .swiper-container', {
                            slidesPerView: $swiperSlides,
                            spaceBetween: 30,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        });
                        var toppingSwiper1 = new Swiper('.sos-swiper .swiper-container', {
                            slidesPerView: $swiperSlides,
                            spaceBetween: 30,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        });
                    });
                    var toppings = []
                    function adaugatopping(id, name, price){
                        if($("#topping-container #"+id).hasClass('topping-cos-checked')){
                            $("#topping-container #"+id).removeClass('topping-cos-checked');
                            $("#topping-container #"+id+" .topping-image img").css('filter', '');
                            removetopping(id)
                        }else{
                            $("#topping-container #"+id).addClass('topping-cos-checked');
                            $("#topping-container #"+id+" .topping-image img").css('filter', 'brightness(1)');
                            var topping = {}
                            topping['name'] = name
                            topping['productId'] = parseInt(id)
                            topping['price'] = parseFloat(price)
                            toppings.push(topping)
                        }
                        console.log("toppings", toppings)
                        adaugataguritoppings()
                        settoppingprice()
                    }
                    
                    function removetopping(id){
                        $("#topping-container #"+id).removeClass('topping-cos-checked');
                        $("#topping-container #"+id+" .topping-image img").css('filter', '');
                        toppings.forEach(function (topping, index){
                            if(topping.productId == id){
                                toppings.splice(index, 1);
                            }
                        })
                        adaugataguritoppings()
                        settoppingprice()
                    }
                    function adaugataguritoppings(){
                        html = ''
                        toppings.forEach(function (topping, index){
                            html+=            '<div class="sos-tag-wrapper">'
                                html+=               '<div class="sos-tag">'
                                    html+=                    '<div class="sos-tag-image" onclick="removetopping('+topping.productId+')"><img src="images/x-button-small.svg" alt=""></div>'
                                    html+=                    '<p>'+topping.name+'</p>'
                                    html+=                '</div>'
                                    html+=            '</div>'
                                })
                                $('#topping-tag').empty();
                                $('#topping-tag').append(html);
                            }
                                    function settoppingprice(){
                                        var price = 0
                                        toppings.forEach(function (topping, index){
                                            price += topping.price
                                        })
                                        $('#topping-pret').text(price)
                                    }
                                    function setsosprice(){
                                        var price = 0
                                        sosuri.forEach(function (sos, index){
                                            price += sos.price*sos.cantitate
                                        })
                                        $('#sos-pret').text(price)
                                    }
                                    
                                    function adaugaInCos(name, id, data){
                                        var options = JSON.parse(data);
                                        var removed = []
                                        $('input[name="ingrediente"]:not(:checked)').each(function() {
                                        removed.push(JSON.parse(this.value))
                                        })
                                        if(removed.length > 0){
                                        console.log(removed)
                                        options['removed'] = removed
                                        }
                                        var total = parseFloat($('#pizza-pret').text())
                                        options['extra'] = toppings
                                        if(!selected){
                                            return Notiflix.Notify.Failure("Alege dressingul");
                                        }
                                        options['optionals'] = selected
                                        console.log("name", name)
                                        console.log("price", total)
                                        console.log("toppings", toppings)
                                        options = JSON.stringify(options)
                                        quick_add_to_cart(id, name, total, options)
                                    }
                                </script>
                                @endpush