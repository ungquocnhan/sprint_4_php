@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection

@section('contents')
    <h1>Home page</h1>
    @include('clients.contents.slide')
    @include('clients.contents.about')
@endsection

@section('css')
    /*img{*/
/*    max-width: 100%;*/
/*    height: auto;*/
/*    }*/
@endsection

@section('js')
    <script>

    </script>
@endsection
