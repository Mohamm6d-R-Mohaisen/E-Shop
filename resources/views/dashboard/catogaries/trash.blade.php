@extends('layout.parent')

@section('title',"Catogaries")
@section('breadcrumb')
@parent
<li class="breadcrumb-item ">Catogaries</li>
<li class="breadcrumb-item active">Trash</li>

@endsection
@section('content')
<div class="mb-5">
<a href="{{route('dashboard.catogaries.index')}}" class="btn btn-sm btn-outline-primary"> Bach Index</a>
</div>
<div>

<x-aleart/>
</div>

<form method="get" action="{{URL::current()}}" class="d-flex justify-content-between mb-4">
    <input name="name"  type="text" placeholder="Name" class="form-control mx-2" value="{{request('name')}}">
    <select class="form-control mx-2" name="status">
    <option value="">ALL</option>
    <option value="active"@selected(request('status')=='active')>ACTIVE</option>
    <option value="archived"@selected(request('status')=='archived')>ARCHIVED</option>
    </select>
    <button class="btn btn-dark mx2">Filter </button>


</form>


<table class="table">
    <thed>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>

            <th>Statis</th>
            <th>deleted-at</th>
            <th colspan="2">Action</th>
        </tr>
    </thed>
<tbody>
    @if($catogaries->count())
@foreach ($catogaries as $catogary)

    <tr>
            <td><img src="{{ asset('Storage/'. $catogary->image)}}" alt="" height="80"></td>
            <td>{{$catogary->id}}</td>
        <td>{{$catogary->name}}</td>
        <td>{{$catogary->status}}</td>
        <td>{{$catogary->created_at}}</td>
        <td>
        <form action="{{route('dashboard.catogaries.restore',$catogary->id)}}" method="POST">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>

        </form>
        </td>
        <td>

<form action="{{route('dashboard.catogaries.forcedelete',$catogary->id)}}" method="POST">
@csrf
@method('delete')
<button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
</form>
        </td>
    </tr>
    @endforeach
    @else
<tr><td colspan="7">No Catogaries Found </td></tr>
@endif
</tbody>
</table>

{{$catogaries->WithQueryString()->links()}}
@endsection
