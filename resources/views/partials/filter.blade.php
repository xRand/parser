<div class="row ">
    <div class="col-sm-11">
        <div class="panel panel-default">
            <div class="panel-heading">Фильтры</div>
            <div class="panel-body">
                <form method="GET" class="form-inline mini" style="margin-bottom: 0px;">
                    <fieldset>
                        <div class="row filter-row">
                            <div class="col-sm-4">
                                <label>Марка</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group col-sm-12">
                                    <select class="form-control" onChange="getFilterModels(this.value);">
                                        @foreach($categories as $category)
                                            @if($category->name == $categoryName)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-row">
                            <div class="col-sm-4">
                                <label>Модель</label>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group col-sm-12">
                                    <select id="filter-model-list" class="form-control" disabled>
                                        <option>{{$model=='all' ? 'Все модели' : $model}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @section('footer')
                            <script>
                                function getFilterModels(id) {
                                    $.ajax({
                                        type: "POST",
                                        url: "",
                                        data: {'id' : id},
                                        success: function(data){
                                            $("#filter-model-list").prop("disabled", false).html(data);
                                        },
                                        error: function(){
                                            $("#filter-model-list").prop("disabled", true).html('<option value="all" selected>Все модели</option>');
                                        }
                                    });
                                }
                            </script>
                        @append
                        <div class="row filter-row">
                            <div class="col-sm-12">
                                <label>Цена</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control price-input" placeholder="от" name="price_min"
                                           value="{{empty($filterOptions['price_min']) ? '' : $filterOptions['price_min']}}">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control price-input" placeholder="до" name="price_max"
                                           value="{{empty($filterOptions['price_max']) ? '' : $filterOptions['price_max']}}">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-row">
                            <div class="col-sm-12">
                                <label>Год выпуска</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group col-sm-12">
                                    <select name="year_min" class="form-control">
                                        <option value="">от</option>
                                        @for($i = 1980; $i<=2016; $i++)
                                            @if(!empty($filterOptions['year_min']) && $i == $filterOptions['year_min'])
                                                <option selected>{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group col-sm-12">
                                    <select name="year_max" class=" form-control">
                                        <option value="">до</option>
                                        @for($i = 2016; $i>1980; $i--)
                                            @if(!empty($filterOptions['year_max']) && $i == $filterOptions['year_max'])
                                                <option selected>{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-row">
                            <div class="col-sm-12">
                                <label>Пробег</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="от" name="mileage_min"
                                           value="{{empty($filterOptions['mileage_min']) ? '' : $filterOptions['mileage_min']}}">
                                    <span class="input-group-addon">км</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="до" name="mileage_max"
                                           value="{{empty($filterOptions['mileage_max']) ? '' : $filterOptions['mileage_max']}}">
                                    <span class="input-group-addon">км</span>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-row">
                            <div class="col-sm-12">
                                <label>Объем двигателя</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group col-sm-12">
                                    <select class="form-control" name="cap_min">
                                        <option value="">от</option>
                                        @for($i = 1.0; $i<=8.0; $i+=0.1)
                                            @if(!empty($filterOptions['cap_min']) && round($i, 1) == round($filterOptions['cap_min'], 1))
                                                <option selected>{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group col-sm-12">
                                    <select class=" form-control" name="cap_max">
                                        <option value="">до</option>
                                        @for($i = 8.0; $i>=1.0; $i-=0.1)
                                            @if(!empty($filterOptions['cap_max']) && round($i, 1) == round($filterOptions['cap_max'], 1))
                                                <option selected>{{$i}}</option>
                                            @else
                                                <option>{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row filter-row">
                            <div class=" col-sm-offset-5 col-sm-3" style="margin-top: 10px">
                                <button class="btn btn-primary pull-right" type="submit">Показать</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>