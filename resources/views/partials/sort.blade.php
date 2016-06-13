<div class="row listing-row" style="margin-top: -10px;">
    <div class="pull-left">

    </div>
    <div class="pull-right">

        <form method="GET" class="form-inline">
            <span>Сортировать по:&nbsp;&nbsp;&nbsp;</span>
            <select name="sort" id="sort-list">
                <option value="price_asc" {{ ($sortOption == 'price_asc' ? 'selected':'') }}>Цене (дешевые сначала)</option>
                <option value="price_desc" {{ ($sortOption == 'price_desc' ? 'selected':'') }}>Цене (дорогие сначала)</option>
                <option value="date_desc" {{ ($sortOption == 'date_desc' ? 'selected':'') }}>Дате (новые сначала)</option>
                <option value="date_asc" {{ ($sortOption == 'date_asc' ? 'selected':'') }}>Дате (старые сначала)</option>
            </select>
        </form>

    </div>
</div>

@section('footer')
    <script>
        $('#sort-list').change(function() {
            this.form.submit();
        });
    </script>
@append