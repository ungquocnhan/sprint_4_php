<h2>Demo view with response</h2>
{{--<h3>{{$title}}</h3>--}}
@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
<form action="" method="post">
    <input type="text" name="username" placeholder="Enter username..." value="{{old('username')}}"/>
    @csrf
    <button type="submit" class="btn btn-success">Submit</button>
</form>
