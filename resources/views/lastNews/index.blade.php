@extends('layouts.app', ['title' => __('Last News')])
@section('content')
    <div class="main-content">
        <div class="header bg-gradient-orange pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">@lang('labels.backend.access.last-news.main')</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{route('lastNews.create')}}" class="btn btn-sm btn-primary">@lang('buttons.general.crud.create')</a>
                                </div>
                            </div>
                        </div>
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
                        <div class="table-responsive">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">@lang('labels.backend.access.last-news.image')</th>
                                    <th scope="col">@lang('labels.backend.access.last-news.title')</th>
                                    <th scope="col">@lang('labels.backend.access.last-news.arabic-title')</th>
                                    <th scope="col">@lang('labels.backend.access.last-news.create-date')</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            <a href="{{route('lastNews.show',$post)}}">
                                                <img src="/storage/images/posts/{{$post->image}}"
                                                     style="width: 100px;height: 100px">
                                            </a>
                                        </td>
                                        <td>
                                            {{$post->title}}
                                        </td>
                                        <td>
                                            {{$post->title_ar}}
                                        </td>
                                        <td>
                                            {{$post->created_at->diffForHumans()}}
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('lastNews.edit',$post)}}">@lang('buttons.general.crud.edit')</a>
                                                    <form action="{{route('lastNews.delete',$post)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">@lang('buttons.general.crud.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footers.auth')
        </div>
    </div>
@endsection
