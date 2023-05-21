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
    {{--    route('users.post-edit') increase security--}}
    <form action="{{route('users.post-edit')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="fullname">Name</label>
            <input type="text"
                   id="fullname"
                   name="fullname"
                   class="form-control"
                   placeholder="Enter name ..."
                   value="{{old('fullname') ?? $userDetail->fullname}}">
            @error('fullname')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text"
                   id="email"
                   name="email"
                   class="form-control"
                   placeholder="Enter email ..."
                   value="{{old('email') ?? $userDetail->email}}">
            @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="group_id">Group</label>
            <select name="group_id" id="group_id" class="form-control">
                <option value="0">Choose group</option>
                @if(!empty($groupList))
                    @foreach($groupList as $item)
                        <option value="{{$item->id}}"
                            {{old('group_id') == $item->id ||
                            $userDetail->group_id == $item->id  ?
                            'selected' :
                            false}}>
                            {{$item->name}}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="0" {{old('status') == 0 ||
                $userDetail->status == 0 ?
                'selected' :
                false}}>
                    No active
                </option>
                <option value="1" {{old('status') == 1 ||
                $userDetail->status == 1 ?
                'selected' :
                false}}>
                    Active
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{route('users.index')}}" class="btn btn-warning">back list user</a>
    </form>
@endsection


