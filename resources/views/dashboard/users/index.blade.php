@extends('dashboard.layouts.layout')

@push('css')
@endpush

{{-- Title Page --}}
@section('title_page')
    <title>{{ config('app.name') }} | {{ __('words.users') }}</title>
@endsection

<!-- Breadcrumb -->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">{{ __('words.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('words.users') }}</li>
@endsection

@section('body')
    <div class="container-fluid" id="contentContainer">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{__('words.table_users')}}
                </div>
                <x-alert type="success" />
                <x-alert type="danger" />
                {{-- @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if(session()->has('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
                @endif --}}
                <div class="card-block">
                    <div class="alert alert-success alert-successa" style="display: none;" role="alert">
                        <b>{{__('words.deleted_user_true')}}</b>
                    </div>
                    <div class="alert alert-danger alert-dangera" style="display: none;" role="alert">
                        <b>{{__('words.deleted_user_false')}}</b>
                    </div>
                    <table id="example" class="display nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>{{__('words.username')}}</th>
                                <th>{{__('words.date_registered')}}</th>
                                <th>{{__('words.role')}}</th>
                                <th>{{__('words.status')}}</th>
                                <th>{{__('words.options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr id="{{$user->id}}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        @can('update', $user)
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete', $user)
                                            <a id="deleteBtn" data-id="{{$user->id}}" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deletemodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('words.delete_title')}}</h5>
                </div>
                <div class="modal-body">
                    <p>هل أنت متأكد من حذف العنصر؟ سوف يتم نقله إلى سلة المهملات.</p>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <form action="{{ Route('dashboard.users.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('words.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('words.delete') }}</button>
                        {{-- <a class="remove-item btn btn-danger" data-id="id" id='deleted' href="javascript:void(0)">{{ __('words.delete') }}</a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascripts')
    <script>
        const csrf_token = "{{ csrf_token() }}";
        var id;
        setTimeout(function() {
            $('.alert').css('display', 'none'); // إخفاء رسالة الفشل بعد 3 ثوانٍ
        }, 3000);
        $('#example tbody').on('click', '#deleteBtn', function(argument) {
            id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
        
        // $('.remove-item').on('click', function(e) {
        //     console.log(id);
        //     $.ajax({
        //         url: "users/" + id,
        //         method: 'delete',
        //         data: {
        //             _token: csrf_token
        //         },
        //         success: response => {
        //             if (response.is_he === true) {
        //                 window.location.href = "{{ route('login') }}";
        //             }
        //             $(`#${id}`).remove();
        //             $('#deletemodal').css('display', 'none');
        //             $('.modal-backdrop').remove();
        //             const deleteButton = document.getElementById('deleteBtn');
        //             deleteButton.click();
        //             $('.alert-successa').css('display', 'block'); // عرض رسالة النجاح
        //             setTimeout(function() {
        //                 $('.alert-successa').css('display', 'none'); // إخفاء رسالة النجاح بعد 3 ثوانٍ
        //             }, 3000);
        //         },
        //         error: error => {
        //             $('#deletemodal').css('display', 'none');
        //             $('.modal-backdrop').remove();
        //             const deleteButton = document.getElementById('deleteBtn');
        //             deleteButton.click();
        //             $('.alert-dangera').css('display', 'block'); // عرض رسالة الفشل
        //             setTimeout(function() {
        //                 $('.alert-dangera').css('display', 'none'); // إخفاء رسالة الفشل بعد 3 ثوانٍ
        //             }, 3000);
        //         }
        //     })
        // });
    </script>
@endpush
