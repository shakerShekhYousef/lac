@extends('layouts.app', ['title' => __('Show Hrd')])

@section('content')
    @include('hrd.partials.header', [
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.hrd.show')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('hrd.update',$hrd)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.hrd.hrd-information')</h6>
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
                                <label for="name">@lang('labels.backend.access.hrd.name')</label>
                                <input name="name" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                       placeholder="{{$hrd->name}}"
                                       value="{{$hrd->name}}"
                                       readonly>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name_ar') ? ' has-danger' : '' }}">
                                <label for="name">@lang('labels.backend.access.hrd.arabic-name')</label>
                                <input name="name_ar" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" id="name"
                                       placeholder="{{$hrd->name_ar}}"
                                       value="{{$hrd->name_ar}}"
                                       readonly>
                                @if ($errors->has('name_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name_ar') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label for="description">@lang('labels.backend.access.hrd.description')</label>
                                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="post" rows="3" readonly>{{$hrd->description}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description_ar') ? ' has-danger' : '' }}">
                                <label for="description">ِ@lang('labels.backend.access.hrd.description-arabic')</label>
                                <textarea name="description_ar" class="form-control{{ $errors->has('description_ar') ? ' is-invalid' : '' }}" id="post" rows="3" readonly>{{$hrd->description_ar}}</textarea>
                                @if ($errors->has('description_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description_ar') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
