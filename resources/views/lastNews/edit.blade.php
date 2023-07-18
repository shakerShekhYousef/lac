@extends('layouts.app', ['title' => __('Edit Post')])

@section('content')
    @include('lastNews.partials.header', [

        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.last-news.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('lastNews.update',$post)}}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.last-news.post-information')</h6>
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
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label for="title">@lang('labels.backend.access.last-news.title')</label>
                                <input name="title" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       id="title"
                                       value="{{$post->title}}"
                                       placeholder="{{$post->title}}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('title_ar') ? ' has-danger' : '' }}">
                                <label for="title">@lang('labels.backend.access.last-news.arabic-title')</label>
                                <input name="title_ar" type="text"
                                       class="form-control form-control-alternative{{ $errors->has('title_ar') ? ' is-invalid' : '' }}"
                                       id="title_ar"
                                       placeholder="{{$post->title_ar}}">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title_ar') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }}">
                                <label for="post">@lang('labels.backend.access.last-news.content')</label>
                                <textarea name="body"
                                          class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" id="post"
                                          rows="3"
                                >{{$post->body}}</textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('body_ar') ? ' has-danger' : '' }}">
                                <label for="post">@lang('labels.backend.access.last-news.arabic-content')</label>
                                <textarea name="body"
                                          class="form-control{{ $errors->has('body_ar') ? ' is-invalid' : '' }}" id="post"
                                          rows="3"
                                >{{$post->body_ar}}</textarea>
                                @if ($errors->has('body_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('body_ar') }}</strong>
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
