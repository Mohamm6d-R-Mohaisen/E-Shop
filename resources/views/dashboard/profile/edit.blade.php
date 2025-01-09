@extends('layout.parent')

@section('title',"Edit Catogaries")
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection
@section('content')
<div class="form-contoller">
    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <lable>First Name</lable>
            <input type="text" name="first_name" class="form-control" value="{{$user->profile->first_name}}"/>
        </div>
        <div class="form-group">
            <lable>Last Name</lable>
            <input type="text" name="last_name"value="{{$user->profile->last_name}}" class="form-control"/>
        </div>
        <div class="form-group">
            <lable>Birthday</lable>
            <input type="date" name="birthday"value="{{$user->profile->birthday}}" class="form-control"/>
        </div>
        <label>Gender</label>
        <div class="form-row mx-4">

            <div class="col-6 ">

                <input type="radio" name="gender" value="male" @checked($user->profile->gender=='male') >
                <label>Male</label>
            </div>
            <div class="col-6">

                <input type="radio" name="gender" value="female" @checked($user->profile->gender=='female')>
                <label>Female</label>
            </div>
        </div>
        <div class="form-group">
            <lable>Street</lable>
            <input type="text" name="street_address" class="form-control" value="{{$user->profile->street_address}}"/>
        </div>
        <div class="form-group">
            <lable>Postel-Code</lable>
            <input type="text" name="posetl_code" class="form-control" value="{{$user->profile->postel_code}}"/>
        </div>
        <div class="form-group">
            <lable>State</lable>
            <input type="text" name="state" class="form-control" value="{{$user->profile->state}}"/>
        </div>
        <div class="form-group">
            <lable>Country</lable>
            <select name="country" class="form-control">
                <option value="{{$user->profile->country}}">{{$user->profile->country}}</option>
                @foreach($countries as $value =>$text)
                            <option value="{{$value}}">{{$text}}</option>
            @endforeach
            </select>
{{--            <input type="text" name="country" class="form-control"value="{{$user->profile->country}}"/>--}}
        </div>
        <div class="form-group">
            <lable>Local</lable>
            <select name="local" class="form-control">
                <option value="{{$user->profile->local}}">{{$user->profile->local}}</option>
                @foreach($languages as $value =>$text))
                    <option value="{{$value}}">{{$text}}</option>
                @endforeach
            </select>
{{--            <input type="text" name="local" class="form-control"value="{{$user->profile->local}}"/>--}}
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>


@endsection
