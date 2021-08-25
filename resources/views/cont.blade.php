@extends('parts.template') @section('content')
<div class="container page-container">
    <div class="breadcrumb-container">
        <a href="" class="breadcrumb-element">Cont personal</a>
        <div class="breadcrumb-line">|</div>
        <a href="" class="breadcrumb-element">Date personale</a>
    </div>
    <div class="cont-menu">
        <div class="cont-item" style="color:#FFD100" id = "date-personale">Date personale</div>
        <div class="cont-item" id = "punctele-mele">Punctele mele</div>
        <div class="cont-item" id = "adrese-livrare">Adrese de livrare</div>
        <div class="cont-item" id = "istoric-comenzi">Istoric comenzi</div>
    </div>
    <div class = "adresa-date-element cont-select-container">
        <div class = "sageata-select"><img src = "images/select-arrow.svg" class = "full-width"></div>
        <select class = "cont-select" name="judet">
            <option value="date-personale">Date personale</option>
            <option value="punctele-mele">Punctele mele</option>
            <option value="adrese-livrare">Adrese de livrare</option>
            <option value="istoric-comenzi">Istoric comenzi</option>
        </select>
    </div>
    <div class="cont-linie"></div>
    <div class = "cont">
        <div class="cont-container">
            <div class="cont-descriere">Mai jos ai datele contului tau.</div>
            <div class="date-container">
                <div  class="date-element"><input id="cont-nume" type="text" name="name" placeholder="Nume" class="" value="{{$user->nume}}"></div>
                <div  class="date-element"><input id="cont-prenume" type="text" name="prenume" placeholder="Prenume" class="" value="{{$user->prenume}}"></div>
                <div  class="date-element"><input style="color: #a2a2a2;" disabled id="cont-email" type="email" name="email" placeholder="Email" class="" value="{{$user->email}}"></div>
                <div  class="date-element"><input id="cont-telefon" type="number" name="phone" placeholder="Numar de telefon" class="" value="{{$user->telefon}}"></div>
                <div class="date-element">
                    <input type="password" name="password" placeholder="Parola noua" class="parola-noua">
                    <button class="modifica-parola">Modifica parola</button>
                    <div class="lock-image"><img src="images/lock.svg" class="full-width"></div>
                </div>
                <div class="date-bottom">
                    <button class="despre-buton cont-buton">
                        <div class="produs-buton-custom-text" onclick="modifica_datele()">Modifica datele</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width"
                                style="object-fit:cover"></div>
                    </button>
                </div>
            </div>
        </div>
            <button class="log-out" onclick="logout()">
                <div class="log-out-image"><img src="images/log-out.svg" class="full-width" ></div>
                <div class="log-out-text">Log out</div>
            </button>
    </div>

    {{-- Punctele mele --}}

    <div class="puncte-container">
        <div class = "puncte">
            <div class="puncte-left">
                <div class="cont-descriere">Foloseste punctele acumulate pentru a comanda la un pret redus.</div>
                <div class="puncte-imagine-container">
                    <div class="puncte-imagine"><img src="images/puncte.svg" class="full-width"></div>
                    <div class="puncte-text">@if(count($user->puncte) > 0) Ai acumulat {{count($user->puncte)}} @if(count($user->puncte) == 1) leu il @else lei ii @endif poti folosi o singura data si nu sunt transferabili @else Nu ai nici un punct acumulat @endif</div>
                </div>
    
            </div>
            <div class="puncte-right">
                <div class="puncte-right-title">Reguli de utilizare:</div>
                <div class="puncte-descriere">
                    Pentru fiecare 30 de lei consumati prin contul tau, in urma comenzilor date din aplicatia mobila sau de
                    pe site-ul Speed Pizza, primesti cate 1 punct de fidelitate.
                    <br>
                    1 punct de fidelitate = 1 leu reducere la comenzile date prin aplicatia sau site-ul Speed Pizza, comenzi
                    exclusive cu livrare la domiciliu sau birou.
                    Poti folosi cate puncte doresti din cele pe care le-ai acumulat in urma comenzilor date, cu conditia ca
                    in cos sa ramana tot timpul, valoarea comenzii minime de 30 lei.
                    Valabilitatea punctelor de fidelitate, este de 12 luni de la dobandire.
                </div>
            </div>
        </div>

    </div>

    {{-- Adrese de livrare --}}

    <div class = "adrese-container">
        <div class="cont-descriere">Adresa de livrare salvate.</div>
        <div id="adrese" class="adrese" >
            @foreach($user->adrese as $adresa)
            <div id="{{$adresa->id}}">
            <div id="confirma-actiunea" class="overlay">
                <div  id="confirma-actiunea-adrese" class = "confirma-actiunea-adrese">
                    <div  class = "close-btn" id = "close-confirma" onclick="inchide_confirmare({{$adresa->id}})"><img class = "full-width" src = "images/close.svg"></div>
                    <div class = "magazin-inchis-title">Confirma actiunea</div>
                    <div class = "magazin-inchis-text">Esti sigur ca vrei sa stergi aceasta adresa de livrare?</div>
                    <div class = "confirma-container">
                    <div class = "confirma-btn" id ="fuck-yes" onclick="sterge_adresa({{$adresa->id}})">Da</div>
                    <div class = "confirma-btn" id ="fuck-no" onclick="inchide_confirmare({{$adresa->id}})">Nu</div>
                    </div>
                </div>
            </div>
            <div  class = "adresa">
                <div class = "adresa-text-container">
                    <div id="cont-adresa-text" class="adresa-text">{{$adresa->strada}}, {{$adresa->numar_strada}}, {{$adresa->detalii}}, {{$adresa->reper}}</div>
                </div>
               <div class = "editeaza-container-tot">
                <div class = "editeaza-container" onclick="show_fields({{$adresa->id}})">
                    <div class = "editeaza-text">Editeaza</div>
                    <div class = "editeaza-imagine"><img src = "images/editeaza.svg" class = "full-width"></div>
                </div>
                <div class = "sterge" onclick="deschide_confirmare({{$adresa->id}})"><img src = "images/sterge.svg" class = "full-width"></div>
               </div>
            </div>
            <div id="fields" class="adauga-adresa">
                <div class = "adresa-title">Editeaza adresa</div>
                <div class = "adauga-adresa-inputs">
                    <div class="date-element adresa-element"><input id="cont-adresa-strada" type="text" name="strada" placeholder="Strada" class="" value="{{$adresa->strada}}"></div>
                    <div class="date-element adresa-element"><input id="cont-adresa-stradanr" type="text" name="stradanr" placeholder="Numarul strazii" class="" value="{{$adresa->numar_strada}}"></div>
                    <div class="date-element adresa-element"><input id="cont-adresa-detalii" type="text" name="detalii" placeholder="Detalii (Bloc, Scara, Etaj, Apartament)" class="" value="{{$adresa->detalii}}"></div>
                    <div class="date-element adresa-element"><input id="cont-adresa-repere" type="text" name="repere" placeholder="Repere" class="" value="{{$adresa->reper}}"></div>
                </div>
                <div class="date-bottom">
                    <button class="despre-buton">
                        <div class="produs-buton-custom-text" onclick="editeaza_adresa({{$adresa->id}})">Salveaza adresa</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width"
                                style="object-fit:cover"></div>
                    </button>
                </div>
            </div>
            </div>
            @endforeach
        </div>
        <div id="adauga-adresa" class="adauga-adresa">
                <div class = "adresa-title">Adauga adresa</div>
                <div class = "adauga-adresa-inputs">
                    <div class="date-element adresa-element"><input id="cont-adresa-strada" type="text" name="strada" placeholder="Strada" class="" ></div>
                    <div class="date-element adresa-element"><input id="cont-adresa-stradanr" type="text" name="stradanr" placeholder="Numarul strazii" class="" ></div>
                    <div class="date-element adresa-element"><input id="cont-adresa-detalii" type="text" name="detalii" placeholder="Detalii (Bloc, Scara, Etaj, Apartament)" class="" ></div>
                    <div class="date-element adresa-element"><input id="cont-adresa-repere" type="text" name="repere" placeholder="Repere" class="" ></div>
                </div>
                <div class="date-bottom">
                    <button class="despre-buton">
                        <div class="produs-buton-custom-text" onclick="adauga_adresa()">Salveaza adresa</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width"
                                style="object-fit:cover"></div>
                    </button>
                </div>
            </div>
        <button class="despre-buton adresa-buton" onclick="arata_adauga_adresa()">
            <div class="produs-buton-custom-text">Adauga adresa</div>
            <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width"
                    style="object-fit:cover"></div>
        </button>
    </div>

    {{-- istoric comenzi --}}

    <div class = "istoric-comenzi">
        <div class="cont-descriere">Poti sa vezi factura sau detaliile de comanda la fiecare din comenzile tale.</div>
        <div id="istoric-container" class = "istoric-container">
            <div class = "istoric-cap">
                <div class = "istoric-cap-element">Comanda ID</div>
                <div class = "istoric-cap-element">Data</div>
                <div class = "istoric-cap-element">Starea comenzii</div>
                <div class = "istoric-cap-element">Total</div>
            </div>
            @foreach($user->comenzi as $comanda)
            <div class = "istoric-element">
                <div class = "comanda-id">
                    <div class = "comanda-id-text">Comanda id: </div>
                    <div class = "comanda-id-numar">{{$comanda->api_id}}</div>
                </div>
                <div class = "istoric-data">{{date_format($comanda->created_at, 'd.m.Y')}}</div>
                <div class = "istoric-status">{{$comanda->status}}</div>
                <div class = "istoric-total">{{$comanda->total}} Lei</div>
                <div class = "istoric-detaliu" onclick="arata_detaliu_comanda({{$comanda->id}})">
                    <div class = "istoric-detaliu-text">Vezi comanda</div>
                    <div class = "istoric-detaliu-imagine"><img src = "images/vezi-comanda.svg" class = "full-width"></div>
                </div>
            </div>
            <div id="{{$comanda->id}}" class="overlay">

            <div class = "detaliu-cos">
        <div class = "close-btn" id = "close-comanda" onclick="ascunde_detaliu_comanda({{$comanda->id}})"><img class = "full-width" src = "images/close-black.svg"></div>
        <div class = "detaliu-cos-top">
          <div class = "detaliu-cos-title">Comanda: {{$comanda->api_id}}</div>
          <div class = "detaliu-cos-data">{{date_format($comanda->created_at, 'd.m.Y')}}</div>
          <div class = "detaliu-cos-comanda-container">
            @foreach($comanda->produse as $produs)
            @php
            $options = json_decode($produs->options, true);
            if(str_contains($produs->nume, 'SOS')) continue;
            @endphp
            <div class = "detaliu-cos-produs">
              <div class = "detaliu-cos-produs-left">
                
                <div class = "detaliu-cos-imagine"><img src = "{{isset($options['image']) ? Voyager::image($options['image']) : 'images/pizza.png'}}" class = "full-width-img-comanda object-contain"></div>
                <div class = "detaliu-cos-descriere">
                  <div class = "detaliu-cos-descriere-titlu">{{$produs->nume}}</div>
                  @if(str_contains($produs->nume, 'PIZZA'))
                    @if($options['type'] == 0)
                    <div class = "detaliu-cos-descriere-informatii">L (30 cm)</div>
                    @else
                    <div class = "detaliu-cos-descriere-informatii">XXL (50 cm)</div>
                    @endif
                    @if(isset($options['sos']))
                      @if(sizeof($options['sos']) > 0)
                        <div class = "detaliu-cos-descriere-informatii">Sos extra: 
                        @foreach($options['sos'] as $sos)
                            <span>{{$sos['cantitate']}}x {{$sos['name']}} {{$sos['price']*$sos['cantitate']}} lei, </span>
                        @endforeach
                      </div>
                      @endif
                    @endif
                  @elseif(str_contains($produs->nume, 'PASTE'))
                  <div class = "detaliu-cos-descriere-informatii">Tip de paste: {{$options['optionals']['name']}}</div>
                  @elseif(str_contains($produs->nume, 'SALATA'))
                  <div class = "detaliu-cos-descriere-informatii">Dressing: {{$options['optionals']['name']}}</div>
                  @endif
                  @if(isset($options['removed']))
                      @if(count($options['removed']) > 0)
                        <div class = "detaliu-cos-descriere-informatii">Ingrediente scoase:
                        @foreach($options['removed'] as $value)
                          <span>{{$value['name']}}, </span>
                        @endforeach
                        </div>
                      @endif
                    @endif
                  @if(isset($options['extra']))
                      @if(count($options['extra']) > 0)
                        <div class = "detaliu-cos-descriere-informatii">Toping extra:
                        @foreach($options['extra'] as $value)
                          @if($options['size'] == 1)
                          <span>{{$value['name']}} ( {{$value['price']*3}} lei), </span>
                          @else
                          <span>{{$value['name']}} ( {{$value['price']}} lei), </span>
                          @endif
                        @endforeach
                        </div>
                      @endif
                    @endif
                    <div class = "detaliu-cos-produs-right desktop-hidden">
                      <div class = "detaliu-cos-cantitate">X{{$produs->cantitate}}</div>
                      <div class = "detaliu-cos-pret">{{$produs->total}} Lei</div>
                  </div>
                </div>
              </div>
              <div class = "detaliu-cos-produs-right mobile-hidden">
                  <div class = "detaliu-cos-cantitate">X{{$produs->cantitate}}</div>
                  <div class = "detaliu-cos-pret">{{$produs->total}} Lei</div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class = "detaliu-cos-bottom">
            <div class = "puncte-acumulate">Puncte acumulate: {{$comanda->puncte_cumulate}}</div>
            <div class = "detaliu-cos-informatii">
              <div class= "detaliu-cos-informatii-element-container">
                <div class = "detaliu-cos-informatii-element">Transport:</div>
                <div class = "detaliu-cos-informatii-element">{{$comanda->transport}} lei</div>
              </div>
              <div class= "detaliu-cos-informatii-element-container">
                <div class = "detaliu-cos-informatii-element">Sub-total:</div>
                <div class = "detaliu-cos-informatii-element">{{$comanda->sub_total}} lei</div>
              </div>
              <div class= "detaliu-cos-informatii-element-container">
                <div class = "detaliu-cos-informatii-element">Discount puncte:</div>
                <div class = "detaliu-cos-informatii-element">{{$comanda->discount_puncte}} lei</div>
              </div>
              <div class = "detaliu-cos-total">
                <div class = "detaliu-cos-total-element">TOTAL: {{count($comanda->produse)}} produse</div>
                <div class = "detaliu-cos-total-element">{{$comanda->total}} lei</div>
              </div>
              {{-- <button class = "despre-buton retrimite-comanda">
                <div class = "produs-buton-custom-text">Retrimite comanda</div>
                <div class = "produs-buton-custom-img"><img src = "images/produs-custom.svg" class = "full-width" style = "object-fit:cover"></div>
            </button> --}}
            </div>
        </div>
      </div>

            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
