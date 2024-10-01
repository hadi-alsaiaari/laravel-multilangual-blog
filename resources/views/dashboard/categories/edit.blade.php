@extends('dashboard.layouts.layout')

@push('css')
@endpush

{{-- Title Page --}}
@section('title_page')
    <title>{{ config('app.name') }} | {{ __('words.edit_category') }}</title>
@endsection

<!-- Breadcrumb -->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">{{ __('words.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">{{ __('words.categories') }}</a></li>
    <li class="breadcrumb-item">{{ __('words.edit_category') }}</li>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ __('words.edit_category') }}</strong>
                        </div>
                        <img src="{{ asset($category->image) }}" alt="pic" style="height: 100px">
                        @include('dashboard.categories._form', [
                            'button_label' => __('words.update')  
                        ])
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('javascripts')
@endpush