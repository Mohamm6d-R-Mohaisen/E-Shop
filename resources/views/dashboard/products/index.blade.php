@extends('layout.parent')

@section('title',"Product")
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Product</li>
@endsection
@section('content')
<div class="mb-5">


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
            <th>Catogary</th>
            <th>Store</th>
            <th>Statis</th>
            <th>Created-at</th>
            <th colspan="2">Action</th>
        </tr>
    </thed>
<tbody>
    @if($products->count())
@foreach ($products as $product)

    <tr>
            <td><img src="{{ asset('Storage/'. $product->image)}}" alt="" height="80"></td>
            <td>{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->categary->name}}</td>
{{--        هيلاقي انو فش حاجة اسمهاcategary ف هيبحث ف المودل هيجد انو في علاقة بالاسم هاد فهيرجع اوبجكت منها ومن خلال الاوبجكت وصلت لمعلمومات جواته --}}
        <td>{{$product->store->name}}</td>
        <td>{{$product->status}}</td>
        <td>{{$product->created_at}}</td>
        <td><a href="{{ route('dashboard.products.edit',$product->id)}}" class="btn btn-sm btn-outline-success">Edit</a> </td>
        <td>
<form action="{{route('dashboard.products.destroy',$product->id)}}" method="POST">
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

{{$products->WithQueryString()->links()}}
@endsection
