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
    <a href="{{route('users.add')}}" class="btn btn-primary">Add user</a>
    <hr>
    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-3">
                <select name="status" id="" class="form-control">
                    <option value="0">Choose status</option>
                    <option value="active" {{request()->status=='active'?'selected':false}}>Active</option>
                    <option value="inactive" {{request()->status=='inactive'?'selected':false}}>No Active</option>
                </select>
            </div>
            <div class="col-3">
                <select name="group_id" id="" class="form-control">
                    <option value="0">Choose group</option>
                    @if(!empty(getAllGroup()))
                        @foreach(getAllGroup() as $item)
                            <option value="{{$item->id}}"
                                {{request()->group_id==$item->id?'selected':false}}>
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
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 5%">STT</th>
            <th><a href="?sort-by=fullname&sort-type={{$sortType}}">Name</a></th>
            <th><a href="?sort-by=email&sort-type={{$sortType}}">Email</a></th>
            <th>Group</th>
            <th>Status</th>
            <th style="width: 15%"><a href="?sort-by=create_at&sort-type={{$sortType}}">Time</a></th>
            <th style="width: 5%">Edit</th>
            <th style="width: 5%">Delete</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($userList))
            @foreach($userList as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$item->fullname}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->group_name}}</td>
                    <td>{!! $item->status==0?
                    '<button class="btn btn-danger btn-sm">No active</button>':
                    '<button class="btn btn-success btn-sm">Active</button>'!!}</td>
                    <td>{{$item->create_at}}</td>
                    <td>
                        <a href="{{route('users.edit',['id'=>$item->id])}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <a onclick="return confirm('Do you want to delete?')"
                           href="{{route('users.delete',['id'=>$item->id])}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">No user</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{$userList->links()}}
    </div>

@endsection
