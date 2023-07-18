@extends('layouts.app', ['name' => __('Edit Room')])

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
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.groups.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/editRoom/{{$roomView->id}}" method="POST"
                            enctype="multipart/form-data">
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
                            <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="image">
                                        <label class="custom-file-label" for="customFileLang">Select file</label>
                                </div>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="name">@lang('labels.backend.access.groups.name')</label>
                                <input name="name" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       id="name"
                                       value="{{$roomView->groupName}}"
                                       placeholder="Group name">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="code">@lang('labels.backend.access.groups.code')</label>
                                <input name="code" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       id="code"
                                       value="{{$roomView->code}}"
                                       placeholder="Code">
                                @if ($errors->has('code'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="days">@lang('labels.backend.access.groups.days')</label>
                                @if ($roomView->daysId == 1)
                                <select class="form-control selectpicker" data-style="btn btn-link" id="selectDays" name="selectDays">
                                    <option selected="selected" value="1" class="dropdown-item">Saturday | Monday | Wednesday</option>
                                    <option value="2" class="dropdown-item">Sunday | Tuesday | Thursday</option>
                                </select>
                                @elseif ($roomView->daysId == 2)
                                <select class="form-control selectpicker" data-style="btn btn-link" id="selectDays" name="selectDays">
                                    <option value="1" class="dropdown-item">Saturday | Monday | Wednesday</option>
                                    <option selected="selected" value="2" class="dropdown-item">Sunday | Tuesday | Thursday</option>
                                </select>
                                @endif
                                @if ($errors->has('days'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="time">@lang('labels.backend.access.groups.times')</label>
                                    <div class="form-group" style="width: fit-content;">
                                        <label for="example-time-input" class="form-control-label">From</label>
                                        <input name="timeFrom" class="form-control" type="time" value="{{$roomView->timeFrom}}" id="example-time-input">
                                    </div>
                                    <div class="form-group" style="width: fit-content;">
                                        <label for="example-time-input" class="form-control-label">To</label>
                                        <input name="timeTo" class="form-control" type="time" value="{{$roomView->timeTo}}" id="example-time-input">
                                    </div>
                                @if ($errors->has('time'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-lg ">@lang('buttons.general.crud.edit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
