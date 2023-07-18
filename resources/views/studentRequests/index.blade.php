@extends('layouts.app', ['title' => __('Student Requests')])
@section('content')
    <div class="main-content">
        <div class="header bg-gradient-orange pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">@lang('labels.backend.access.student-request.main')</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$error}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">@lang('labels.backend.access.student-request.student')</th>
                                    <th scope="col">@lang('labels.backend.access.student-request.type')</th>
                                    <th scope="col">@lang('labels.backend.access.student-request.type_ar')</th>
                                    <th scope="col">@lang('labels.backend.access.student-request.forward_to')</th>
                                    <th scope="col">@lang('labels.backend.access.student-request.create-date')</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studentRequests as $request)
                                    <tr>
                                        <td>
                                            <a href="{{route('studentRequest.show',$request)}}">
                                                {{$request->student}}
                                            </a>
                                        </td>
                                        <td>
                                            {{$request->type->name}}
                                        </td>
                                        <td>
                                            {{$request->type->name_ar}}
                                        </td>

                                        <td>
                                            @if($request->forward_to)
                                                <span class="badge badge-success">@lang('labels.backend.access.student-request.forward')</span>
                                            @else
                                                <span class="badge badge-danger">@lang('labels.backend.access.student-request.not_forward')</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$request->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            @if($request->is_done == 0)
                                                <span class="badge badge-hold">@lang('buttons.backend.access.student_requests.on_hold')</span>
                                            @elseif($request->is_done==1)
                                                <span class="badge badge-success">@lang('buttons.backend.access.student_requests.done')</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </div>
@endsection
