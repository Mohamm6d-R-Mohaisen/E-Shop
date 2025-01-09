@extends('layout.parent')

@section('title',"Catogaries")
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Catogaries</li>
@endsection
@section('content')
<div class="mb-5">
<a href="{{route('dashboard.catogaries.create')}}" class="btn btn-sm btn-outline-primary mr-2"> Create</a>
<a href="{{route('dashboard.catogaries.trash')}}" class="btn btn-sm btn-outline-dark"> Trash</a>

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
            <th>Parent</th>
            <th>Producs #</th>
            <th>Statis</th>
            <th>Created-at</th>
            <th colspan="2">Action</th>
        </tr>
    </thed>
<tbody>
    @if($catogaries->count())
@foreach ($catogaries as $catogary)

    <tr>
            <td><img src="{{ asset('Storage/'. $catogary->image)}}" alt="" height="80"></td>
            <td>{{$catogary->id}}</td>
        <td><a href="{{route('dashboard.catogaries.show',$catogary->id)}}"  > {{$catogary->name}}</a> </td>
        <td>{{$catogary->parent->name}}</td>
        {{-- //ناتح عن عملية الجوين  --}}
        <td>{{$catogary->products_count}}</td>
        <td>{{$catogary->status}}</td>
        <td>{{$catogary->created_at}}</td>
        <td><a href="{{ route('dashboard.catogaries.edit',$catogary->id)}}" class="btn btn-sm btn-outline-success">Edit</a> </td>
        <td>
<form action="{{route('dashboard.catogaries.destroy',$catogary->id)}}" method="POST">
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
