<ul class="permission-tree">
    @foreach($permissions as $key => $value)
        <li>
            @if(isset($value['__permission']))
                <div class="form-check">
                    <input class="form-check-input permission-checkbox" type="checkbox" 
                            name="permissions[]" value="{{ $value['__permission']->name }}"
                            id="permission-{{ $value['__permission']->id }}"
                            {{ $role->hasPermissionTo($value['__permission']->name) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission-{{ $value['__permission']->id }}">
                        {{ $value['__permission']->name }}
                    </label>
                </div>
            @else
                <span>{{ $key }}</span>
                @include('admin.partials.permissions-checkbox', ['permissions' => $value, 'role' => $role])
            @endif
        </li>
    @endforeach
</ul>