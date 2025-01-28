<div class="row">
    <div class="col-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $role->name ?? '') }}"  class="form-control" required="required">
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
       <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
           <label for="description">Description</label>
           <textarea id="description" name="description" class="form-control" required="required">{{ old('description', $role->description ?? '') }} </textarea>
           <small class="text-danger">{{ $errors->first('description') }}</small>
       </div>
    </div>
</div>
