@extends('parts.template') @section('content')
<div class="container page-container">
    <div class="comanda-container">
        <div class="comanda-left">
            <div class="comanda-title">Multumim pentru comanda</div>
            <div class="timp-container">
                <div class="timp-element">
                    <div class="timp-imagine"><img src="images/foc.svg" class="full-width object-cover"></div>
                    <div class="timp-descriere">
                        In cel mai scurt timp vei fi contactat de un operator pentru confirmarea comenzii.
                        <br>
                        Iti reamintim ca timpul mediu de preparare si livrare este
                        de 45 de minute.
                    </div>
                </div>
                <div class="timp-element">
                    <div class="timp-imagine"><img src="images/puncte.svg" class="full-width object-cover"></div>
                    <div class="timp-descriere">
                        Pentru aceasta comanda ai adunat 20 lei. Afla mai multe despre banii acumulati apasand butonul de mai jos.
                    </div>
                    <a href="" class="produs-banner-buton puncte puncte-modificat">
                        <div class="produs-buton-custom-text">VEZI PUNCTELE</div>
                        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="comanda-right">
            <div class = "comanda-top">
                <div class = "comanda-titlu">COMANDA:</div>
                <div class = "comenzi">
                    <div class = "comanda">
                        <div class = "comanda-produs">
                            <div class = "comanda-imagine"><img src = "images/pizza.png" class = "full-width object-cover"></div>
                            <div class = "comanda-produs-container-title">
                                <div class = "comanda-produs">Pizza San Marco</div>
                                <div class = "comanda-specificatii-mobile desktop-hidden">
                                    <div class = "cantitate">X1</div>
                                    <div class = "pret">22,26 lei</div>
                                </div>
                            </div>
                        </div>
                        <div class = "cantitate mobile-hidden">X1</div>
                        <div class = "pret mobile-hidden">22,26 lei</div>
                    </div>
                    <div class = "comanda">
                        <div class = "comanda-produs">
                            <div class = "comanda-imagine"><img src = "images/pizza.png" class = "full-width object-cover"></div>
                            <div class = "comanda-produs-container-title">
                                <div class = "comanda-produs">Pizza San Marco</div>
                                <div class = "comanda-specificatii-mobile desktop-hidden">
                                    <div class = "cantitate">X1</div>
                                    <div class = "pret">22,26 lei</div>
                                </div>
                            </div>
                        </div>
                        <div class = "cantitate mobile-hidden">X1</div>
                        <div class = "pret mobile-hidden">22,26 lei</div>
                    </div>
                    <div class = "comanda">
                        <div class = "comanda-produs">
                            <div class = "comanda-imagine"><img src = "images/pizza.png" class = "full-width object-cover"></div>
                            <div class = "comanda-produs-container-title">
                                <div class = "comanda-produs">Pizza San Marco</div>
                                <div class = "comanda-specificatii-mobile desktop-hidden">
                                    <div class = "cantitate">X1</div>
                                    <div class = "pret">22,26 lei</div>
                                </div>
                            </div>
                        </div>
                        <div class = "cantitate mobile-hidden">X1</div>
                        <div class = "pret mobile-hidden">22,26 lei</div>
                    </div>
                    <div class = "comanda">
                        <div class = "comanda-produs">
                            <div class = "comanda-imagine"><img src = "images/pizza.png" class = "full-width object-cover"></div>
                            <div class = "comanda-produs-container-title">
                                <div class = "comanda-produs">Pizza San Marco</div>
                                <div class = "comanda-specificatii-mobile desktop-hidden">
                                    <div class = "cantitate">X1</div>
                                    <div class = "pret">22,26 lei</div>
                                </div>
                            </div>
                        </div>
                        <div class = "cantitate mobile-hidden">X1</div>
                        <div class = "pret mobile-hidden">22,26 lei</div>
                    </div>
                    <div class = "comanda">
                        <div class = "comanda-produs">
                            <div class = "comanda-imagine"><img src = "images/pizza.png" class = "full-width object-cover"></div>
                            <div class = "comanda-produs-container-title">
                                <div class = "comanda-produs">Pizza San Marco</div>
                                <div class = "comanda-specificatii-mobile desktop-hidden">
                                    <div class = "cantitate">X1</div>
                                    <div class = "pret">22,26 lei</div>
                                </div>
                            </div>
                        </div>
                        <div class = "cantitate mobile-hidden">X1</div>
                        <div class = "pret mobile-hidden">22,26 lei</div>
                    </div>
                </div>
            </div>
            <div class = "comanda-bottom">
                <div class = "comanda-descriere">
                    <div class = "comanda-descriere-text">Transport:</div>
                    <div class = "comanda-descriere-text">5.00 lei</div>
                </div>
                <div class = "comanda-descriere">
                    <div class = "comanda-descriere-text">Sub-total:</div>
                    <div class = "comanda-descriere-text">5.00 lei</div>
                </div>
                <div class = "comanda-descriere">
                    <div class = "comanda-descriere-text">Discount puncte:</div>
                    <div class = "comanda-descriere-text">5.00 lei</div>
                </div>
                <div class = "comanda-descriere total">
                    <div class = "comanda-descriere-text">TOTAL: 3 produse</div>
                    <div class = "comanda-descriere-text">5.00 lei</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection