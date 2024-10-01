<div class="card-block">
    <div class="form-group col-md-12">
        <x-form.input label="{{ __('words.name') }}" class="form-control" role="input" name="name" :value="$user->name" />
    </div>
    <div class="form-group col-md-12">
        <x-form.input label="{{ __('words.email') }}" class="form-control" role="input" type="email" name="email" :value="$user->email" />
    </div>
    <div class="form-group col-md-12">
        <label for="">{{ __('words.status') }}</label>
        <select name="status" class="form-control form-select">
            <option value="">{{__('words.no_status')}}</option>
            <option value="admin" @selected(old('status', $user->status) == 'admin')>{{__('words.admin')}}</option>
            <option value="writer" @selected(old('status', $user->status) == 'writer')>{{__('words.writer')}}</option>
        </select>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label ??  __('words.save') }}</button>
    <a class="remove-item btn btn-danger" style="margin-right: 20px" href="{{ route('dashboard.users.index') }}">{{ __('words.cancell') }}</a>
</div>