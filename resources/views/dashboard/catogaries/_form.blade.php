@if($errors->any())
<div class="alert alert-danger">
    <h3>Error Occured!</h3>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



<div class="form-group">

    <lable>Catogary Name</lable>
    <input type="text" name="name" @class([
        'form-control',
        'is-invalid'=>$errors->has('name')
    ])
     value="{{ old('name',$catogary->name )}}">
@error('name')
    <div class="text-danger">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
    <lable>Parent Name</lable>
    <select  name="parent_id" class="form-control">
        <option value="">Primary Catogary</option>
        @foreach($parents as $parent)
        <option value="{{$parent->id}}" @selected(old('parent_id', $catogary->parent_id) ==$parent->id )>{{$parent->name ?? ''}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    <lable>Description</lable>
    <textarea type="text" name="description" class="form-control">{{ old('description', $catogary->description )}}</textarea>
</div>
<div class="form-group">
<div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="" value="active" @checked(old('status', $catogary->status) =='active')>
        <label class="form-check-label">
      Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="" value="archived" @checked(old('status', $catogary->status)=='archived')>
        <label class="form-check-label">
        Archived
        </label>
      </div>
</div>
</div>
<div class="form-group">
    <lable>Catogary Image</lable>
    <input type="file" name="image" class="form-control">
    @if($catogary->image)

        <img src="{{ asset('Storage/'. $catogary->image)}}" alt="" height="60">

    @endif
</div>
<button type="submit" class="btn btn-primary">{{$buttum_lable ?? 'SAVE' }}</button>
