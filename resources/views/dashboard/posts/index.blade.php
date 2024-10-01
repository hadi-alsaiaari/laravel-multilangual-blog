@extends('dashboard.layouts.layout')

{{-- Title Page --}}
@section('title_page')
    <title>{{ config('app.name') }} | {{ __('words.posts') }}</title>
@endsection

<!-- Breadcrumb -->
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">{{ __('words.dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('words.posts') }}</li>
@endsection

@section('body')
    <div class="container-fluid" id="contentContainer">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{__('words.table_posts')}}
                </div>
                <x-alert type="success" />
                <x-alert type="danger" />
                <div class="card-block">
                    <div class="alert alert-success alert-successa" style="display: none;" role="alert">
                        <b>{{__('words.deleted_post_true')}}</b>
                    </div>
                    <div class="alert alert-danger alert-dangera" style="display: none;" role="alert">
                        <b>{{__('words.deleted_post_false')}}</b>
                    </div>
                    <table id="example" class="display nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>{{__('words.title')}}</th>
                                <th>{{__('words.category_name')}}</th>
                                <th>{{__('words.options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{dd($posts);}} --}}
                            @forelse($posts as $post)
                                <tr id="{{$post->id}}">
                                    <td>{{$post->translate(app()->getLocale())->title}}</td>
                                    <td>{{$post->category->translate(app()->getLocale())->title}}</td>
                                    <td>
                                        @can('update', $post)
                                            <a href="{{ route('dashboard.posts.edit', $post->id) }}"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete', $post)
                                            <a id="deleteBtn" data-id="{{$post->id}}" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>
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
                    <p>{{__('words.sure_delete')}}</p>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <form action="{{ Route('dashboard.posts.delete') }}" method="POST">
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

@push('css')
    
@endpush

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
        //         url: "posts/" + id,
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
