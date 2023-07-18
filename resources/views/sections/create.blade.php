@extends('layouts.app', ['name' => __('Create Section')])

@section('content')
    @include('sections.partials.header', [
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.sections.create')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('section.store')}}" method="post" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.sections.section-information')</h6>
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
                                <label for="name">@lang('labels.backend.access.sections.name')</label>
                                <input name="name" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                                       placeholder="name"
                                       required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name_ar') ? ' has-danger' : '' }}">
                                <label for="name_ar">@lang('labels.backend.access.sections.arabic-name')</label>
                                <input name="name_ar" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" id="name"
                                       placeholder="name_ar"
                                       required>
                                @if ($errors->has('name_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name_ar') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('translate') ? ' has-danger' : '' }}">
                                <label for="translate">@lang('labels.backend.access.sections.translate')</label>
                                <textarea name="translate" class="form-control{{ $errors->has('translate') ? ' is-invalid' : '' }}" id="post" rows="3" ></textarea>
                                @if ($errors->has('translate'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('translate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('translate_ar') ? ' has-danger' : '' }}">
                                <label for="translate_ar">@lang('labels.backend.access.sections.translate-arabic')</label>
                                <textarea name="translate_ar" class="form-control{{ $errors->has('translate_ar') ? ' is-invalid' : '' }}" id="post" rows="3" ></textarea>
                                @if ($errors->has('translate_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('translate_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('conversation') ? ' has-danger' : '' }}">
                                <label for="post">@lang('labels.backend.access.sections.conversation')</label>
                                <textarea name="conversation" class="form-control{{ $errors->has('conversation') ? ' is-invalid' : '' }}" id="post" rows="3" ></textarea>
                                @if ($errors->has('conversation'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('conversation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('conversation_ar') ? ' has-danger' : '' }}">
                                <label for="post">@lang('labels.backend.access.sections.conversation-arabic')</label>
                                <textarea name="conversation_ar" class="form-control{{ $errors->has('conversation_ar') ? ' is-invalid' : '' }}" id="post" rows="3" ></textarea>
                                @if ($errors->has('conversation_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('conversation_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-file-upload form-file-multiple">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <label for="image">Insert Image</label>
                                            <input name="image" type="file" class="custom-file-label" id="image">
                                        </div>
                                    </div>
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
@endsection
