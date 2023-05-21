{{--<h1>Demo view</h1>--}}
{{--<h2>{{$welcome}}</h2>--}}
{{--<h2>{{!empty(request()->name) ? request()->name : 'Nothing'}}</h2>--}}
{{--<div class="container">--}}
{{--    {!! $contents !!}--}}
{{--</div>--}}
{{--<hr>--}}
{{--@for($i = 0;$i <=10; $i++)--}}
{{--    <p>Element: {{$i}}</p>--}}
{{--@endfor--}}
{{--<hr>--}}
{{--@while($index <= 10)--}}
{{--    <p>Element: {{$index}}</p>--}}
{{--    --}}{{--    <?php $index++; ?>--}}
{{--    @php--}}
{{--        $index++;--}}
{{--    @endphp--}}
{{--@endwhile--}}
{{--<hr>--}}
{{--@foreach($dataArr as $key => $item)--}}
{{--    <p>{{$item}} - {{$key}}</p>--}}
{{--@endforeach--}}

{{--@forelse($dataArr as $key => $item)--}}
{{--    <p>{{$item}} - {{$key}}</p>--}}
{{--@empty--}}
{{--    <p>No element</p>--}}
{{--@endforelse--}}

{{--@if($number < 0)--}}
{{--    <p>Value negative</p>--}}
{{--@elseif ($number < 5)--}}
{{--    <p>Value from 0 to 4</p>--}}
{{--@elseif ($number < 10)--}}
{{--    <p>Value from 5 to 9</p>--}}
{{--@else--}}
{{--    <p>Value bigger 10</p>--}}
{{--@endif--}}

{{--@switch($number)--}}
{{--    @case(1)--}}
{{--    @case(3)--}}
{{--        <p>Number 1</p>--}}
{{--        @break--}}
{{--    @case(2)--}}
{{--    @case(4)--}}
{{--        <p>Number 2</p>--}}
{{--        @break--}}
{{--    @case(5)--}}
{{--    @case(6)--}}
{{--        <p>Number 3</p>--}}
{{--        @break--}}
{{--    @default--}}
{{--        <p>Number 4</p>--}}
{{--        @break--}}
{{--@endswitch--}}

{{--<hr>--}}
{{--@for($i = 0;$i <=10; $i++)--}}
{{--    <p>Element: {{$i}}</p>--}}
{{--    @if($i == 5)--}}
{{--        @break--}}
{{--    @endif--}}
{{--@endfor--}}
{{--<hr>--}}
{{--@for($i = 0;$i <=10; $i++)--}}
{{--    @if($i == 5)--}}
{{--        @break--}}
{{--    @endif--}}
{{--    <p>Element: {{$i}}</p>--}}
{{--@endfor--}}
{{--<hr>--}}
{{--@for($i = 0;$i <=10; $i++)--}}
{{--    @if($i == 5)--}}
{{--        @continue--}}
{{--    @endif--}}
{{--    <p>Element: {{$i}}</p>--}}
{{--@endfor--}}
{{--<hr>--}}
{{--@php--}}
{{--$number = 10;--}}
{{--$total = $number + 20;--}}
{{-- @endphp--}}
{{--<h3>{{$number}} - {{$total}}</h3>--}}
{{-- @php--}}
{{--// $message = 'Demo include';--}}
{{-- @endphp--}}
{{--@include('parts.notice')--}}

@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection

@section('contents')

    @if(session('msg'))
        <div class="alert alert-{{session('type')}}">
            {{ session('msg') }}
        </div>
    @endif

    <h1>Home page</h1>
    {{--    @datetime("2023-05-04 10:30")--}}
    @include('clients.contents.slide')
    @include('clients.contents.about')
    {{--    @datetime("2023-05-04 10:43")--}}

    {{--    APP_ENV ở .env--}}
    @nhan('local')
    <p>Moi truong dev</p>
    @endnhan

    {{--    <x-alert type="danger" content="Demo success"/>--}}
    <x-alert type="danger" :content="$title" data-icon="youtube"/>
    <p><img src="https://znews-photo.zingcdn.me/w1000/Uploaded/asfzyreslz2/2023_04_18/1200x_1_3_.jpg" alt=""></p>

    <p>
        <a href="{{route('download-image').'?image='.'https://znews-photo.zingcdn.me/w1000/Uploaded/asfzyreslz2/2023_04_18/1200x_1_3_.jpg'}}"
           class="btn btn-primary">Download image</a></p>
@endsection

@section('css')
    img{
    max-width: 100%;
    height: auto;
    }
@endsection

@section('js')
    <script>

    </script>
@endsection
