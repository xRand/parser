<div class="search-form">
    <form method="POST" action="{{ action('CategoryController@search') }}" class="form-inline" >
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Job Key Word">
        </div>
        <div class="form-group">
            <select name="category" id="category-list" class="form-control" onChange="getModels(this.value);">
                <option value="all" selected>Any category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name="model" id="model-list" class="form-control" disabled>
                <option value="all" selected>Any Model</option>
            </select>
        </div>
        <input type="submit" class="btn" value="Search">
    </form>
</div>

@section('footer')
<script>
    function getModels(id) {
        $.ajax({
            type: "POST",
            url: "",
            data: {'id' : id},
            success: function(data){
                $("#model-list").prop("disabled", false).html(data);
            },
            error: function(){
                $("#model-list").prop("disabled", true).html('<option value="all" selected>Any model</option>');
            }
        });
    }
</script>
@append