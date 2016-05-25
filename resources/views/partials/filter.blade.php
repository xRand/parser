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
                                    <select class="form-control">
                                        <option>{{$categoryName}}</option>
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
                                    <select class="form-control">
                                        <option>{{$model='all' ? 'Все модели' : $model}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row filter-row">
                            <div class="col-sm-12">
                                <label>Цена</label>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control price-input" placeholder="от" name="price_min">
                                    <span class="input-group-addon">€</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control price-input" placeholder="до" name="price_max">
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
                                    <select class="form-control">
                                        <option>от</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group col-sm-12">
                                    <select class=" form-control">
                                        <option>до</option>
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
                                    <input type="text" class="form-control" placeholder="от" name="mileage_min">
                                    <span class="input-group-addon">км</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="до" name="mileage_max">
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
                                    <select class="form-control">
                                        <option>от</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="input-group col-sm-12">
                                    <select class=" form-control">
                                        <option>до</option>
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