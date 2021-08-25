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
<div class = "container">
  @foreach(array_chunk($products,4) as $produse)
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
      @endforeach
</div>

@endsection
@push('scripts')
    <script>
    $(document).ready(function(){
        $('.dimensiune-item').click(function() {
            if($(this).children('.dimensiune-check-container').children('.checkbox').children('.checkbox-marime').prop('checked') ==false){
                $(this).children('.dimensiune-check-container').children('.checkbox').children('.checkbox-marime').prop('checked',true)
               $(this).children('.dimensiune-check-container').children('.ingredient-text').css('color','#FFD100');
               $(this).find('.dimensiune-img').find('.full-width').attr("src","images/small-checked.svg");
               $(this).find('.dimensiune-img-big').find('.full-width').attr("src","images/small-checked.svg");

            }else if($(this).children('.dimensiune-check-container').children('.checkbox').children('.checkbox-marime').prop('checked') ==true){
               $(this).children('.dimensiune-check-container').children('.checkbox').children('.checkbox-marime').prop('checked',false)
               $(this).children('.dimensiune-check-container').children('.ingredient-text').css('color','#707070');
               $(this).find('.dimensiune-img').find('.full-width').attr("src","images/small.svg");
               $(this).find('.dimensiune-img-big').find('.full-width').attr("src","images/small.svg");
            }
        });
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
    });
  </script>
@endpush