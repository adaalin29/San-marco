@extends('parts.template') @section('content')
<?php
// dd($pizzas);
$products = array();
foreach($pizzas['products'] as $produs){
  if(isset($produs['image'])){
    
    $image = $produs['image'];
    
  }
  
  if(str_contains($produs['name'], 'XXL')){
    $last_element = array_pop($products);
    $last_element['priceXXL'] = $produs['price'];
    $last_element['idXXL'] = $produs['productId'];
    $last_element['xxlVariant'] = $produs;
    if($image){
      
      $last_element['xxlVariant']['image'] = $image;
    }
    
    
    array_push($products, $last_element);
  }else{
    $produs['priceXXL'] = null;
    $produs['idXXL'] = null;
    array_push($products, $produs);
  }
  if(isset($produs['image'])){
    
    $image = $produs['image'];
    
  }else{
    $image = null;
  }
}
// dd($products);
?>


<div class = "banner">
  <img src = "images/banner.png" class = "banner-img">
  <div class = "banner-text-container" data-aos="fade-right" data-aos-delay="250">
    <div class = "banner-title">Un Triangolo Amoroso?</div>
    <div class = "banner-subtitle">Incearc-o pe Margherita Bufala</div>
  </div>
</div>
<div class = "container">
  @php
  $count = 1;
  @endphp
  @foreach(array_chunk($products,4) as $produse)
  @php
  if($count > 2) break;
  @endphp
  <div class = "produse" data-aos="fade-up">
    @foreach($produse as $data)
    <div class = "produs">
      <a data-fancybox="gallery" href="{{isset($data['image']) ?  Voyager::image($data['image']) : 'images/pizza.png'}}"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
      <a data-fancybox="gallery" href="{{isset($data['image']) ?  Voyager::image($data['image']) : 'images/pizza.png'}}" class = "produs-imagine">
        <img src = "{{isset($data['image']) ? Voyager::image($data['image']) : 'images/pizza.png'}}" class = "produs-img">
      </a>
      <div class = "produs-title">{{ $data['name'] }}</div>
      <?php
      $toppings = [];
      foreach($data['removableToppings'] as $topping){
        array_push($toppings, strtolower($topping["name"]));
      }
      ?>
      <div class = "produs-descriere">{{implode(", ", $toppings)}}</div>
      <div class = "tags">
        <!--                 <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div> -->
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime" onclick="quick_add_to_cart('{{$data['productId']}}', '{{$data['name']}}', '{{$data['price']}}', '{{json_encode($data)}}');">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">{{number_format($data['price'],2)}} lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          @if($data['priceXXL'])
          <div class = "produs-buton-marime" onclick="quick_add_to_cart('{{$data['idXXL']}}', '{{$data['name']}}', '{{$data['priceXXL']}}', '{{json_encode($data['xxlVariant'])}}');">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XXL</div>
              <div class = "produs-cm">50 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">{{number_format($data['priceXXL'],2)}} lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          @endif
          <a href = "/detaliu-pizza/{{$data['productId']}}" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      @endforeach
    </div>
    @if ($count == 1)
    <div class = "produs-banner" data-aos="fade-left">
      <div class = "produs-banner-text">You wanna pizza someone? Stim noi un restaurant Cool</div>
      <a href = "/restaurant" class = "produs-banner-buton">
        <div class = "produs-buton-custom-text">Vezi</div>
        <div class = "produs-buton-custom-img"><img src = "images/vezi.svg" class = "full-width" style = "object-fit:cover"></div>
      </a>
    </div>  
    @endif
    @php
      $count++;
    @endphp
    @endforeach
    {{-- <div class = "produse" data-aos="fade-up">
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      
    </div> --}}
    
    {{-- <div class = "produse" data-aos="fade-up">
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      <div class = "produs">
        <a data-fancybox="gallery" href="images/pizza.png"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
        <a data-fancybox="gallery" href="images/pizza.png" class = "produs-imagine">
          <img src = "images/pizza.png" class = "produs-img">
        </a>
        <div class = "produs-title">Internationale</div>
        <div class = "produs-descriere">sos de rosii, mozzarella, chorizo, ceapa rosie, carnaciori, ciuperci, masline, alte chestii sos de rosii, mozzarella, chorizo, ceapa, ardei, carnaciori</div>
        <div class = "tags">
          <div class = "tag"><div class = "tag-text" style = "color:#FFD100">Artigianale</div></div>
          <div class = "tag"><div class = "tag-text" style = "color:#E3051B">Piccante</div></div>
        </div>
        <div class =  "produs-butoane">
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">L</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <div class = "produs-buton-marime">
            <div class = "produs-marime-container">
              <div class = "produs-marime">XXL</div>
              <div class = "produs-cm">30 cm</div>
            </div>
            <div class = "produs-pret">
              <div class = "produs-pret-text">22.50 lei</div>
            </div>
            <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
          </div>
          <a href = "detaliu-pizza" class = "produs-buton-custom">
            <div class = "produs-buton-custom-text">Cum vrei tu</div>
            <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
          </a>
        </div>
      </div>
      <div class = "produs oferta">
        <img src = "images/oferta.png" class = "full-width">
      </div>
    </div> --}}
    
    <div class = "restaurante">
      <div class = "restaurante-title">Te asteptam si la restaurante</div>
      <div class = 'restaurante-linie'></div>
      <div class = "restaurante-container">
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