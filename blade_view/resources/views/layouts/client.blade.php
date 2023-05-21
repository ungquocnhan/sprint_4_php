<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    <title>Trang web demo</title>--}}
    <title>@yield('title') - Quoc Nhan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/clients/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/clients/css/style.css')}}">
    <style>
        @yield('css')
    </style>

</head>
<body>
@include('clients.blocks.header')
<main class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <aside>
                    {{--        Main sidebar--}}
                    @section('sidebar')
                        @include('clients.blocks.sidebar')
                    @show
                </aside>
            </div>
            <div class="col-9">
                <div class="content">
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>
</main>
@include('clients.blocks.footer')
{{--@section('sidebar')--}}
{{--    <p>Main sidebar</p>--}}
{{--@endsection--}}
<script src="{{asset('assets/clients/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/clients/js/custom.js')}}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@yield('js')
@stack('scripts')
</body>
</html>
