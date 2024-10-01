@extends('dashboard.layouts.layout')

@push('css')
@endpush

{{-- Title Page --}}
@section('title_page')
    <title>{{ config('app.name') }} | {{ __('words.add_category') }}</title>
@endsection

<!-- Breadcrumb -->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">{{ __('words.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">{{ __('words.categories') }}</a></li>
    <li class="breadcrumb-item">{{ __('words.add_category') }}</li>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <x-alert type="success" />
            <x-alert type="danger" />
            <form action="{{ Route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ __('words.add_category') }}</strong>
                        </div>
                        @include('dashboard.categories._form')
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('javascripts')
@endpush