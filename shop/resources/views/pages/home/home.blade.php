@extends('layouts.app')

@section('content')
<div class="container">
    <div id="carousel-home" class="carousel slide" data-ride="carousel">
        {{-- <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol> --}}
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/63c77c04dc6448548ccbae880189e107_9366/Zapatilla_Galaxy_6_Negro_GW3848_01_standard.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/02cd9a97ce874d89ba17ae2b003ebe50_9366/Zapatilla_Grand_Court_Lifestyle_Tennis_Lace-Up_Blanco_GW6511_01_standard.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://assets.adidas.com/images/w_600,f_auto,q_auto/4a46e180c40643c8b436af9c017a4615_9366/Zapatilla_Samba_adidas_Originals_Verde_ID2054_01_standard.jpg" alt="Third slide">
          </div>
        </div>
        {{-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a> --}}
      </div>
</div>
@endsection