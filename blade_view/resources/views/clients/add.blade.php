@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('contents')
    <h1>Add product</h1>

    <form action="{{route('store')}}" method="post" id="product-form">
        {{--        @if($errors->any())--}}
        {{--            <div class="alert alert-danger">--}}
        {{--                {{$errorMessage}}--}}
        {{--            </div>--}}
        {{--        @endif--}}
{{--        @error('msg')--}}
{{--        <div class="alert alert-danger text-center">{{$message}}</div>--}}
{{--        @enderror--}}
        <div class="alert alert-danger text-center msg" style="display: none"></div>
        <div class="mb-3">
            <label for="name_product">Name product</label>
            <input type="text" class="form-control" name="name_product" id="name_product"
                   placeholder="Enter name product" value="{{old('name_product')}}">
            {{--            @error('name_product')--}}
            {{--            <span style="color: red">{{$message}}</span>--}}
            {{--            @enderror--}}
            <span style="color: red" class=" error name_product_error"></span>

        </div>

        <div class="mb-3">
            <label for="price_product">Price product</label>
            <input type="text" class="form-control" name="price_product" id="price_product"
                   placeholder="Enter price product" value="{{old('price_product')}}">
            {{--            @error('price_product')--}}
            {{--            <span style="color: red" class="price_product_error">{{$message}}</span>--}}
            {{--            @enderror--}}
            <span style="color: red" class="error price_product_error"></span>

        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('css')

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#product-form').on('submit', function (e) {
                e.preventDefault();
                let nameProduct = document.getElementById('name_product').value;
                // let name_product = $('input[name="name_product"]').val().trim();
                let priceProduct = document.getElementById('price_product').value;

                let actionUrl = $(this).attr('action');

                let csrfToken = $(this).find('input[name="_token"]').val();

                $('.error').text('');

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: {
                        name_product: nameProduct,
                        price_product: priceProduct,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {

                        $('.msg').show();

                        let responseJSON = error.responseJSON.errors;

                       if (Object.keys(responseJSON).length > 0) {
                           $('.msg').text(responseJSON.msg)
                           for (let key in responseJSON) {
                               $('.' + key + '_error').text(responseJSON[key][0]);
                           }
                       }


                    }
                })

            })
        })
    </script>
@endsection

