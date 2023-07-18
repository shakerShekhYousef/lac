@extends('layouts.app', ['title' => __('Edit User')])

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
                                <i class="ni location_pin mr-2"></i>
                                @if($user->status)
                                {{$user->status->name}}
                                @endif
                            </div>
                            <h5>
                                <small class="font-weight-light">  {{$user->email}}</small>
                            </h5>
                            <hr class="my-4"/>
                            <h3>
                                @lang('labels.frontend.user.profile.code')<small class="font-weight-light"> : {{$user->code}}</small>
                            </h3>
                            <h3>
                                @lang('labels.frontend.user.profile.national')<small class="font-weight-light"> : {{$user->national_number}}</small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.users.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('createRequest')}}" autocomplete="off"
                              enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.users.user-information')</h6>
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
                            <input name="user_id" value="{{$user->id}}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">@lang('labels.frontend.user.profile.name')</label>
                                        <input type="text" name="name" id="input-name"
                                               class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               placeholder="{{$user->name}}"
                                               value="{{$user->name}}"
                                               autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">@lang('labels.frontend.user.profile.email')</label>
                                        <input readonly disabled type="text" name="email" id="input-email"
                                               class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="{{$user->email}}" value="{{$user->email}}" autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-code">@lang('labels.frontend.user.profile.code')</label>
                                        <input type="text" name="code" id="input-code"
                                               class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                               placeholder="{{$user->code}}"
                                               value="{{$user->code}}"
                                               autofocus>
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('national_number') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                               for="input-national">@lang('labels.frontend.user.profile.national')</label>
                                        <input type="text" name="national_number" id="input-national"
                                               class="form-control form-control-alternative{{ $errors->has('national_number') ? ' is-invalid' : '' }}"
                                               placeholder="{{$user->national_number}}"
                                               value="{{$user->national_number}}"
                                               autofocus>
                                        @if ($errors->has('national_number'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('national_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="roleSelect">@lang('labels.backend.access.roles.table.role')</label>
                                            <select name="role_id" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="roleSelect">
                                                <option selected disabled
                                                        value="{{$user->role_id}}">{{$user->role->name}}</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('role_id'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="statusSelect">@lang('labels.frontend.user.profile.status')</label>
                                            <select name="status" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="statusSelect">
                                                <option selected value="">
                                                    @if($user->status)
                                                   {{$user->status->name}}
                                                   @endif
                                                </option>
                                                @foreach($statuses as $status)
                                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-file-upload form-file-multiple">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label for="image">Insert Image</label>
                                                <input name="image" type="file" class="custom-file-label" id="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg ">@lang('buttons.general.crud.edit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4"/>
        <form method="post" action="{{ route('edit.password') }}" autocomplete="off">
            @csrf
            @method('put')

            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

            @if (session('password_status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('password_status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <input name="user_id" value="{{$user->id}}" hidden>
            <div class="pl-lg-4">
{{--                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">--}}
{{--                    <label class="form-control-label"--}}
{{--                           for="input-current-password">@lang('labels.frontend.user.profile.current')</label>--}}
{{--                    <input type="password" name="old_password" id="input-current-password"--}}
{{--                           class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"--}}
{{--                           placeholder="{{ __('Current Password') }}" value="" required>--}}

{{--                    @if ($errors->has('old_password'))--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('old_password') }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label class="form-control-label"
                           for="input-password">@lang('labels.frontend.user.profile.password')</label>
                    <input type="password" name="password" id="input-password"
                           class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="{{ __('New Password') }}" value="" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="form-control-label"
                           for="input-password-confirmation">@lang('labels.frontend.user.profile.confirm')</label>
                    <input type="password" name="password_confirmation" id="input-password-confirmation"
                           class="form-control form-control-alternative"
                           placeholder="{{ __('Confirm New Password') }}" value="" required>
                </div>

                <div class="text-center">
                    <button type="submit"
                            class="btn btn-success mt-4">@lang('buttons.backend.access.users.change_password')</button>
                </div>
            </div>
        </form>
        @include('layouts.footers.auth')
    </div>
@endsection
