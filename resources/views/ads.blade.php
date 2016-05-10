@extends('layouts.layout')

@section('header')
    <div class="container">
        @include('partials/search')
    </div>

@endsection


@section('content')

    <div class="row">
        <div class="col-sm-4  hidden-xs">
            <div class="sidebar ">

                <br>

                <div class="row ">


                    <div class="col-sm-11">

                        <div class="panel panel-default">
                            <div class="panel-heading">Filters</div>
                            <div class="panel-body">
                                <form class="form-inline mini" style="margin-bottom: 0px;">
                                    <fieldset>

                                        <div class="row filter-row">
                                            <div class="col-sm-6">
                                                <label>Make</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class=" form-control ">
                                                    <option>Any</option>
                                                    <option>Alfa romeo</option>
                                                    <option>Houses</option>
                                                    <option>Flats/ Apartments</option>
                                                    <option>Bungalows</option>
                                                    <option>Land</option>
                                                    <option>Commercial property</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row filter-row">
                                            <div class="col-sm-6">
                                                <label>Mileage</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="col-sm-10 form-control ">
                                                    <option>Any</option>
                                                    <option>Alfa romeo</option>
                                                    <option>Houses</option>
                                                    <option>Flats/ Apartments</option>
                                                    <option>Bungalows</option>
                                                    <option>Land</option>
                                                    <option>Commercial property</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row filter-row">
                                            <div class="col-sm-6">
                                                <label>Seller type</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="col-sm-10 form-control ">
                                                    <option>Any</option>
                                                    <option>Alfa romeo</option>
                                                    <option>Houses</option>
                                                    <option>Flats/ Apartments</option>
                                                    <option>Bungalows</option>
                                                    <option>Land</option>
                                                    <option>Commercial property</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row">
                                            <div class="col-sm-6">
                                                <label>Body type</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="col-sm-10 form-control ">
                                                    <option>Any</option>
                                                    <option>Alfa romeo</option>
                                                    <option>Houses</option>
                                                    <option>Flats/ Apartments</option>
                                                    <option>Bungalows</option>
                                                    <option>Land</option>
                                                    <option>Commercial property</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row">
                                            <div class="col-sm-6">
                                                <label>Fuel type</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="col-sm-10 form-control ">
                                                    <option>Any</option>
                                                    <option>Alfa romeo</option>
                                                    <option>Houses</option>
                                                    <option>Flats/ Apartments</option>
                                                    <option>Bungalows</option>
                                                    <option>Land</option>
                                                    <option>Commercial property</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row filter-row">
                                            <div class="col-sm-6">
                                                <label>Age</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="col-sm-10 form-control ">
                                                    <option>Any</option>
                                                    <option>Alfa romeo</option>
                                                    <option>Houses</option>
                                                    <option>Flats/ Apartments</option>
                                                    <option>Bungalows</option>
                                                    <option>Land</option>
                                                    <option>Commercial property</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row filter-row">
                                            <div class="col-sm-12">
                                                <label>Price range</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="email" class="form-control price-input" placeholder="min">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="email" class="form-control price-input" placeholder="max">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row filter-row">
                                            <div class="col-sm-12">
                                                <label>Search only:</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" value="option1" checked="">
                                                        Urgent ads
                                                    </label>
                                                </div><br>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" value="option2">
                                                        Featured ads
                                                    </label>
                                                </div><br>

                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="optionsRadios" value="option2">
                                                        Only ads with pictures
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row filter-row">

                                            <div class="col-sm-2 pull-right" style="margin-top: 10px;">
                                                <button class="btn btn-primary pull-right" type="submit">Update results</button>

                                            </div>
                                        </div>


                                    </fieldset>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="row ">
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">Refine category</div>
                            <div class="panel-body">
                                <ul class="nav nav-category">
                                    <li>
                                        <a class="active" href="category.html">All categories</a>
                                        <ul>
                                            <li><a href="listings.html">Cars, Vans &amp; Motorbikes</a>
                                                <ul>
                                                    <li><a class="active" href="listings.html">Cars</a>
                                                        <ul>
                                                            <li><a class="active" href="listings.html"><strong>Porsche</strong></a> (66)<a href="#" class="remove-category"><i class="fa fa-times"></i></a></li>
                                                        </ul>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">Refine category</div>
                            <div class="panel-body">

                                <div class="property">
                                    <a href="#AC+Cobra">AC Cobra</a>
                                </div>
                                <div class="property">
                                    <a href="#Acura">Acura</a>
                                </div>
                                <div class="property">
                                    <a href="#Alfa+Romeo">Alfa Romeo</a>
                                </div>
                                <div class="property">
                                    <a href="#American+Motors">American Motors</a>
                                </div>
                                <div class="property">
                                    <a href="#Aston+Martin">Aston Martin</a>
                                </div>
                                <div class="more" id="more_make_link"><a href="#" class="more link-info" id="more_make">More ...</a></div>
                                <div id="more_make_list" style="display: none;">
                                    <div class="property">
                                        <a href="#Audi">Audi</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Austin+Healey">Austin Healey</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Avanti">Avanti</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Bentley">Bentley</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Bitter">Bitter</a>
                                    </div>
                                    <div class="property">
                                        <a href="#BMW">BMW</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Bricklin">Bricklin</a>
                                    </div>
                                    <div class="property">
                                        <a href="#British+Leyland">British Leyland</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Bugatti">Bugatti</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Buick">Buick</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Cadillac">Cadillac</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Caterham">Caterham</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Chevrolet">Chevrolet</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Chrysler">Chrysler</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Citroen">Citroen</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Daewoo">Daewoo</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Daihatsu">Daihatsu</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Dodge">Dodge</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Eagle">Eagle</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Ferrari">Ferrari</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Fiat">Fiat</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Ford">Ford</a>
                                    </div>
                                    <div class="property">
                                        <a href="#FUJI+HEAVY+IND">FUJI HEAVY IND</a>
                                    </div>
                                    <div class="property">
                                        <a href="#General+Motors">General Motors</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Geo">Geo</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Ginetta">Ginetta</a>
                                    </div>
                                    <div class="property">
                                        <a href="#GMC">GMC</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Holden">Holden</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Honda">Honda</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Hummer">Hummer</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Hyundai">Hyundai</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Infiniti">Infiniti</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Isuzu">Isuzu</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Jaguar">Jaguar</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Jeep">Jeep</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Jensen">Jensen</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Kaiser">Kaiser</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Kia">Kia</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Lada">Lada</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Laforza">Laforza</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Lamborghini">Lamborghini</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Lancia">Lancia</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Land+Rover">Land Rover</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Lexus">Lexus</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Lincoln">Lincoln</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Lotus">Lotus</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Maserati">Maserati</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Matra">Matra</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Maybach">Maybach</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Mazda">Mazda</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Mercedes-Benz">Mercedes-Benz</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Mercury">Mercury</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Merkur">Merkur</a>
                                    </div>
                                    <div class="property">
                                        <a href="#MG">MG</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Mini">Mini</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Mitsubishi">Mitsubishi</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Morgan">Morgan</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Nissan">Nissan</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Oldsmobile">Oldsmobile</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Opel">Opel</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Peugeot">Peugeot</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Plymouth">Plymouth</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Pontiac">Pontiac</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Porsche">Porsche</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Renault">Renault</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Rolls-Royce">Rolls-Royce</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Rover">Rover</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Saab">Saab</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Saturn">Saturn</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Scion">Scion</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Skoda">Skoda</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Smart">Smart</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Studebaker">Studebaker</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Subaru">Subaru</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Suzuki">Suzuki</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Tatra">Tatra</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Toyota">Toyota</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Trabant">Trabant</a>
                                    </div>
                                    <div class="property">
                                        <a href="#TVR">TVR</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Vauxhall">Vauxhall</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Volkswagen">Volkswagen</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Volvo">Volvo</a>
                                    </div>
                                    <div class="property">
                                        <a href="#Yugo">Yugo</a>
                                    </div>
                                    <div class="more"><a id="less_make" href="#" class="more link-info">Less ...</a></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">Location</div>
                            <div class="panel-body">
                                <ul class="nav">
                                    <li>
                                        <a class="active" href="category.html">Greater London (12)</a>
                                        <ul>
                                            <li><a href="listings.html"> - Central London (11)</a></li>
                                            <li><a class="active" href="listings.html"> - East London (1)</a></li>
                                            <li><a class="active" href="listings.html"> - North London (1)</a></li>
                                            <li><a class="active" href="listings.html"> - North London (1)</a></li>
                                            <li><a class="active" href="listings.html"> - North West London  (1)</a></li>
                                            <li><a class="active" href="listings.html"> - South East London  (1)</a></li>
                                            <li><a class="active" href="listings.html"> - South West London  (1)</a></li>
                                            <li><a class="active" href="listings.html"> - West London  (1)</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="category.html">Brighton (5)</a></li>
                                    <li><a href="category.html">Cambridge (2)</a></li>
                                    <li><a href="category.html">Essex (2)</a></li>
                                    <li><a href="category.html">Guildford (2)</a></li>
                                    <li><a href="category.html">Kent (2)</a></li>
                                    <li><a href="category.html">Luton (2)</a></li>
                                    <li><a href="category.html">Milton Keynes (2)</a></li>
                                    <li><a href="category.html">Oxford (2)</a></li>
                                    <li><a href="category.html">Reading (2)</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>









        <div class="col-sm-8 pull-right listings">

            @include('partials/sort')


            @foreach($ads as $ad)

                <div class="row  listing-row">
                    <div class="col-sm-2">
                        <a href="{{$ad->url}}" class="thumbnail ">
                            <img alt="176 * 120" src="{{$ad->img == 'noimage' ? url('/img/noimage.png') : $ad->img}}">
                        </a>
                    </div>

                    <div class="col-sm-10">
                        <h3><a class="" href="{{$ad->url}}" onclick="centeredPopup(this.href);return false">{{$categoryName}} {{$ad->model}} - <strong>{{$ad->price}}</strong></a></h3>

                        <p class="muted">Posted at {{$ad->created_at->toDateString()}}</p>
                        <p>{{$ad->description}}...</p>
                        <p class="ad-description">
                            <strong>{{$ad->year}}</strong> |

                            <strong>{{$ad->mileage}}</strong> |

                            <strong>{{$ad->capacity}}</strong>
                        </p>
                        <p>
                        <span class="classified_links pull-right">
                            <a class="link-info underline" href="#">Share</a>&nbsp;
                            <a class="link-info underline" href="#">Add to favorites</a>
                            &nbsp;<a class="link-info underline" href="details.html">Details</a>&nbsp;
                            &nbsp;<a class="link-info underline" href="#">Contact</a></span>
                        </p>
                    </div>
                </div>


             @endforeach

            <div class="pagination">
                {{ $ads->appends(['sort' => $sortOption])->render() }}
            </div>

        </div>

    </div>

@endsection

@section('footer')
<script>
    var popupWindow = null;
    function centeredPopup(url){
        var w = (screen.width) ? (screen.width)/1.5 : 700;
        var h = (screen.height) ? (screen.height)/1.5 : 600;
        var LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
        var TopPosition = (screen.height) ? (screen.height-h)/2 : 0;

        var settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars,resizable';
        popupWindow = window.open(url,'my',settings);
    }
</script>
@append