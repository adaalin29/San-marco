
@extends('parts.template') @section('content')
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
    <a href="/pizza" class="breadcrumb-element">Pizza</a>
    <div class="breadcrumb-line">|</div>
    <a href="/detaliu-pizza/{{$detaliu_pizza['productId']}}" class="breadcrumb-element">{{str_replace(" XXL", "",$detaliu_pizza['name'])}}</a>
  </div>
  
  <div class = "pizza-container">
    <div class = "pizza-left">
      <img
      src = "{{isset($detaliu_pizza['image']) ? Voyager::image($detaliu_pizza['image']) : 'images/pizza.png'}}" class = "full-width-2 object-cover">
    </div>
    <div class = "pizza-right">
      <div class = "pizza-title-container">
        <div class = "pizza-title">{{str_replace(" XXL", "", $detaliu_pizza['name'])}}</div>
        <div class = "pizza-pret-container">
          <div id="pizza-pret" class  = "pizza-pret">{{number_format($detaliu_pizza['price'],2)}}</div>
          <div class  = "lei">lei</div>
        </div>
      </div>
      <div class = "ingrediente-title">Ingrediente:</div>
      <div class = "ingrediente-container">
        
        @if(isset($detaliu_pizza['ingredienteBlocate']) && count($detaliu_pizza['ingredienteBlocate']) > 0)
        @foreach($detaliu_pizza['removableToppings'] as $ingredient)
        <div class = "ingredient">
          @if(!in_array($ingredient['toppingId'], $detaliu_pizza['ingredienteBlocate']))
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
        @foreach($detaliu_pizza['removableToppings'] as $ingredient)
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
      <div class = "ingrediente-title">Alege dimensiunea:</div>
      <div class = "dimensiune-container">
        @if(str_contains($detaliu_pizza['name'], "XXL"))
        <div id="pizza-mica" class = "dimensiune-item" onclick="location.href='/detaliu-pizza/{{$detaliu_pizza['productId']-1}}'">
          @else
          <div id="pizza-mica" class = "dimensiune-item">
            @endif
            <div class = "dimensiune-img"><img src = "images/small.svg" class  ="full-width"></div>
            <div class = "dimensiune-check-container">
              
              <div class = "ingredient-text">L(30 cm)</div>
            </div>
          </div>
          @if(str_contains($detaliu_pizza['name'], "XXL"))
          <div id="pizza-mare" class = "dimensiune-item">
            @else
            <div id="pizza-mare" class = "dimensiune-item" onclick="location.href='/detaliu-pizza/{{$detaliu_pizza['productId']+1}}'">
              @endif
              <div class = "dimensiune-img-big"><img src = "images/small.svg" class  ="full-width"></div>
              <div class = "dimensiune-check-container">
                
                <div class = "ingredient-text">XXL(50 cm)</div>
              </div>
            </div>
          </div>
          <div class = "ingrediente-container-title">
            <div class = "ingrediente-title">Adauga sosuri:</div>
            <div class = "pizza-pret-container">
              <div id="sos-pret" class  = "pizza-pret">0</div>
              <div class  = "lei">lei</div>
            </div>
          </div>
          <div id="sosuri-tag" class="sosuri-lista-tag">
          </div>
          <div class = "topping-container sos-swiper">
            <div class="swiper-container">
              <div class="swiper-wrapper">
                @foreach($sosuri as $sos)
                
                <div class="swiper-slide">
                  <div id="{{$sos['productId']}}" class = "topping-item" onclick="adaugasos('{{$sos['productId']}}', '{{$sos['name']}}', '{{$sos['price']}}')">
                    <div class = "topping-image"><img class="icon-detaliu" src = "{{isset($sos['image']) ? Voyager::image($sos['image']) : 'images/dulce.svg'}}" class  ="full-width"></div>
                    <div class = "dimensiune-check-container sos-element">
                      
                      <div class = "ingredient-text">{{ucfirst(strtolower(str_replace('SOS ', '', $sos['name'])))}} <span class="no-wrap">({{$sos['price']}} lei)</span></div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
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
                @if(isset($detaliu_pizza['toppinguriBlocate']) && count($detaliu_pizza['toppinguriBlocate']) > 0)
                @foreach($extraToppingsPizza as $extra)
                @if(!in_array($extra['productId'], $detaliu_pizza['toppinguriBlocate']))
                <div class="swiper-slide">
                  <div id="{{$extra['productId']}}" class = "topping-item" onclick="adaugatopping('{{$extra['productId']}}', '{{$extra['name']}}', '{{$extra['price']}}')">
                    <div class = "topping-image"><img class="icon-detaliu" src = "{{isset($extra['image']) ? Voyager::image($extra['image']) : 'images/dulce.svg'}}" class = "full-width"></div>
                    <div class = "dimensiune-check-container sos-element">
                      
                      <div class = "ingredient-text">{{strtolower($extra['name'])}} <span class="no-wrap">
                        @if(str_contains($detaliu_pizza['name'], "XXL")) 
                        ({{$extra['price']*3}} lei) 
                        @else 
                        ({{$extra['price']}} lei) 
                        @endif</span></div>
                      </div>
                    </div>
                  </div>
                  @endif
                  @endforeach
                  @else
                  @foreach($extraToppingsPizza as $extra)
                  <div class="swiper-slide">
                    <div id="{{$extra['productId']}}" class = "topping-item" onclick="adaugatopping('{{$extra['productId']}}', '{{$extra['name']}}', '{{$extra['price']}}')">
                      <div class = "topping-image"><img class="icon-detaliu" src = "{{isset($extra['image']) ? Voyager::image($extra['image']) : 'images/dulce.svg'}}" class = "full-width"></div>
                      <div class = "dimensiune-check-container sos-element">
                        
                        <div class = "ingredient-text">{{strtolower($extra['name'])}} <span class="no-wrap">
                          @if(str_contains($detaliu_pizza['name'], "XXL")) 
                          ({{$extra['price']*3}} lei) 
                          @else 
                          ({{$extra['price']}} lei) 
                          @endif</span></div>
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
              <div class="despre-buton adauga-produs" onclick="adaugaInCos('{{$detaliu_pizza['name']}}', '{{$detaliu_pizza['productId']}}', '{{json_encode($detaliu_pizza)}}')">
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
          @if(str_contains($detaliu_pizza['name'], "XXL"))
          var marime = 'mare'
          @else
          var marime = 'mica'
          @endif
          $(document).ready(function(){
            
            if(marime == 'mica'){
              $('#pizza-mica').css('filter', 'brightness(1)')
              $('#pizza-mica').css('border', '1px solid #FFD100')
              $('#pizza-mica').css('color', '#FFD100')
              $('#pizza-mica img').css('filter', 'unset')
            }else{
              $('#pizza-mare').css('filter', 'brightness(1)')
              $('#pizza-mare').css('border', '1px solid #FFD100')
              $('#pizza-mare').css('color', '#FFD100')
              $('#pizza-mare img').css('filter', 'unset')
            }
            
            $('.checkbox-marime').click(function() {
              if($(this).prop('checked')==false){
                $(this).prop('checked',true);
              }else if($(this).prop('checked')==true){
                $(this).prop('checked',false);
              }
            });
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
          var sosuri = []
          var selectedSos= {}
          function adaugasos(id, name, price){
            if($("#"+id).hasClass('topping-cos-checked')){
              $("#"+id).removeClass('topping-cos-checked');
              $("#"+id+" .dimensiune-img img").css('filter', '');
              removesos(id)
            }else{
              $('.overlay-cos').css('display', 'flex')
              selectedSos = {name: name, price: parseFloat(price), id: parseInt(id)}
            }
            
          }
          
          function confirmaAdaugaSos(){
            $("#"+selectedSos.id).addClass('topping-cos-checked');
            $("#"+selectedSos.id+" .topping-image img").css('filter', 'brightness(1)');
            var sos = {}
            var price = selectedSos.price*parseFloat($(".cantitate").text())
            sos['name'] = selectedSos.name
            sos['productId'] = parseInt(selectedSos.id)
            sos['price'] = parseFloat(selectedSos.price)
            sos['cantitate'] = parseFloat($(".cantitate").text())
            sosuri.push(sos)
            
            console.log("sosuri", sosuri)
            adaugatagurisosuri()
            setsosprice()
            $('.overlay-cos').css('display', 'none')
            $(".cantitate").text("1")
            selectedSos = {}
            
          }
          $("#minus").click(function (){
            var cantitate = parseFloat($(".cantitate").text())
            if(cantitate > 1){
              cantitate--
              $(".cantitate").text(cantitate)
            }
          })
          $("#plus").click(function (){
            var cantitate = parseFloat($(".cantitate").text())
            cantitate++
            $(".cantitate").text(cantitate)
          })
          $(".close-btn").click(function (){
            $('.overlay-cos').css('display', 'none')
          })
          
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
          function removesos(id){
            $("#"+id).removeClass('topping-cos-checked');
            $("#"+id+" .topping-image img").css('filter', '');
            sosuri.forEach(function (sos, index){
              if(sos.productId == id){
                sosuri.splice(index, 1);
              }
            })
            adaugatagurisosuri()
            setsosprice()
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
              function adaugatagurisosuri(){
                html = ''
                sosuri.forEach(function (sos, index){
                  html+=            '<div class="sos-tag-wrapper">'
                    html+=               '<div class="sos-tag">'
                      html+=                    '<div class="sos-tag-image" onclick="removesos('+sos.productId+')"><img src="images/x-button-small.svg" alt=""></div>'
                      html+=                    '<p>'+sos.cantitate+'x '+sos.name+'</p>'
                      html+=                '</div>'
                      html+=            '</div>'
                    })
                    $('#sosuri-tag').empty();
                    $('#sosuri-tag').append(html);
                  }
                  function settoppingprice(){
                    var price = 0
                    toppings.forEach(function (topping, index){
                      if(marime == 'mare')
                      price += topping.price*3
                      else
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
                    
                    if(marime == "mare"){
                      var productId = parseInt(id)+1
                      console.log("id+1", parseInt(id)+1)
                      options.price = parseFloat($('#pizza-pret').text())
                      options.name = options.name+' XXL'
                      delete options.priceXXL
                      delete options.idXXL
                      options.productId = productId
                      options.type = 1
                      options.productIdRef = parseInt(id)+1
                    }else{
                      var productId = parseInt(id) 
                      console.log("id", parseInt(id))
                      options.price = parseFloat($('#pizza-pret').text())
                    }
                    var total = parseFloat($('#pizza-pret').text())
                    options['extra'] = toppings
                    console.log("name", name)
                    console.log("price", total)
                    console.log("toppings", toppings)
                    console.log("sosuri", sosuri)
                    options['sos'] = sosuri
                    options = JSON.stringify(options)
                    quick_add_to_cart(productId, name, total, options)
                  }
                </script>
                @endpush