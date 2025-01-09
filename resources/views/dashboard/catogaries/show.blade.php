@extends('layout.parent')

@section('title',$catogary->slug)
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Catogary</li>
    <li class="breadcrumb-item active">{{$catogary->name}}</li>
@endsection
@section('content')
    <table class="table">
        <thed>
            <tr>
                <th></th>
                <th>Name</th>

             <th>Store</th>
                <th>Statis</th>
                <th>Created-at</th>

            </tr>
        </thed>
        <tbody>
@php
$products=$catogary->products()->with('store')->paginate(5);
@endphp
            @forelse ($products as $product)

                <tr>
                    <td><img src="{{ asset('Storage/'. $catogary->image)}}" alt="" height="80"></td>

                    <td>{{$product->name}}</td>
                    <td>{{$product->store->name}}</td>
                    <td>{{$product->status}}</td>
                    <td>{{$product->created_at}}</td>

                </tr>

            @empty
            <tr><td colspan="5">No Catogaries Found </td></tr>
            @endempty
        </tbody>
    </table>
{{ $products->links() }}

@endsection
