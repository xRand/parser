<div class="row listing-row" style="margin-top: -10px;">
    <div class="pull-left">
        <strong>Today, Saturday 14th September</strong>
    </div>
    <div class="pull-right">

        <form method="GET" action="" class="form-inline">
            <span style="">Sort by:&nbsp;&nbsp;&nbsp;</span>
            <select name="sort" id="sort-list">
                <option value="price_asc" {{ ($sortOption == 'price_asc' ? 'selected':'') }}>Lowest Price</option>
                <option value="price_desc" {{ ($sortOption == 'price_desc' ? 'selected':'') }}>Highest Price</option>
                <option value="date_desc" {{ ($sortOption == 'date_desc' ? 'selected':'') }}>Newest Posted</option>
                <option value="date_asc" {{ ($sortOption == 'date_asc' ? 'selected':'') }}>Oldest Posted</option>
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