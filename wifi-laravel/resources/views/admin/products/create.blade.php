@extends('layouts.client')

@section('title')
    {{$title}}
@endsection

@section('contents')
    <h1>{{$title}}</h1>
    @if(session('msg'))
        <div class="alert alert-success">
            {{session('msg')}}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Data invalid.
        </div>
    @endif

    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text"
                   id="name"
                   name="name"
                   class="form-control"
                   placeholder="Enter name product ..."
                   value="{{old('name')}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="quantity_exists">Quantity</label>
            <input type="number"
                   id="quantity_exists"
                   name="quantity_exists"
                   class="form-control"
                   placeholder="Enter quantity product ..."
                   value="{{old('quantity_exists')}}">
            @error('quantity_exists')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea type="text"
                   id="description"
                   name="description"
                   class="form-control"
                   placeholder="Enter description product ...">
                {{old('description')}}
            </textarea>
            @error('description')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price">Price</label>
            <input type="number"
                   id="price"
                   name="price"
                   class="form-control"
                   placeholder="Enter price product ..."
                   value="{{old('price')}}">
            @error('price')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="size">Size</label>
            <input type="text"
                   id="size"
                   name="size"
                   class="form-control"
                   placeholder="Enter size product ..."
                   value="{{old('size')}}">
            @error('size')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="flag_promoted">Status promotion</label>
            <select name="flag_promoted" id="flag_promoted" class="form-control">
                <option value="0" {{old('flag_promoted') == 0 ? 'selected' : false}}>Không khuyến mãi</option>
                <option value="1" {{old('flag_promoted') == 1 ? 'selected' : false}}>Khuyến mãi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="coverage_density_id">Mật độ phủ sóng</label>
            <select name="coverage_density_id" id="coverage_density_id" class="form-control">
                <option value="0">Chọn mật độ phủ sóng</option>
                @if(!empty(getAllCoverageDensity()))
                    @foreach(getAllCoverageDensity() as $item)
                        <option value="{{$item->id}}"
                            {{old('coverage_density_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('coverage_density_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="frequency_band_id">Băng tần</label>
            <select name="frequency_band_id" id="frequency_band_id" class="form-control">
                <option value="0">Chọn băng tần</option>
                @if(!empty(getAllFrequencyBand()))
                    @foreach(getAllFrequencyBand() as $item)
                        <option value="{{$item->id}}"
                            {{old('frequency_band_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('frequency_band_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="guarantee_id">Bảo hành</label>
            <select name="guarantee_id" id="guarantee_id" class="form-control">
                <option value="0">Chọn thời gian bảo hành</option>
                @if(!empty(getAllGuarantee()))
                    @foreach(getAllGuarantee() as $item)
                        <option value="{{$item->id}}"
                            {{old('guarantee_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('guarantee_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="made_in_id">Nơi sản xuất</label>
            <select name="made_in_id" id="made_in_id" class="form-control">
                <option value="0">Chọn nơi sản xuất</option>
                @if(!empty(getAllMadeIn()))
                    @foreach(getAllMadeIn() as $item)
                        <option value="{{$item->id}}"
                            {{old('made_in_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('made_in_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="manufacture_id">Hãng sản xuất</label>
            <select name="manufacture_id" id="manufacture_id" class="form-control">
                <option value="0">Chọn hãng sản xuất</option>
                @if(!empty(getAllManufacture()))
                    @foreach(getAllManufacture() as $item)
                        <option value="{{$item->id}}"
                            {{old('manufacture_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('manufacture_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="promotion_id">Tỉ lệ khuyến mãi</label>
            <select name="promotion_id" id="promotion_id" class="form-control">
                <option value="0">Chọn tỉ lệ khuyến mãi</option>
                @if(!empty(getAllPromotion()))
                    @foreach(getAllPromotion() as $item)
                        <option value="{{$item->id}}"
                            {{old('promotion_id') == $item->id ? 'selected' : false}}>
                            {{$item->percent_promotion}}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('promotion_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="speed_wifi_id">Tốc độ wifi</label>
            <select name="speed_wifi_id" id="speed_wifi_id" class="form-control">
                <option value="0">Chọn tốc độ wifi</option>
                @if(!empty(getAllSpeedWifi()))
                    @foreach(getAllSpeedWifi() as $item)
                        <option value="{{$item->id}}"
                            {{old('speed_wifi_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('speed_wifi_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="standard_network_id">Tiêu chuẩn mạng</label>
            <select name="standard_network_id" id="standard_network_id" class="form-control">
                <option value="0">Chọn tiêu chuẩn mạng</option>
                @if(!empty(getAllStandardNetwork()))
                    @foreach(getAllStandardNetwork() as $item)
                        <option value="{{$item->id}}"
                            {{old('standard_network_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('standard_network_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_anteing_id">Tiêu chuẩn anten</label>
            <select name="type_anteing_id" id="type_anteing_id" class="form-control">
                <option value="0">Chọn tiêu chuẩn anten</option>
                @if(!empty(getAllTypeAnteing()))
                    @foreach(getAllTypeAnteing() as $item)
                        <option value="{{$item->id}}"
                            {{old('type_anteing_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('type_anteing_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type_device_id">Loại thiết bị</label>
            <select name="type_device_id" id="type_device_id" class="form-control">
                <option value="0">Chọn loại thiết bị</option>
                @if(!empty(getAllTypeDevice()))
                    @foreach(getAllTypeDevice() as $item)
                        <option value="{{$item->id}}"
                            {{old('type_device_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('type_device_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="user_connect_id">Kết nối tối đa</label>
            <select name="user_connect_id" id="user_connect_id" class="form-control">
                <option value="0">Chọn kết nối tối đa</option>
                @if(!empty(getAllUserConnect()))
                    @foreach(getAllUserConnect() as $item)
                        <option value="{{$item->id}}"
                            {{old('user_connect_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('user_connect_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="button_support_id">Nút bấm hỗ trợ</label>
            <select name="button_support_id" id="button_support_id" class="form-control">
                <option value="0">Chọn nút bấm hỗ trợ</option>
                @if(!empty(getAllButtonSupport()))
                    @foreach(getAllButtonSupport() as $item)
                        <option value="{{$item->id}}"
                            {{old('button_support_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('button_support_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="port_id">Cổng kết nối</label>
            <select name="port_id" id="port_id" class="form-control">
                <option value="0">Chọn cổng kết nối</option>
                @if(!empty(getAllPort()))
                    @foreach(getAllPort() as $item)
                        <option value="{{$item->id}}"
                            {{old('port_id') == $item->id ? 'selected' : false}}>{{$item->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('port_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="anteing_id">Số lượng anten</label>
            <select name="anteing_id" id="anteing_id" class="form-control">
                <option value="0">Chọn số lượng anten</option>
                @if(!empty(getAllAnteing()))
                    @foreach(getAllAnteing() as $item)
                        <option value="{{$item->id}}"
                            {{old('anteing_id') == $item->id ? 'selected' : false}}>{{$item->quantity}}</option>
                    @endforeach
                @endif
            </select>
            @error('anteing_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{route('products.index')}}" class="btn btn-warning">Quay lại</a>
    </form>
@endsection
