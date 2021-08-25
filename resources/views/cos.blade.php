@extends('parts.template') @section('content')
<div class="overlay-cos">
<div class = "topping-overlay">
        <div class = "close-btn" id = "close-topping-overlay"><img class = "full-width" src = "images/close.svg"></div>
        <div class = "magazin-inchis-title">Topping-uri</div>
        <div class="lista-toppings-cos">
            @foreach($toppingPizza as $topping)
            @php
             $toppingid = $topping['productId'];
             $name = $topping['name'];
             $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping({{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                    ({{$topping['price']}} lei)
                </div>
            </div>
            @endforeach
        </div>
        <div class="topping-button-div">
        <button class="produs-banner-buton cos-adauga" onclick="modifica_extra()">
                <div class="produs-buton-custom-text">Confirma</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
        </div>
    </div>
</div>
<div class="container page-container">
    <div class = "cos-titlu">Cos cumparaturi</div>
    <div id="raspuns_produse" class = "cos-produse">
       
    </div>  
    <div class = "banner-pizza">
        <div class = "banner-pizza-inside">
            <div class = "banner-pizza-inside-text">Mai adauga o pizza pentru a beneficia de oferta</div>
            <div class = "banner-pizza-inside-text-mare">3+1 Gratis.</div>
            <div class  ="banner-poza-pizza"><img src = "images/pizza-ambalata.svg"class = "full-width"></div>
        </div>
    </div>
    <div class = "finalizare-container">
        @if($user)
        <div class = "foloseste-puncte">
            <div class = "foloseste-title">Foloseste punctele:</div>
            @if(count($user->puncte) > 0)
            <div class = "foloseste-text">* Ai acumulat @if(count($user->puncte) == 1) {{count($user->puncte)}} leu. @else {{count($user->puncte)}} lei. @endif Aceasta suma se poate folosi o singura data si nu este transferabila.</div>
            <button class="produs-banner-buton cos-adauga" onclick="aplica_discount()">
                <div class="produs-buton-custom-text">Foloseste</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
            @else
            <div class = "foloseste-text">* Nu ai acumulat nici un punct.</div>
            @endif
        </div>
        @else
        <div class = "foloseste-puncte">
            <div class = "foloseste-title">Foloseste punctele:</div>
            <div class = "foloseste-text">Poti beneficia de puncte bonus numai daca ai cont.</div>
        </div>
        @endif
        <div class = "transport">
            <div class = "transport-item">
                <div class = "transport-text">Transport:</div>
                <div id="transport-pret" class = "transport-text">5.00 lei</div>
            </div>
            <div class = "transport-item">
                <div class = "transport-text">Sub-total:</div>
                <div id="sub-total-price" class = "transport-text">{{$total_cart}} lei</div>
            </div>
            <div class = "transport-item">
            <div class = "transport-text">Discount puncte:</div>
            <div id="dicsount-pret" class = "transport-text">0.00 lei</div>
            </div>
            <div class = "total-produs">
                <div id="total-produse" class = "total-text">Total @if($numaratoare == 1) {{$numaratoare}} produs @else {{$numaratoare}} produse @endif</div>
                <div class = "total-produse-pret-container">
                    <div id="total-price" class = "total-produse-pret">{{floatval($total_cart)+5}}</div>
                    <div class = "total-produse-lei">lei</div>
                </div>
            </div>
        </div>
    </div>
    <div class = "finalizare-container">
        <div class = "metoda-plata">
            <div class = "metoda-plata-title">Metoda de plata:</div>
            <div class = "metoda">
                <label class="checkbox">
                    <input  type="radio" class = "metoda-checkbox" name="metoda-plata" value="1">
                    <span></span>
                </label>
                <div class = "cos-sos-text">Cash la livrare</div>
            </div>
            <div class = "metoda">
                <label class="checkbox">
                    <input  type="radio" class = "metoda-checkbox" name="metoda-plata" value="2">
                    <span></span>
                </label>
                <div class = "cos-sos-text">Plata online cu cardul</div>
            </div>
            <div class = "foloseste-text">* La metoda de plata cu cardul nu se percepe nici un comision in plus 
                indiferent de banca de care apartineti. Acceptam: Visa si Mastercard.</div>
        </div>

        {{--  --}}
        <div class = "livrare">
            <div class = "metoda-plata-title">Date de livrare:</div>
            <div class = "metoda metoda-livrare livrare-la">
                <label class="checkbox">
                    <input type="radio" class = "metoda-checkbox" name="date-livrare" value="livrare">
                    <span></span>
                </label>
                <div class = "cos-sos-text">Livrare la</div>
            </div>
            {{-- .. --}}
            <div id="adresa-livrare" class = "metoda-padding livrare-adresa">
            @if($user)
                @foreach($user->adrese as $adresa)
                <div class = "metoda">
                    <label class="checkbox">
                        <input type="radio" class = "metoda-checkbox" name="adresa" value="{{$adresa->id}}">
                        <span></span>
                    </label>
                    <div class = "cos-sos-text">{{$adresa->strada}}, {{$adresa->numar_strada}}, {{$adresa->detalii}}, {{$adresa->reper}}</div>
                </div>
                @endforeach
            @endif
                <div class = "metoda">
                    <label class="checkbox">
                        <input type="radio"  class = "metoda-checkbox" name="adresa" value="custom-address">
                        <span></span>
                    </label>
                    <div class = "cos-sos-text">Alta adresa</div>
                </div>
            </div>
            <div id="alta-adresa" class = "livrare-form">
                <input type="text" name="name" placeholder="Nume" class="">
                <input type="text" name="address" placeholder="Adresa" class="">
                <input type="number" name="phone" placeholder="Numar de telefon" class="">
                <textarea name="message" placeholder="Mesaj" class=""></textarea>
            </div>
            {{-- .. --}}
            <div class = "metoda metoda-livrare ridicare">
                <label class="checkbox">
                    <input type="radio" id = "livrare-ridicare" class = "metoda-checkbox" value="ridicare" name="date-livrare">
                    <span></span>
                </label>
                <div class = "cos-sos-text">Ridicare de la</div>
            </div>
            <div id="adresa-ridicare" class = "metoda-padding">
                <div class = "metoda">
                    <label class="checkbox">
                        <input type="radio" class = "metoda-checkbox" name="adresa-ridicare" value="1">
                        <span></span>
                    </label>
                    <div class = "cos-sos-text">A. Lapusneanu 116 C City Mall, et 1</div>
                </div>
                <div class = "metoda">
                    <label class="checkbox">
                        <input type="radio" class = "metoda-checkbox" name="adresa-ridicare" value="2">
                        <span></span>
                    </label>
                    <div class = "cos-sos-text">I.C. Bratianu 48</div>
                </div>
            </div>
            <div class = "foloseste-text">* Beneficiezi de o reducere de 5% pentru comenzile la care alegi ridicarea de la sediu.</div>
        </div>
    </div>
    <div class = "trimite-comanda">
        <div class="produs-banner-buton buton-inapoi">
            <div class="produs-buton-custom-img"><img src="images/back.svg" class="full-width" style="object-fit:cover"></div>
            <div class="produs-buton-custom-text">Inapoi</div>
        </div>
        <div class="despre-buton-cos trimite-buton" onclick="trimite_comanda()">
            <p class="produs-buton-custom-text">Trimite comanda</p>
            <div class="produs-buton-custom-img"><img src="images/despre.svg" class="full-width" style="object-fit:cover"></div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
    
    $(document).ready(function(){
        zi_tot();
        $('body').on('click', '#modifica-cantitatea', function() {
            modifica_cantitate($(this).data("cantitate"), $(this).data("rowid"));
        });
    });//document ready
    var toppings = []
    function selectTopping(id, idTopping, name, price){

        if($('#'+id+' #'+idTopping).hasClass('topping-cos-checked')){
                $('#'+id+' #'+idTopping).removeClass('topping-cos-checked');
                
                toppings.forEach(function (topping, index){
                    
                    if(topping.productId == idTopping){
                        toppings.splice(index, 1);
                    }
                })
                
            }else{
                var topping = {};
                console.log(id, idTopping, '#'+id+' #'+idTopping)
                $('#'+id+' #'+idTopping).addClass('topping-cos-checked');
                topping['name'] = name
                topping['productId'] = idTopping
                topping['price'] = parseFloat(price)
                toppings.push(topping)
            }
        console.log(toppings)
    }
    
    $('#close-topping-overlay').click(function(){
        removeChecked()
        $('.topping-overlay').css('display','none');
        $('.overlay-cos').css('display','none');
        $('body').css('overflow','auto');
    });
    function removeChecked(){
        $('.topping-cos').each(function () {
            $(this).removeClass('topping-cos-checked'); // "this" is the current element in the loop
        });
    }
    function closeOverlayToppings(id){
        $('#'+id).css('display','none');
        $('header#header').css('z-index','20');
        
        $('body').css('overflow','auto');
    }
    function topping_buton(id){
        toppings = []
        $.ajax({
          url: '/get-extra',
          type: 'POST',
          data: 
           {
              rowId     : id
          },
         headers: 
         {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(resp) 
         { 
            if(resp.extra){
                resp.extra.forEach(function (topping, index) {
                    toppings.push(topping)
                $("#"+id+" #"+topping.productId).addClass('topping-cos-checked');
            });

            }
            var counts = resp.count_prods;
             var total = resp.total;
             $('#nr_prod').text(counts);
             $('#total_pret').text(total+' lei');
             $('#sub-total-price').text(total+' lei');
             calculeaza_total()
             $('#total-produse').text('Total '+counts+' produse');
            $('.cart_rowid').val(id);
            
            $('#'+id).css('display','flex');
            $('header#header').css('z-index','1');
            $('body').css('overflow','hidden');
          }
      });
      removeChecked()
    }

    function modifica_extra(id){
        $.ajax({
          url: '/modifica_extra',
          type: 'POST',
          data: 
           {
              rowId     : id,
              extra : JSON.stringify(toppings)
          },
         headers: 
         {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(resp) 
         { 
            var counts = resp.count_prods;
             var total = resp.total;
             $('#nr_prod').text(counts);
             $('#total_pret').text(total+' lei');
             $('#sub-total-price').text(total+' lei');
             calculeaza_total()
             $('#total-produse').text('Total '+counts+' produse');
             toppings = []
            $('.topping-overlay').css('display','none');
            $('.overlay-cos').css('display','none');
            $('body').css('overflow','auto');
            $('header#header').css('z-index','20');
            zi_tot();
          }
      });
      removeChecked()
    }
    function calculeaza_total(){
        var subtotal = parseFloat($('#sub-total-price').text())
        var transport = parseFloat($('#transport-pret').text())
        var discount = parseFloat($('#dicsount-pret').text())
        var total = subtotal+transport-discount

        $('#total-price').text(total);

    }
    function modifica_cantitate(cantitate,rowId){
         $.ajax({
          url: '/modifica_cantitate',
          type: 'POST',
          data: 
           {
              rowId     : rowId,
              cantitate : cantitate
          },
         headers: 
         {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(resp) 
         { 
            zi_tot();
            var counts = resp.count_prods;
             var total = resp.total;
             $('#nr_prod').text(counts);
             $('#total_pret').text(total+' lei');
             $('#sub-total-price').text(total+' lei');
             calculeaza_total()
             console.log(total+parseFloat($('#transport-pret').text()))
             $('#total-produse').text('Total '+counts+' produse');
            
          }
      });
      
    }
    function zi_tot()
    {
       
       $.ajax({
        url: '/finalizeaza/tot',
        type: 'POST',
        data: 
         {
            afiseaza  : 'da'
        },
       headers: 
       {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp) 
       {     
            $('#raspuns_produse').empty();
            $('#raspuns_produse').append(resp);
        }
    });
    }
    var puncte_folosite = false
    function aplica_discount(){
            @if($user)
            puncte_folosite = true
            if(parseFloat({{count($user->puncte)}}) == 1)
            $('#dicsount-pret').text({{count($user->puncte)}}+ '.00 leu');
            else
            $('#dicsount-pret').text({{count($user->puncte)}}+ '.00 lei');
            calculeaza_total()
            @endif
    }
    $('input:radio[name="adresa"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'custom-address') {
            $('#alta-adresa').css('display', 'block')
        }else{
            $('#alta-adresa').css('display', 'none')
        }
    });
    $('input:radio[name="date-livrare"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'livrare') {
            $('#adresa-ridicare').css('display', 'none')
            $('#adresa-livrare').css('display', 'block')
        }else{
            $('#adresa-ridicare').css('display', 'block')
            $('#adresa-livrare').css('display', 'none')
        }
    });
    function trimite_comanda(){
        if ($('input:radio[name="date-livrare"]:checked').val() == "ridicare"){
            var adresa = $('input:radio[name="adresa-ridicare"]:checked').val()
        }else if($('input:radio[name="date-livrare"]:checked').val() == "livrare"){
            var adresa = $('input:radio[name="adresa"]:checked').val()
        }
        var metodaPlata = $('input:radio[name="metoda-plata"]:checked').val()
        if(!metodaPlata)
            return Notiflix.Notify.Failure("Alege o modalitate de plata");
        if(!adresa)
            return Notiflix.Notify.Failure("Alege o adresa de livrare");
        
        console.log(adresa, metodaPlata, puncte_folosite)

        $.ajax({
        url: '/trimite-comanda',
        type: 'POST',
        data: 
         {
            adresa  : adresa,
            metodaPlata: metodaPlata,
            puncte_folosite : puncte_folosite,
        },
       headers: 
       {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(resp) 
        {   
            if(resp.success){
                console.log(resp)
                location.href='comanda-incheiata/'+resp.comandaId;
            }
        }
    });
    }
</script>
@endpush