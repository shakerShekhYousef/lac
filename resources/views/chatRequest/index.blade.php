@extends('layouts.app', ['title' => __('Chat Requests')])
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
                                    <h3 class="mb-0">@lang('labels.backend.access.chatRequest.requests')</h3>
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
                                    <th scope="col">@lang('labels.backend.access.chatRequest.sender')</th>
                                    <th scope="col">@lang('labels.backend.access.student-request.create-date')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($chatRequests as $request)
                                    <tr>
                                        <td>
                                            {{$request->user->name}}
                                        </td>
                                        <td>
                                            {{$request->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            @if($request->confirm == 0)
                                                <form action="{{route('chatRequest.confirm',$request)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark btn-sm">
                                                        @lang('buttons.backend.access.chatRequests.confirm')
                                                    </button>
                                                </form>

                                            @elseif($request->confirm==1)
                                                <span class="badge badge-success">
                                                    @lang('buttons.backend.access.chatRequests.confirmed')
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{route('chatRequests.destroy',$request)}}"
                                                  method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirm('{{ __("Are you sure you want to delete this request?") }}') ? this.parentElement.submit() : ''"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
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
