@extends('layouts.client')

@section('title')
    {{$title}}
@endsection

@section('sidebar')
    @parent
    <ul>
        <li>
            <a href="{{route('products.create')}}" style="text-decoration: none">Thêm sản phẩm</a>
        </li>
    </ul>
@endsection

@section('contents')
    <h1>{{$title}}</h1>
    @if(session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif
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

    @if(!empty($products))

        <div class="row px-5">
            @foreach($products as $product)

                <div class="col-4" style="margin: 10px 0">
                    <div class="card">
                        <a class="card-link"
                           style="float: right; text-decoration: none; color: teal">
                            @foreach($imageProduct as $item)
                                @if($product->id == $item['id'])
                                    <img src="{{$item['image']}}"
                                         height="240" width="100%"
                                         alt="No image"/>
                                @endif
                            @endforeach

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
                                <span class="d-flex justify-content-center">
                                    <a href="{{route('products.edit', ['id'=>$product->id])}}"
                                       class="btn btn-warning">Edit</a>
{{--                                    <a data-bs-toggle="modal"--}}
                                    {{--                                       class="btn btn-warning"--}}
                                    {{--                                       data-bs-target="#deleteModal_{{$product->id}}"--}}
                                    {{--                                       data-action="{{ route('products.delete', ['id' => $product->id]) }}">--}}
                                    {{--                                        Delete--}}
                                    {{--                                    </a>--}}
                                    <button type="button"
                                            class="btn btn-danger deleteProductBtn"
                                            value="{{$product->id}}"
                                            onclick="loadDeleteModal({{ $product->id }}, `{{ $product->name }}`)">
                                        Delete
                                    </button>

                                </span>
                            </div>
                        </a>
                    </div>
                </div>

                <!--Modal xóa-->
                {{--                <div class="modal fade" id="deleteModal_{{$product->id}}"--}}
                {{--                     tabindex="-1"--}}
                {{--                     aria-labelledby="deleteModalLabel"--}}
                {{--                     aria-hidden="true">--}}
                {{--                    <div class="modal-dialog">--}}
                {{--                        <div class="modal-content">--}}
                {{--                            <div class="modal-header">--}}
                {{--                                <h1 class="modal-title fs-5" id="deleteModalLabel">Xác nhận xóa.</h1>--}}
                {{--                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                {{--                            </div>--}}
                {{--                            <form action="{{route('products.delete', ['id' => $product->id])}}">--}}
                {{--                                <div class="modal-body">--}}
                {{--                                    @csrf--}}
                {{--                                    @method('DELETE')--}}
                {{--                                    <h6>Bạn có muốn xóa sản phẩm <span style="color: red">{{$product->name}}</span> không ?</h6>--}}
                {{--                                </div>--}}
                {{--                                <div class="modal-footer">--}}
                {{--                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>--}}
                {{--                                    <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Xác nhận--}}
                {{--                                    </button>--}}
                {{--                                </div>--}}
                {{--                            </form>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            @endforeach
        </div>

        <div class="d-flex justify-content-end">
            {{$products->links()}}
        </div>
    @else
        <h2 class="text-center text-warning">Không có dữ liệu.</h2>
    @endif

    <!--Modal xóa-->
    <div class="modal fade" id="deleteProductModal"
         tabindex="-1"
         aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Xác nhận xóa.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('products.delete')}}" method="post">
                    @csrf
                <div class="modal-body">
                    <span>Bạn có muốn xóa sản phẩm <span id="product_name"></span>?</span>
                    <input type="hidden" id="product_id" name="product_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button type="submit"
                            class="btn btn-warning"
                            data-bs-dismiss="modal"
                            id="confirm_delete">Xác nhận
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')

@endsection

@section('js')
    <script>
        function loadDeleteModal(id, name) {
            $('#product_id').val(id);
            $('#product_name').html(name);
            $('#deleteProductModal').modal('show');
        }

        $(document).ready(function() {

            // $('.deleteProductBtn').click(function (e) {
            //     e.preventDefault();
            //
            //     let product_id = $(this).val();
            //     $('#product_id').val(product_id);
            //     $('#deleteProductModal').modal('show');
            // })
        })

    </script>
@endsection
