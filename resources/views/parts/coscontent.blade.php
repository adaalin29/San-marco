
@foreach($cart_products->sortBy('name')->values()->all() as $produs)

    <div id="{{$produs->id}}" class = "cos-produs">
            <div class= "cos-produs-informatii">
                <div class = "cos-produs-imagine"><img src = "{{isset($produs->options['image']) ? Voyager::image($produs->options['image']) : 'images/pizza.png'}}" class = "full-width object-cover"></div>
                <div class = "cos-produs-descriere">
                <div class = "cos-produs-nume">{{$produs->name}}</div>
@if(str_contains($produs->name, 'PIZZA'))
<div id="{{$produs->rowId}}" class="overlay-cos">
<div class = "topping-overlay">
        <div class = "close-btn" id = "close-topping-overlay"><img class = "full-width" src = "images/close.svg" onClick="closeOverlayToppings('{{$produs->rowId}}')"></div>
        <div class = "magazin-inchis-title">Topping-uri</div>
        <div class="lista-toppings-cos">
        @if(isset($produs->options['ingredienteBlocate']) && $produs->options['ingredienteBlocate'] != null)
            @foreach($toppingPizza as $topping)
            
            @if(!in_array($topping['productId'], $produs->options['toppinguriBlocate']))
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endif
            @endforeach
            
            @else
            @foreach($toppingPizza as $topping)
            
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="topping-button-div">
        <button class="produs-banner-buton cos-adauga" onclick="modifica_extra('{{$produs->rowId}}')">
                <div class="produs-buton-custom-text">Confirma</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
        </div>
    </div>
</div>



    @if(str_contains($produs->options['name'], 'XXL'))
                        <div class = "cos-produs-specificatii">Marime: XXL (50 cm)</div>
    @else
                        <div class = "cos-produs-specificatii">Marime: L (30 cm)</div>
    @endif
    @if(isset($produs->options['removed']))
    @if(count($produs->options['removed']) > 0)
    <div class = "cos-produs-specificatii">Ingrediente scoase:
    @foreach($produs->options['removed'] as $value)
        <span>{{$value['name']}}, </span>
    @endforeach
    </div>
    @endif
@endif
@if(isset($produs->options['sos']))
@if(sizeof($produs->options['sos']) > 0)
                <div class = "cos-produs-specificatii">Sos extra: 
@foreach($produs->options['sos'] as $sos)
    <span>{{$sos['cantitate']}}x {{$sos['name']}} {{$sos['price']*$sos['cantitate']}} lei, </span>
@endforeach
</div>
@endif

@endif
@if(isset($produs->options['extra']))
@if(count($produs->options['extra']) > 0)
                <div class = "cos-produs-specificatii">Toping extra:
@foreach($produs->options['extra'] as $value)
@if(str_contains($produs->options['name'], 'XXL'))
    <span>{{$value['name']}} ( {{$value['price']*3}} lei), </span>
@else
<span>{{$value['name']}} ( {{$value['price']}} lei), </span>
@endif
@endforeach
</div>
@endif
@endif

                <div class="produs-buton-group">
                    <button id="adauga-topping-button" onclick="topping_buton('{{$produs->rowId}}')" class="produs-banner-buton">
                        <div class="produs-buton-custom-text" >Adauga toping</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
                    </button>
                    <!-- <button class="produs-banner-buton">
                        <div class="produs-buton-custom-text">Adauga sos</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
                    </button> -->
                </div>
@elseif(str_contains($produs->name, 'SALATA'))
<div id="{{$produs->rowId}}" class="overlay-cos">
<div class = "topping-overlay">
        <div class = "close-btn" id = "close-topping-overlay"><img class = "full-width" src = "images/close.svg" onClick="closeOverlayToppings('{{$produs->rowId}}')"></div>
        <div class = "magazin-inchis-title">Topping-uri</div>
        <div class="lista-toppings-cos">
        @if(isset($produs->options['ingredienteBlocate']) && $produs->options['ingredienteBlocate'] != null)
            @foreach($toppingPizza as $topping)
            
            @if(!in_array($topping['productId'], $produs->options['toppinguriBlocate']))
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endif
            @endforeach
            
            @else
            @foreach($toppingPizza as $topping)
            
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="topping-button-div">
        <button class="produs-banner-buton cos-adauga" onclick="modifica_extra('{{$produs->rowId}}')">
                <div class="produs-buton-custom-text">Confirma</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
        </div>
    </div>
