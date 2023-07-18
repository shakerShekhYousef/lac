@extends('layouts.app', ['name' => __('Create Room')])

@section('content')
    @include('chat.partials.header', [

        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.groups.create')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('Chat.store')}}" method="post" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.groups.group-information')</h6>
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
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="name">@lang('labels.backend.access.groups.name')</label>
                                <input name="name" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       id="name"
                                       placeholder="Group name"
                                       required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                <label for="code">@lang('labels.backend.access.groups.code')</label>
                                <input name="code" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" id="code"
                                       placeholder="code"
                                       required>
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div name="ddDays" class="dropdown form-group{{ $errors->has('days') ? ' has-danger' : '' }}">
                                <label for="days">@lang('labels.backend.access.groups.days')</label>
                                <select name="selectDays" class="form-control selectpicker" data-style="btn btn-link" id="selectDays">
                                    <option value="1" class="dropdown-item">Saturday | Monday | Wednesday</option>
                                    <option value="2" class="dropdown-item">Sunday | Tuesday | Thursday</option>
                                </select>
                                @if ($errors->has('days'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('days') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}">
                                <label for="time">@lang('labels.backend.access.groups.times')</label>
                                    <div class="form-group" style="width: fit-content;">
                                        <label for="example-time-input" class="form-control-label">From</label>
                                        <input name="timeFrom" class="form-control" type="time" value="10:30" id="example-time-input">
                                    </div>
                                    <div class="form-group" style="width: fit-content;">
                                        <label for="example-time-input" class="form-control-label">To</label>
                                        <input name="timeTo" class="form-control" type="time" value="10:30" id="example-time-input">
                                    </div>
                                @if ($errors->has('time'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('time') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="group" >
                                    <div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="groupSelect">@lang('labels.backend.access.users.add-group')</label>
                                            <select name="teachers[]" class="js-example-basic-multiple"
                                                    data-style="btn btn-link"
                                                    id="groupSelect" multiple>
                                                <option disabled value=""></option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($errors->has('group'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('group') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-lg ">@lang('buttons.general.crud.create')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
    <script src="{{asset('nodejsapp/js/jquery.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                width: '400px'
            });
        });
    </script>
@endsection
