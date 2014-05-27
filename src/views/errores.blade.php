@if ($errors->any())
<div class="alert alert-danger">
<ul id="error">
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
</div>

@endif

