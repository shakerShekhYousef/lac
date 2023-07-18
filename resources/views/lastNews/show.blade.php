@extends('layouts.app', ['title' => __('Show Post')])

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
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.last-news.show')</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">@lang('labels.backend.access.last-news.title')</label>
                            <input name="title" type="text" class="form-control" id="title"
                                   placeholder="{{$post->title}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="title">@lang('labels.backend.access.last-news.arabic-title')</label>
                            <input name="title_ar" type="text" class="form-control" id="title"
                                   placeholder="{{$post->title_ar}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="post">@lang('labels.backend.access.last-news.content')</label>
                            <textarea name="body" class="form-control" id="post" rows="3"
                                      readonly>{{$post->body}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="post">@lang('labels.backend.access.last-news.arabic-content')</label>
                            <textarea name="body_ar" class="form-control" id="post" rows="3"
                                      readonly>{{$post->body_ar}}</textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-file-upload form-file-multiple">
                                <label for="">@lang('labels.backend.access.last-news.image')</label>
                                <div class="form-group">
                                    <img src="/storage/images/posts/{{$post->image}}"
                                         style="height: 200px;width: 200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
