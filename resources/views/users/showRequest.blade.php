@extends('layouts.app', ['title' => __('Show Request Edit')])

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
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.edit-requests.show')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.update',$user)}}" method="post">
                            @method('PUT')
                            @csrf
                            <input value="{{$change->id}}" name="change_id" hidden>
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.users.user-information')</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">@lang('labels.frontend.user.profile.name')</label>
                                        <input type="text" name="name" id="input-name"
                                               class="form-control form-control-alternative"
                                               placeholder="{{$change->name}}"
                                               value="{{$change->name}}"
                                               readonly autofocus>
                                        <small class="font-weight-light">{{$user->name}}</small>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">@lang('labels.frontend.user.profile.email')</label>
                                        <input type="text" name="email" id="input-email"
                                               class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               placeholder="{{$change->email}}"
                                               value="{{$change->email}}"
                                               readonly autofocus>
                                        <small class="font-weight-light">{{$user->email}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-code">@lang('labels.frontend.user.profile.code')</label>
                                        <input type="text" name="code" id="input-code"
                                               class="form-control form-control-alternative"
                                               placeholder="{{$change->code ? $change->code : "Nan"}}"
                                               value="{{$change->code ? $change->code : "Nan"}}"
                                               readonly autofocus>
                                        <small class="font-weight-light">{{$user->code}}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                               for="input-national">@lang('labels.frontend.user.profile.national')</label>
                                        <input type="text" name="national_number" id="input-national"
                                               class="form-control form-control-alternative{{ $errors->has('national_number') ? ' is-invalid' : '' }}"
                                               placeholder="{{$change->national_number ? $change->national_number : "Nan" }}"
                                               value="{{$change->national_number}}"
                                               readonly autofocus>
                                        <small class="font-weight-light">{{$user->national_number}}</small>
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
                                                    id="roleSelect"
                                                    readonly>
                                                <option selected value="{{$change->role->name}}"
                                                        disabled>{{$change->role->name}}</option>
                                            </select>
                                            <small class="font-weight-light">{{$user->role->name}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="statusSelect">@lang('labels.frontend.user.profile.status')</label>
                                            <select name="status" class="form-control selectpicker"
                                                    data-style="btn btn-link"
                                                    id="statusSelect"
                                                    readonly>
                                                <option selected
                                                        value="{{$change->status_id }}">{{$change->status->name ? $change->status->name : 'Nan'}}</option>
                                            </select>
                                            <small class="font-weight-light">{{$user->status->name}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-file-upload form-file-multiple">
                                        <label for="">@lang('labels.frontend.user.profile.avatar')</label>
                                        <div class="form-group">
                                            <img src="/storage/images/users/{{$change->image}}"
                                                 style="width: 200px;height: 200px">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-file-upload form-file-multiple">
                                        <label for="">@lang('labels.frontend.user.profile.old_avatar')</label>
                                        <div class="form-group">
                                            <img src="/storage/images/users/{{$user->image}}"
                                                 style="width: 200px;height: 200px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input value="{{$change->image}}" name="image" hidden>
                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-success mt-4">@lang('buttons.general.save')</button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <form action="{{route('deleteRequest',$change->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">@lang('buttons.general.crud.delete')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
