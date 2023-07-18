@extends('layouts.app', ['title' => __('Edit Role')])

@section('content')
    @include('roles.partials.header', [
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.roles.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('roles.update',$role)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.roles.role-information')</h6>
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
                                <label for="name">@lang('labels.general.english-name')</label>
                                <input name="name" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       id="title"
                                       value="{{$role->name}}"
                                       placeholder="{{$role->name}}">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name_ar') ? ' has-danger' : '' }}">
                                <label for="name_ar">@lang('labels.general.arabic-name')</label>
                                <input name="name_ar" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name_ar') ? ' is-invalid' : '' }}"
                                       id="name_ar"
                                       value="{{$role->name_ar}}"
                                       placeholder="{{$role->name_ar}}">
                                @if ($errors->has('name_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name_ar') }}</strong>
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
