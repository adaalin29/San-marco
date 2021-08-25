@extends('parts.template') @section('content')
<div class="container page-container">
  <div class = "error-container">
    <div class = "error-left">
      <img src = "images/404.svg"class = "full-width object-cover">
    </div>
    <div class = "error-right">
      <div class = "error-title">Oops, Eroare 404</div>
      <div class = "error-text">Pagina nu a fost gasita, te rog intoarce-te pe pagina anterioara</div>
      <a href="" class="produs-banner-buton intoarce-te">
        <div class="produs-buton-custom-text">Intoarce-te</div>
        <div class="produs-buton-custom-img"><img src="images/vezi.svg" class="full-width" style="object-fit:cover"></div>
      </a>
    </div>
  </div>
  
</div>
@endsection