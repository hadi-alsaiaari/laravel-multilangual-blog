@extends('dashboard.layouts.layout')

@push('css')
@endpush

{{-- Title Page --}}
@section('title_page')
    <title>{{ config('app.name') }} | {{ __('words.edit_user') }}</title>
@endsection

<!-- Breadcrumb -->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">{{ __('words.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">{{ __('words.users') }}</a></li>
    <li class="breadcrumb-item">{{ __('words.edit_user') }}</li>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <form action="{{ Route('dashboard.users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ __('words.edit_user') }}</strong>
                        </div>
                        @include('dashboard.users._form', [
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