</div>

                
                <div class = "cos-produs-specificatii">Dressing: {{$produs->options['optionals']['name']}}</div>
                @if(isset($produs->options['extra']))
                    @if(count($produs->options['extra']) > 0)
                    <div class = "cos-produs-specificatii">Toping extra:
                    @foreach($produs->options['extra'] as $value)
                        @if(str_contains($produs->options['name'], 'XXL'))
                            <span>{{$value['name']}} ( {{$value['price']*3}} lei), </span>
                        @else
                        <span>{{$value['name']}} ( {{$value['price']}} lei), </span>
                        @endif
                    @endforeach
                    </div>
                    @endif
                @endif
                @if(isset($produs->options['removed']))
    @if(count($produs->options['removed']) > 0)
    <div class = "cos-produs-specificatii">Ingrediente scoase:
    @foreach($produs->options['removed'] as $value)
        <span>{{$value['name']}}, </span>
    @endforeach
    </div>
    @endif
@endif
                <div class="produs-buton-group">
                    <button id="adauga-topping-button" onclick="topping_buton('{{$produs->rowId}}')" class="produs-banner-buton">
                        <div class="produs-buton-custom-text" >Adauga toping</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
                    </button>
                    <!-- <button class="produs-banner-buton">
                        <div class="produs-buton-custom-text">Alege dressing</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
                    </button> -->
                </div>
@elseif(str_contains($produs->name, 'PASTE'))
<div id="{{$produs->rowId}}" class="overlay-cos">
<div class = "topping-overlay">
        <div class = "close-btn" id = "close-topping-overlay"><img class = "full-width" src = "images/close.svg" onClick="closeOverlayToppings('{{$produs->rowId}}')"></div>
        <div class = "magazin-inchis-title">Topping-uri</div>
        <div class="lista-toppings-cos">
        @if(isset($produs->options['ingredienteBlocate']) && $produs->options['ingredienteBlocate'] != null)
            @foreach($toppingPizza as $topping)
            
            @if(!in_array($topping['productId'], $produs->options['toppinguriBlocate']))
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endif
            @endforeach
            
            @else
            @foreach($toppingPizza as $topping)
            
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
        @if(isset($produs->options['removed']))
        @if(count($produs->options['removed']) > 0)
        <div class = "cos-produs-specificatii">Ingrediente scoase:
        @foreach($produs->options['removed'] as $value)
            <span>{{$value['name']}}, </span>
        @endforeach
        </div>
        @endif
    @endif
        @if(isset($produs->options['extra']))
        @if(count($produs->options['extra']) > 0)
        <div class = "cos-produs-specificatii">Toping extra:
        @foreach($produs->options['extra'] as $value)
            @if(str_contains($produs->options['name'], 'XXL'))
                <span>{{$value['name']}} ( {{$value['price']*3}} lei), </span>
            @else
            <span>{{$value['name']}} ( {{$value['price']}} lei), </span>
            @endif
        @endforeach
        </div>
        @endif
    @endif
        <div class="topping-button-div">
        <button class="produs-banner-buton cos-adauga" onclick="modifica_extra('{{$produs->rowId}}')">
                <div class="produs-buton-custom-text">Confirma</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
        </div>
    </div>
</div>

        <div class = "cos-produs-specificatii">Tip de paste: {{$produs->options['optionals']['name']}}</div>
        @if(isset($produs->options['removed']))
    @if(count($produs->options['removed']) > 0)
    <div class = "cos-produs-specificatii">Ingrediente scoase:
    @foreach($produs->options['removed'] as $value)
        <span>{{$value['name']}}, </span>
    @endforeach
    </div>
    @endif
@endif
        @if(isset($produs->options['extra']))
                    @if(count($produs->options['extra']) > 0)
                    <div class = "cos-produs-specificatii">Toping extra:
                    @foreach($produs->options['extra'] as $value)
                        @if(str_contains($produs->options['name'], 'XXL'))
                            <span>{{$value['name']}} ( {{$value['price']*3}} lei), </span>
                        @else
                        <span>{{$value['name']}} ( {{$value['price']}} lei), </span>
                        @endif
                    @endforeach
                    </div>
                    @endif
                @endif
        <div class="produs-buton-group">
            <button id="adauga-topping-button" onclick="topping_buton('{{$produs->rowId}}')" class="produs-banner-buton">
                <div class="produs-buton-custom-text" >Adauga toping</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
            <!-- <button class="produs-banner-buton">
                <div class="produs-buton-custom-text">Alege tipul de paste</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button> -->
        </div>
