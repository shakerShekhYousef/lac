@extends('layouts.app', ['title' => __('Show Student Request')])

@section('content')
    @include('studentRequests.partials.header', [
        'title' => "Student Name"." $studentRequest->student ",
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.student-request.show')</h3>
                        </div>
                    </div>
                    <div class="card-body">
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

                        <div class="form-group">
                            <label for="student">@lang('labels.backend.access.student-request.student')</label>
                            <input name="student" type="text" class="form-control" id="student"
                                   placeholder="{{$studentRequest->student}}" readonly>
                        </div>
                        <div class="form-group">@lang('labels.backend.access.student-request.type')</label>
                            <input name="procedure_type" type="text" class="form-control" id="procedure_type"
                                   placeholder="{{$studentRequest->type->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="reason">@lang('labels.backend.access.student-request.reason')</label>
                            <textarea name="reason" type="text" class="form-control" id="reason"
                                      placeholder="{{$studentRequest->reason}}" readonly></textarea>
                        </div>
                        <form action="{{route('studentRequest.forward',$studentRequest)}}" method="post">
                            @method("POST")
                            @csrf
                            <div class="form-group">
                                <label for="forwardTo">@lang('labels.backend.access.student-request.forward_to')</label>
                                <select name="admin_id" class="form-control selectpicker"
                                        data-style="btn btn-link"
                                        id="forwardTo">
                                    <option selected value="">Choose Admin</option>
                                    @foreach($admins as $admin)
                                        <option value="{{$admin->id}}">{{$admin->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-lg ">@lang('labels.backend.access.student-request.forward_to')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
