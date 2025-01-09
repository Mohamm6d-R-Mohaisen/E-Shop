@extends('layout.parent')

@section('title',"Edit Catogaries")
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Product</li>
@endsection
@section('content')
<form action="{{route('dashboard.products.update',$products->id)}}" method="POST" enctype="multipart/form-data" >
    @method('put')
    @csrf

    <div class="form-group">

        <lable>Product Name</lable>
        <input type="text" name="name" @class([
        'form-control',
        'is-invalid'=>$errors->has('name')
    ])
        value="{{ old('name',$products->name )}}">
        @error('name')
        <div class="text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <lable>Catogary Name</lable>
        <select  name="catogary_id" class="form-control">

            @foreach($categary as $category)
                <option value="{{ $category->id }}"
                    {{ $products->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
            <div class="form-group">
                <lable>Description</lable>
                <textarea type="text" name="description" class="form-control">{{ old('description', $products->description )}}</textarea>
            </div>
    <div class="form-group">
        <lable>Product Image</lable>
        <input type="file" name="image" class="form-control">
        @if($products->image)

            <img src="{{ asset('Storage/'. $products->image)}}" alt="" height="60">

        @endif
    </div>
<div class="form-groupe">
    <label>Price</label>
    <input class="form-control" name="price" value="{{$products->price}}">
</div>
    <div class="form-groupe">
        <label>Compare Price</label>
        <input class="form-control" name="compare_price" value="{{$products->compare_price}}">
    </div>
    <div class="form-groupe">
        <label>Tags</label>
        <input class="form-control" name="tags" value="{{$tags}}">
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="" value="active" @checked(old('status', $products->status) =='active')>
            <label class="form-check-label">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="" value="archived" @checked(old('status', $products->status)=='archived')>
            <label class="form-check-label">
                Archived
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">{{$buttum_lable ?? 'SAVE' }}</button>


</form>


@endsection
@push('style')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />


@endpush
@push('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
</script>
@endpush
