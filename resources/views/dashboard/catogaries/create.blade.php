@extends('layout.parent')

@section('title'," Catogaries")
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Catogaries</li>
@endsection
@section('content')
<form action="{{route('dashboard.catogaries.store')}} " method="POST" enctype="multipart/form-data">
    @csrf
    @include('dashboard.catogaries._form')

</form>


@endsection
