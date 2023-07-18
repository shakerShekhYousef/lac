@extends('layouts.app', ['name' => __('Edit Question')])

@section('content')
    @include('questions.partials.header', [

        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.faq.edit')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('questions.update',$question)}}" method="post"
                              enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.faq.question')</h6>
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
                            <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                                <label for="content">@lang('labels.backend.access.faq.question')</label>
                                <textarea name="question" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('question') ? ' is-invalid' : '' }}"
                                          id="content"
                                          placeholder="Description"
                                          required>{{$question->question}}</textarea>
                                @if ($errors->has('question'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('question_ar') ? ' has-danger' : '' }}">
                                <label for="content">@lang('labels.backend.access.faq.arabic-question')</label>
                                <textarea name="question_ar" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('question_ar') ? ' is-invalid' : '' }}"
                                          id="content_ar"
                                          placeholder="السؤال"
                                          required>{{$question->question_ar}}</textarea>
                                @if ($errors->has('question_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('question_ar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('answer') ? ' has-danger' : '' }}">
                                <label for="content">@lang('labels.backend.access.faq.answer')</label>
                                <textarea name="answer" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('answer') ? ' is-invalid' : '' }}"
                                          id="content"
                                          placeholder="Description"
                                          required>{{$question->answer}}</textarea>
                                @if ($errors->has('answer'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('answer_ar') ? ' has-danger' : '' }}">
                                <label for="content">@lang('labels.backend.access.faq.arabic-answer')</label>
                                <textarea name="answer_ar" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('answer_ar') ? ' is-invalid' : '' }}"
                                          id="content"
                                          placeholder="الجواب"
                                          required>{{$question->answer_ar}}</textarea>
                                @if ($errors->has('answer_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('answer_ar') }}</strong>
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