function show_fields(id){
    $('#adauga-adresa').css('display', 'none')
    if($('#'+id+' #fields').hasClass('fields-shown')){
        $('#'+id+' #fields').removeClass('fields-shown')
        $('#'+id+' #fields').css('display', 'none')
    }else{
        $('#'+id+' #fields').addClass('fields-shown')
        $('#'+id+' #fields').css('display', 'block')
    }
}
function editeaza_adresa(id){
    $.ajax({
            url  : '/modifica-adresa',
            type :  'POST',
            data: 
            {
                id_adresa: id,
                strada: $('#'+id+' #cont-adresa-strada').val(),
                numar_strada: $('#'+id+' #cont-adresa-stradanr').val(),
                detalii: $('#'+id+' #cont-adresa-detalii').val(),
                reper: $('#'+id+' #cont-adresa-repere').val(),
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              if(resp.success == true){
                  $('#'+id+' #cont-adresa-text').text(resp.strada+', '+resp.numar_strada+', '+resp.detalii+', '+resp.reper)
                  $('#'+id+' #fields').removeClass('fields-shown')
                  $('#'+id+' #fields').css('display', 'none')
              console.log('success', resp)
              
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
            },
          })
}
function sterge_adresa(id){
    $.ajax({
            url  : '/sterge-adresa',
            type :  'POST',
            data: 
            {
                id_adresa: id,
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              if(resp.success == true){
                $('#'+id).empty();
              console.log('success', resp)
              
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
            },
          })
}
    function logout(){
  $.ajax({
            url  : '/logout',
            type :  'POST',
            data: 
            {
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              if(resp.success == true){
              console.log('success', resp)
              window.location.href = "/";
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
            },
          })
}
function modifica_datele(){
  $.ajax({
            url  : '/modifica-datele',
            type :  'POST',
            data: 
            {
                nume: $('#cont-nume').val(),
                prenume: $('#cont-prenume').val(),
                telefon: $('#cont-telefon').val(),
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              if(resp.success == true){
                console.log('success', resp)
                Notiflix.Notify.Success(resp.msg);
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
            },
          })
}
function deschide_confirmare(id){
    $('#'+id+' #confirma-actiunea').css('display', 'flex')
}
function inchide_confirmare(id){
    $('#'+id+' #confirma-actiunea').css('display', 'none')
}
function arata_adauga_adresa(){
    $('#adauga-adresa').css('display', 'block')
    $('#fields').css('display', 'none')
    document.querySelector("#adauga-adresa").scrollIntoView({
    behavior: 'smooth',
    block: 'center' 
});
}
function adauga_adresa(){
    $.ajax({
            url  : '/adauga-adresa',
            type :  'POST',
            data: 
            {
                strada: $('#adauga-adresa #cont-adresa-strada').val(),
                numar_strada: $('#adauga-adresa #cont-adresa-stradanr').val(),
                detalii: $('#adauga-adresa #cont-adresa-detalii').val(),
                reper: $('#adauga-adresa #cont-adresa-repere').val(),
            },
          headers: 
          {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) 
            { 
              if(resp.success == true){
                //   $('#'+id+' #cont-adresa-text').text(resp.strada+', '+resp.numar_strada+', '+resp.detalii+', '+resp.reper)
                  $('#adauga-adresa').css('display', 'none')
              console.log('success', resp)
                $('#adauga-adresa #cont-adresa-strada').val('')
                $('#adauga-adresa #cont-adresa-stradanr').val('')
                $('#adauga-adresa #cont-adresa-detalii').val('')
                $('#adauga-adresa #cont-adresa-repere').val('')
                html = ''
html+='                <div id="'+resp.id+'">'
html+='            <div id="confirma-actiunea" class="overlay">'
html+='                <div  id="confirma-actiunea-adrese" class = "confirma-actiunea-adrese">'
html+='                    <div  class = "close-btn" id = "close-confirma" onclick="inchide_confirmare('+resp.id+')"><img class = "full-width" src = "images/close.svg"></div>'
html+='                    <div class = "magazin-inchis-title">Confirma actiunea</div>'
html+='                    <div class = "magazin-inchis-text">Esti sigur ca vrei sa stergi aceasta adresa de livrare?</div>'
html+='                    <div class = "confirma-container">'
html+='                    <div class = "confirma-btn" id ="fuck-yes" onclick="sterge_adresa('+resp.id+')">Da</div>'
html+='                    <div class = "confirma-btn" id ="fuck-no" onclick="inchide_confirmare('+resp.id+')">Nu</div>'
html+='                    </div>'
html+='                </div>'
html+='            </div>'
html+='            <div  class = "adresa">'
html+='                <div class = "adresa-text-container">'
html+='                    <div id="cont-adresa-text" class="adresa-text">'+resp.strada+', '+resp.numar_strada+', '+resp.detalii+', '+resp.reper+'</div>'
html+='                </div>'
html+='               <div class = "editeaza-container-tot">'
html+='                <div class = "editeaza-container" onclick="show_fields('+resp.id+')">'
html+='                    <div class = "editeaza-text">Editeaza</div>'
html+='                    <div class = "editeaza-imagine"><img src = "images/editeaza.svg" class = "full-width"></div>'
html+='                </div>'
html+='                <div class = "sterge" onclick="deschide_confirmare('+resp.id+')"><img src = "images/sterge.svg" class = "full-width"></div>'
html+='               </div>'
html+='            </div>'
html+='            <div id="fields" class="adauga-adresa">'
html+='                <div class = "adresa-title">Editeaza adresa</div>'
html+='                <div class = "adauga-adresa-inputs">'
html+='                    <div class="date-element adresa-element"><input id="cont-adresa-strada" type="text" name="strada" placeholder="Strada" class="" value="'+resp.strada+'"></div>'
html+='                    <div class="date-element adresa-element"><input id="cont-adresa-stradanr" type="text" name="stradanr" placeholder="Numarul strazii" class="" value="'+resp.numar_strada+'"></div>'
html+='                    <div class="date-element adresa-element"><input id="cont-adresa-detalii" type="text" name="detalii" placeholder="Detalii (Bloc, Scara, Etaj, Apartament)" class="" value="'+resp.detalii+'"></div>'
html+='                    <div class="date-element adresa-element"><input id="cont-adresa-repere" type="text" name="repere" placeholder="Repere" class="" value="'+resp.reper+'"></div>'
html+='                </div>'
html+='                <div class="date-bottom">'
html+='                    <button class="despre-buton">'
html+='                        <div class="produs-buton-custom-text" onclick="editeaza_adresa('+resp.id+')">Salveaza adresa</div>'
html+='                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width"'
html+='                                style="object-fit:cover"></div>'
html+='                    </button>'
html+='                </div>'
html+='            </div>'
html+='            </div>'
$('#adrese').append(html);
              }
            },
            error: function(resp) 
            {
              console.log('error', resp)
            },
          }) 
}

function arata_detaliu_comanda(id){
    $('#istoric-container #'+id).css('display', 'flex')
    $('#header').css('z-index', 2)
}
function ascunde_detaliu_comanda(id){
    $('#istoric-container #'+id).css('display', 'none')
    $('#header').css('z-index', 20)
}

</script>
@endpush