@elseif(str_contains($produs->name, 'SANDWICH'))
<div id="{{$produs->rowId}}" class="overlay-cos">
<div class = "topping-overlay">
        <div class = "close-btn" id = "close-topping-overlay"><img class = "full-width" src = "images/close.svg" onClick="closeOverlayToppings('{{$produs->rowId}}')"></div>
        <div class = "magazin-inchis-title">Topping-uri</div>
        <div class="lista-toppings-cos">
        @if(isset($produs->options['ingredienteBlocate']) && $produs->options['ingredienteBlocate'] != null)
            @foreach($toppingPizza as $topping)
            
            @if(!in_array($topping['productId'], $produs->options['toppinguriBlocate']))
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endif
            @endforeach
            
            @else
            @foreach($toppingPizza as $topping)
            
            @php
                $toppingid = $topping['productId'];
                $name = $topping['name'];
                $price = $topping['price'];
            @endphp
            <div id="{{$toppingid}}" class="topping-cos" onclick="selectTopping('{{$produs->rowId}}',{{$toppingid}}, '{{$name}}', '{{$price}}')">
                <div class="topping-cos-imagine">
                    <img src="{{isset($topping['image']) ? Voyager::image($topping['image']) : 'images/bacon.png'}}" alt="">
                    <input type="hidden" name="cart_rowid" class="cart_rowid" />
                    <input type="hidden" name="cart_topping" class="cart_topping" />
                </div>
                <div class="topping-cos-nume">
                    {{$topping['name']}}
                </div>
                <div class="topping-cos-pret">
                @if(str_contains($produs->options['name'], 'XXL'))
                    ({{$topping['price']*3}} lei)
                @else
                ({{$topping['price']}} lei)
                @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>


       
        <div class="topping-button-div">
        <button class="produs-banner-buton cos-adauga" onclick="modifica_extra('{{$produs->rowId}}')">
                <div class="produs-buton-custom-text">Confirma</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
        </div>
    </div>
</div>

@if(isset($produs->options['removed']))
@if(count($produs->options['removed']) > 0)
<div class = "cos-produs-specificatii">Ingrediente scoase:
@foreach($produs->options['removed'] as $value)
    <span>{{$value['name']}}, </span>
@endforeach
</div>
@endif
@endif
@if(isset($produs->options['extra']))
@if(count($produs->options['extra']) > 0)
<div class = "cos-produs-specificatii">Toping extra:
@foreach($produs->options['extra'] as $value)
    @if(str_contains($produs->options['name'], 'XXL'))
        <span>{{$value['name']}} ( {{$value['price']*3}} lei), </span>
    @else
    <span>{{$value['name']}} ( {{$value['price']}} lei), </span>
    @endif
@endforeach
</div>
@endif
@endif
        <div class="produs-buton-group">
            <button id="adauga-topping-button" onclick="topping_buton('{{$produs->rowId}}')" class="produs-banner-buton">
                <div class="produs-buton-custom-text" >Adauga toping</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button>
            <!-- <button class="produs-banner-buton">
                <div class="produs-buton-custom-text">Alege tipul de paste</div>
                <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
            </button> -->
        </div>
@endif


            </div>
            </div>
            <div class = "cantitate-container">
                <div class = "adauga-cantitate">
                    <div class = "adauga-buton cursor-pointer" onclick="modifica_cantitate('{{$produs->qty-1}}', '{{$produs->rowId}}')">-</div>
                    <div class = "cantitate">{{$produs->qty}}</div>
                    <div class = "adauga-buton cursor-pointer" onclick="modifica_cantitate('{{$produs->qty+1}}', '{{$produs->rowId}}')">+</div>
                </div>
                <div class = "produs-pret-container">
                    <div class = "produs-pret-mare">{{$produs->price*$produs->qty}}</div>
                    <div class = "produs-pret-lei">lei</div>
                </div>
            </div>
        </div>
@endforeach