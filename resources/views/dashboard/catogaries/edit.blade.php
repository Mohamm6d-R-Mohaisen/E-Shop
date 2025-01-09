@extends('layout.parent')

@section('title',"Edit Catogaries")
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Catogary</li>
@endsection
@section('content')
<form action="{{route('dashboard.catogaries.update',$catogary->id)}}" method="POST" enctype="multipart/form-data" >
    @method('put')
    @csrf
    @include('dashboard.catogaries._form',['buttum_lable'=>'Update'])

</form>


@endsection
