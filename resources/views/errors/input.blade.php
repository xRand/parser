@if (count($errors) > 0)
    <div class="alert alert-danger">
        Возникла проблема со входом.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif