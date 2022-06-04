@csrf

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="user_id">Username</label>
    <div class="col-sm-10">
        <select name="user_id" class="form-control" id="user_id" required>
            @foreach($users as $id => $display)
                <option value="{{ $id }}" {{ (isset($users->id) && $id === $users->id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="form-text text-muted">The current selected user.</small>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label"for="permission_id">Permission</label>
    <div class="col-sm-10">
        @foreach($permissions as $id => $display)
            <input class="form_control" type="checkbox" id="permission_id" name="permission_id" value="{{ $id }}" {{ (isset($permissions->id) && $id === $permissions->id) ? 'selected' : '' }}>
            <label for="permission_id">{{ $display }}</label><br>
        @endforeach
{{--        <select name="permission_id" class="form-control" id="permission_id" required>--}}
{{--            @foreach($permissions as $id => $display)--}}
{{--                <option value="{{ $id }}" {{ (isset($permissions->id) && $id === $permissions->id) ? 'selected' : '' }}>{{ $display }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
        <small class="form-text text-muted">The permission being assigned to the user.</small>
    </div>
</div>
