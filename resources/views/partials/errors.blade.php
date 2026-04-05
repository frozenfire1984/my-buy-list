@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li style="color: red;">{{ $error }}</li>
        @endforeach
    </ul>
@endif
