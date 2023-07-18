@extends('layouts.app', ['name' => __('Edit About Information')])
@section('content')
    @include('about.partials.header', [
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.about.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('about.update',$about)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
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
                            <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                <label for="content">@lang('labels.backend.access.about.description')</label>
                                <textarea name="description" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content"
                                       placeholder="Description"
                                       required>{{$about->content}}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('content_ar') ? ' has-danger' : '' }}">
                                <label for="content">@lang('labels.backend.access.about.description-arabic')</label>
                                <textarea name="description_ar" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('content_ar') ? ' is-invalid' : '' }}" id="content"
                                          placeholder="حول"
                                          required>{{$about->content_ar}}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content_ar') }}</strong>
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
