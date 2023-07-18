@extends('layouts.app', ['title' => __('Show Section')])

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
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.sections.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">@lang('labels.backend.access.sections.name')</label>
                            <input name="title" type="text" class="form-control" id="title"
                                   placeholder="{{$section->name}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="title_ar">@lang('labels.backend.access.sections.arabic-name')</label>
                            <input name="title_ar" type="text" class="form-control" id="title"
                                   placeholder="{{$section->name_ar}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="translate">@lang('labels.backend.access.sections.translate')</label>
                            <textarea name="translate" class="form-control" id="post" rows="3"
                                      readonly>{{$section->translate}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="translate_ar">@lang('labels.backend.access.sections.translate-arabic')</label>
                            <textarea name="translate_ar" class="form-control" id="post" rows="3"
                                      readonly>{{$section->translate_ar}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="conversation">@lang('labels.backend.access.sections.conversation')</label>
                            <textarea name="conversation" class="form-control" id="post" rows="3"
                                      readonly>{{$section->conversation}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="conversation_ar">@lang('labels.backend.access.sections.conversation-arabic')</label>
                            <textarea name="conversation_ar" class="form-control" id="post" rows="3"
                                      readonly>{{$section->conversation_ar}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
