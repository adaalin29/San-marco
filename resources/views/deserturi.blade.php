@extends('parts.template') @section('content')
<?php
// dd($salate);
// dd($deserturi);
?>
<div class = "container">
  @foreach(array_chunk($deserturi['products'],4) as $produse)
    <div class = "produse" data-aos="fade-up">
      @foreach($produse as $data)
        <div class = "produs">
                       <a data-fancybox="gallery" href="{{isset($data['image']) ? Voyager::image($data['image']) : 'images/pizza.png'}}"  class = "lupa"><img src = "images/lupa.svg" class = "full-width"></a>
            <a data-fancybox="gallery" href="{{isset($data['image']) ? Voyager::image($data['image']) : 'images/pizza.png'}}" class = "produs-imagine">
                <img src = "{{isset($data['image']) ? Voyager::image($data['image']) : 'images/pizza.png'}}" class = "produs-img">
            </a>
                        <div class="produs-title recomandari-title-produs">{{$data['name']}}</div>
          <?php
          $toppings = [];
          foreach($data['removableToppings'] as $topping){
            array_push($toppings, strtolower($topping["name"]));
          }
          ?>
            <div class = "produs-descriere">{{implode(", ", $toppings)}}</div>
                       <div class="produs-butoane">
                          <div class = "produs-buton-marime" onclick="quick_add_to_cart('{{$data['productId']}}', '{{$data['name']}}', '{{$data['price']}}', '{{json_encode($data)}}');">
                    <div class = "produs-pret">
                        <div class = "produs-pret-text">{{number_format($data['price'],2)}} lei</div>
                    </div>
                    <div class = "produs-pret-img"><img class = "full-width" style = "object-fit:cover;" src = "images/buton-cart.svg"></div>
                </div>
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
      function trimite_comanda(){
        var toppings = [];
        var dressing = [];
        var extra = [];
        var options = [];
        $('input:checkbox[id="topping_checkbox"]:checked').each(function(){
          toppings.push({id:$(this).data("toppingid"), name:$(this).data("toppingname")});
        });
        $('input:radio[id="dressing"]:checked').each(function(){
          dressing.push({id:$(this).data("dressingid"), name:$(this).data("dressingname")});
        });
        $('input:checkbox[id="extra_toppings"]:checked').each(function(){
          extra.push({id:$(this).data("extraid"), name:$(this).data("extraname")});
        });
        options.push({toppings: toppings, dressing: dressing, extra: extra})
        console.log("options ", options)
        quick_add_to_cart('{{$data['productId']}}', '{{$data['name']}}', '{{$data['price']}}', options);
      }
    });
  </script>
@endpush