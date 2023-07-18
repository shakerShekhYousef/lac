@extends('layouts.app', ['title' => __('Create User')])

@section('content')
    @include('users.partials.header', [

        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.users.create')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.store') }}"
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="roleSelect">@lang('labels.backend.access.roles.table.role')</label>
                                            <select name="role_id" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="mselect" onChange="hola();">
                                                <option selected value="">@lang('labels.backend.access.roles.choose')</option>
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
                                <div class="col-md-6" id="name" style="display: none">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">@lang('labels.frontend.user.profile.name')</label>
                                        <input type="text" name="name" id="input-name"
                                               class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Name') }}"
                                        >
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="password" style="display: none">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                               for="input-password">@lang('labels.frontend.user.profile.password')</label>
                                        <input type="password" name="password" id="input-password"
                                               class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Password') }}"
                                        >
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" id="confirm_password" style="display: none">
                                    <div class="form-group{{ $errors->has('confirm_password') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                               for="input-password-confirmation">@lang('labels.frontend.user.profile.confirm')</label>
                                        <input type="password" name="password_confirmation"
                                               id="input-password-confirmation"
                                               class="form-control form-control-alternative{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Confirm Password') }}">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" id="email" style="display: none">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">@lang('labels.frontend.user.profile.email')</label>
                                        <input type="text" name="email"
                                               class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('E-mail') }}" readonly
                                               onfocus="this.removeAttribute('readonly');"/>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" id="national_number" style="display: none">
                                    <div class="form-group{{ $errors->has('national_number') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                               for="input-national">@lang('labels.frontend.user.profile.national')</label>
                                        <input type="text" name="national_number" id="input-national"
                                               class="form-control form-control-alternative{{ $errors->has('national_number') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('National Number') }}"
                                               readonly onfocus="this.removeAttribute('readonly');" />
                                        @if ($errors->has('national_number'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('national_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6" id="code" style="display: none">
                                    <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-code">@lang('labels.frontend.user.profile.code')</label>
                                        <input type="text" name="code" id="input-code"
                                               class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Code') }}" readonly onfocus="this.removeAttribute('readonly');" />
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="status" style="display: none">
                                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="statusSelect">status</label>
                                            <select name="status" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="statusSelect">
                                                <option selected value="">@lang('labels.frontend.user.profile.status')</option>
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
                            <div class="row" id="image" style="display: none">
                                <div class="col-md-4">
                                    <div class="form-group form-file-upload form-file-multiple">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label for="image">@lang('labels.frontend.user.profile.image')</label>
                                                <input name="image" type="file" class="custom-file-label" id="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="group" >
                                    <div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="groupSelect">@lang('labels.backend.access.users.add-group')</label>
                                            <select name="groups[]" class="js-example-basic-multiple"
                                                    data-style="btn btn-link"
                                                    id="groupSelect" multiple>
                                                <option disabled value="">@lang('labels.backend.access.users.choose-group')</option>
                                                @foreach($groups as $group)
                                                    @if($group->id !=1)
                                                    <option value="{{$group->id}}">{{$group->code}}</option>
                                                    @endif
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
                                <button type="submit" class="btn btn-success btn-lg ">
                                    @lang('buttons.general.crud.create')
                                </button>
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
        function hola() {
            var mselect = document.getElementById("mselect");
            var mselectvalue = mselect.options[mselect.selectedIndex].value;
            var code = document.getElementById("code");
            var status = document.getElementById("status");
            var email = document.getElementById('email');
            var national_number = document.getElementById("national_number");
            var name = document.getElementById('name');
            var password = document.getElementById('password');
            var confirm = document.getElementById('confirm_password');
            var image = document.getElementById('image');

            if (mselectvalue == 3) {
                name.style.display = "block";
                password.style.display = "block";
                confirm.style.display = "block";
                code.style.display = "block";
                status.style.display = "block";
                national_number.style.display = "block";
                email.style.display = "none";
                image.style.display = "block";
            } else if (mselectvalue == 4) {
                name.style.display = "block";
                password.style.display = "block";
                confirm.style.display = "block";
                code.style.display = "none";
                status.style.display = "none";
                national_number.style.display = "block";
                email.style.display = "none";
                image.style.display = "block";
            } else if (mselectvalue == 5) {
                name.style.display = "block";
                password.style.display = "block";
                confirm.style.display = "block";
                code.style.display = "none";
                status.style.display = "none";
                national_number.style.display = "block";
                email.style.display = "none";
                image.style.display = "block";
            } else if (mselectvalue == 2) {
                name.style.display = "block";
                password.style.display = "block";
                confirm.style.display = "block";
                code.style.display = "none";
                status.style.display = "none";
                national_number.style.display = "none";
                email.style.display = "block";
                image.style.display = "block";
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                width: '400px'
            });
        });
    </script>
@endsection
