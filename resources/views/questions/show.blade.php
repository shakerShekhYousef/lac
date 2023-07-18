@extends('layouts.app', ['name' => __('Show Question')])
@section('content')
    @include('questions.partials.header', [

        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.faq.show')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">@lang('labels.backend.access.faq.question')</h6>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="content">@lang('labels.backend.access.faq.question')</label>
                            <textarea name="description" type="text"
                                      class="form-control form-control-alternative"
                                      id="content"
                                      placeholder="Description"
                                      readonly>{{$question->question}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">@lang('labels.backend.access.faq.arabic-question')</label>
                            <textarea name="description_ar" type="text"
                                      class="form-control form-control-alternative"
                                      id="content"
                                      placeholder="سؤال"
                                      readonly>{{$question->question_ar}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">@lang('labels.backend.access.faq.answer')</label>
                            <textarea name="description" type="text"
                                      class="form-control form-control-alternative"
                                      id="content"
                                      placeholder="Description"
                                      readonly>{{$question->answer}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">@lang('labels.backend.access.faq.arabic-answer')</label>
                            <textarea name="description_ar" type="text"
                                      class="form-control form-control-alternative"
                                      id="content"
                                      placeholder="جواب"
                                      readonly>{{$question->answer_ar}}</textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="card shadow">--}}
        {{--            <div class="card-header border-0">--}}
        {{--                <div class="row align-items-center">--}}
        {{--                    <div class="col-8">--}}
        {{--                        <h3 class="mb-0">Answers</h3>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-4 text-right">--}}
        {{--                        <a href="{{route('answer.create',$question)}}" class="btn btn-sm btn-primary">Add--}}
        {{--                            Answer</a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <div class="col-12">--}}
        {{--                @if (session('status'))--}}
        {{--                    <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
        {{--                        {{ session('status') }}--}}
        {{--                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--                            <span aria-hidden="true">&times;</span>--}}
        {{--                        </button>--}}
        {{--                    </div>--}}
        {{--                @endif--}}
        {{--            </div>--}}
        {{--            <div class="table-responsive">--}}
        {{--                <table class="table align-items-center table-flush">--}}
        {{--                    <thead class="thead-light">--}}
        {{--                    <tr>--}}
        {{--                        <th scope="col">Content</th>--}}
        {{--                        <th scope="col">Creation Date</th>--}}
        {{--                        <th scope="col"></th>--}}
        {{--                    </tr>--}}
        {{--                    </thead>--}}
        {{--                    <tbody>--}}
        {{--                    @foreach($answers as $answer)--}}
        {{--                        <tr>--}}
        {{--                            <td>--}}
        {{--                                <a href="{{route('answer.show',$answer)}}">--}}
        {{--                                    {{$answer->answer}}--}}
        {{--                                </a>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                {{$answer->created_at->diffForHumans()}}--}}
        {{--                            </td>--}}
        {{--                            <td class="text-right">--}}
        {{--                                <div class="dropdown">--}}
        {{--                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"--}}
        {{--                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
        {{--                                        <i class="fas fa-ellipsis-v"></i>--}}
        {{--                                    </a>--}}
        {{--                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
        {{--                                        <a class="dropdown-item"--}}
        {{--                                           href="{{route('answer.edit',$answer)}}">Edit</a>--}}
        {{--                                        <form action="{{route('answer.delete',$answer)}}"--}}
        {{--                                              method="post">--}}
        {{--                                            @method('DELETE')--}}
        {{--                                            @csrf--}}
        {{--                                            <button type="submit" class="dropdown-item">Delete</button>--}}
        {{--                                        </form>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </td>--}}
        {{--                        </tr>--}}
        {{--                    @endforeach--}}
        {{--                    </tbody>--}}
        {{--                </table>--}}
        {{--            </div>--}}
        {{--            <div class="card-footer py-4">--}}
        {{--                <nav class="d-flex justify-content-end" aria-label="...">--}}
        {{--                </nav>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        @include('layouts.footers.auth')
    </div>
@endsection
