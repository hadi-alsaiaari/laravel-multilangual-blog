<div class="card-block">
    <div class="form-group col-md-12">
        <x-form.input label="{{ __('words.image') }}" type="file" name="image" accept="image/*" class="form-control" :value="$category->image" />
    </div>
    <div class="form-group col-md-12">
        <label for="">{{ __('words.status') }}</label>
        <select name="parent" class="form-control form-select">
            <option value="">{{__('words.main_category')}}</option>
            @forelse($categories as $parents)
                <option value="{{ $parents->id }}" @selected(old('parent', $category->parent) == $parents->id)>{{ $parents->translate(app()->getLocale())->title }}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong>{{ __('words.translations') }}</strong>
    </div>
    <div class="card-block">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach (config('app.languages') as $key => $lang)
                <li class="nav-item">
                    <a class="nav-link @if ($loop->index == 0) active @endif" id="home-tab" data-toggle="tab" href="#{{ $key }}" role="tab" aria-controls="home" aria-selected="true">{{ $lang }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach (config('app.languages') as $key => $lang)
                <div class="tab-pane mt-3 fade @if ($loop->index == 0) show active in @endif" id="{{ $key }}" role="tabpanel" aria-labelledby="home-tab">
                    <br>
                    <div class="form-group mt-3 col-md-12">
                        <x-form.input label="{{ __('words.title') }}" type="text" name="{{ $key }}[title]" class="form-control" placeholder="{{ __('words.title') }}" :value="$category->translate($key)->title ?? '' " />
                    </div>
                    <div class="form-group col-md-12">
                        <x-form.textarea label="{{ __('words.content') }}" type="text" name="{{ $key }}[content]" class="form-control" cols="30" rows="10" :value="$category->translate($key)->content ?? ''"/>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ $button_label ??  __('words.save') }}</button>
    <a class="remove-item btn btn-danger" style="margin-right: 20px" href="{{ route('dashboard.categories.index') }}">{{ __('words.cancell') }}</a>
</div>