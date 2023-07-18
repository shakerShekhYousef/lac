@extends('layouts.app', ['title' => __('Show User')])

@section('content')
    @include('users.partials.header', [

        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="/storage/images/users/{{$user->image}}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{$user->name}}<small class="font-weight-light"> , {{$user->role->name}}</small>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{$user->status->name}}
                            </div>
                            <h5>
                                <small class="font-weight-light">  {{$user->email}}</small>
                            </h5>
                            <hr class="my-4" />
                            <h3>
                                @lang('labels.frontend.user.profile.code')<small class="font-weight-light"> : {{$user->code}}</small>
                            </h3>
                            <h3>
                                @lang('labels.frontend.user.profile.national')r<small class="font-weight-light"> : {{$user->national_number}}</small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.users.show')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.users.user-information')</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">@lang('labels.frontend.user.profile.name')</label>
                                        <input type="text" name="name" id="input-name"
                                               class="form-control form-control-alternative"
                                               placeholder="{{$user->name}}"
                                               readonly autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">@lang('labels.frontend.user.profile.email')</label>
                                        <input type="text" name="email" id="input-email"
                                               class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="{{$user->email}}" readonly autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-code">@lang('labels.frontend.user.profile.code')</label>
                                        <input type="text" name="code" id="input-code"
                                               class="form-control form-control-alternative"
                                               placeholder="{{$user->code ? $user->code : "Nan"}}"
                                               readonly autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                               for="input-national">@lang('labels.frontend.user.profile.national')</label>
                                        <input type="text" name="national_number" id="input-national"
                                               class="form-control form-control-alternative{{ $errors->has('national_number') ? ' is-invalid' : '' }}"
                                               placeholder="{{$user->national_number ? $user->national_number : "Nan" }}"
                                               readonly autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="roleSelect">@lang('labels.backend.access.roles.table.role')</label>
                                            <select name="role_id" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="roleSelect" readonly>
                                                <option selected value="">{{$user->role->name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="statusSelect">@lang('labels.frontend.user.profile.status')</label>
                                            <select name="status" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="statusSelect " readonly>
                                                <option selected
                                                        value="">{{$user->status->name ? $user->status->name : 'Nan'}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group form-file-upload form-file-multiple">
                                        <div class="form-group">
                                            <img src="/storage/images/users/{{$user->image}}"
                                                 style="width: 200px;height: 200px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
