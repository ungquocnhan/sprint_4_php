@extends('layouts.client')

@section('title')
    {{$title}}
@endsection

@section('contents')
    <h1>Danh sách sản phẩm</h1>
    <hr>

    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-3">
                <select name="flag_promoted" id="" class="form-control">
                    <option value="0">Chọn khuyến mãi</option>
                    <option value="active" {{request()->flag_promoted=='active'?'selected':false}}>Khuyến mãi</option>
                    <option value="inactive"
                        {{request()->flag_promoted=='inactive'?'selected':false}}>Không khuyến mãi
                    </option>
                </select>
            </div>
            <div class="col-3">
                <select name="manufacture_id" id="" class="form-control">
                    <option value="0">Choose manufacture</option>
                    @if(!empty(getAllManufacture()))
                        @foreach(getAllManufacture() as $item)
                            <option value="{{$item->id}}"
                                {{request()->manufacture_id==$item->id?'selected':false}}>
                                {{$item->name}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="col-4">
                <input type="search"
                       class="form-control"
                       name="keySearch"
                       placeholder="Key search..."
                       value="{{request()->keySearch}}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
    </form>

    <a href="{{route('products.create')}}" class="btn btn-primary mt-3 mb-3">Thêm sản phẩm</a>


    @if(!empty($products))

        <div class="row px-5">
            @foreach($products as $product)
                <div class="col-4" style="margin: 10px 0">
                    <div class="card">
                        <a class="card-link"
                           style="float: right; text-decoration: none; color: teal">
                            <img src="{{$product->imageUrl}}"
                                 height="240" width="100%"
                                 alt="No image"/>
                            <div class="card-body">
                                <h5 class="card-title" style="min-height: 72px">{{$product->name}} </h5>
                                <p class="card-text fw-bold">Giá: {!!$product->percentPromotion != 0 ?
                                    number_format($product->price
                                    - $product->price
                                    * $product->percentPromotion, 0, ","). ' VND' :
                                    number_format($product->price, 0, ","). ' VND' !!}
                                    <sup class="text-bg-danger">
                                        {{$product->percentPromotion != 0 ?
                                        '-'. $product->percentPromotion * 100 . '%' :
                                        ''}}
                                    </sup>
                                </p>
                                <p class="card-text">Băng tần: {{$product->nameFrequencyBand}}</p>
                                <p class="card-text">Tốc độ: {{$product->nameSpeedWifi}}</p>
                                <p class="card-text">Hỗ trợ tối đa: {{$product->nameUserConnect}}</p>
                                <p class="card-text">Bán kính phủ sóng: {{$product->nameCoverageDensity}}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-end">
            {{$products->links()}}
        </div>
    @else
        <h2 class="text-center text-warning">Không có dữ liệu.</h2>
    @endif

@endsection

@section('css')

@endsection

@section('js')

@endsection
