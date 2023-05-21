@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

{{--@section('sidebar')--}}
{{--    @parent--}}
{{--    <h3>Product sidebar</h3>--}}
{{--@endsection--}}

@section('contents')
    <h1>Product page</h1>
    @if(session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif
{{--    <x-package_alert/>--}}
    <x-inputs.button/>
{{--    <x-form.button/>--}}
    <x-form.button/>
    @push('scripts')
        <script>
            console.log('Push lan 2');
        </script>
    @endpush
@endsection

@section('css')

@endsection

@section('js')
{{--    <script>--}}
{{--        console.log('ok');--}}
{{--    </script>--}}
@endsection

@prepend('scripts')
    <script>
        console.log('Push lan 1');
    </script>
@endprepend
