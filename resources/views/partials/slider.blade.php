<div class="slider-area">
    <div class="slider">
        <div id="bg-slider" >
            <div class="item">
                <img src="{{ URL::to('img/widecar.jpg') }}" alt="auto" >
                <div class="mask"></div>
            </div>
        </div>
    </div>
    <div class="container slider-content">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <h2>Найдите себе авто</h2>
                <p>Здесь собраны все объявления о продаже автомобилей в Латвии</p>
                @include('partials/search')
            </div>
        </div>
    </div>
</div>