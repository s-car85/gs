<div class="form-group col-md-6">
    @if(isset($category))
    @if($category->parent_id > 0)
        {{ Form::label('parent', 'Set parent') }}
        <select class="form-control" name="parent_id">
            <optgroup label="root">
                <option value="0">root</option>
            </optgroup>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ ($cat->id == $category->parent_id)?'selected' :'' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @endif
    @else
    {{ Form::label('parent', 'Set parent') }}
    <select class="form-control" name="parent_id">
        <optgroup label="root">
            <option value="0">root</option>
        </optgroup>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
        @endif
</div>