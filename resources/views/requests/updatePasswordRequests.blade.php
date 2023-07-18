@extends('layouts.app',['title' => __('User Profile')])
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
                                    <h3 class="mb-0">@lang('labels.backend.access.users.management')</h3>
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
                            <table class="table align-items-center table-flush" id="laravel_datatable">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">@lang('labels.frontend.user.profile.avatar')</th>
                                    <th scope="col">@lang('labels.frontend.user.profile.name')</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.show',$user->id)}}">

                                                <img src=" http://lac.alifouad91.com/storage/images/users/{{$user->image}}"
                                                     style="width: 100px;height: 100px">
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                id="test"
                                                class="badge badge-success"
                                                data-toggle="modal" data-target="#exampleModal"
                                                data-id="{{ $user->id }}"
                                            >  {{$user->name}}</a>
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
            <footer class="footer">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-8">
                        <div class="copyright text-center text-xl-left text-muted">
                            &copy; {{ now()->year }} All Rights Reserved | Designed and Developed by <a
                                href="https://alifouad91.com/" class="font-weight-bold ml-1" target="_blank">Ali Fouad
                                Group</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        @lang('labels.backend.access.users.password_change')
                        <div class="modal-footer">
                            <form method="post" action="{{route('update.password')}}" autocomplete="off"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">@lang('buttons.general.cancel')</button>
                                <input class="form-control" name="user_id" type="text"
                                       id="user_id" hidden>
                                <button type="submit" class="btn btn-primary">@lang('buttons.general.save')</button>

                            </form>
                            <div class="text-center">
                                <form action="{{route('deletePasswordRequest')}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input class="form-control" name="user_id" type="text"
                                           id="user_id" hidden>
                                    <button type="submit"
                                            class="btn btn-danger">@lang('buttons.general.crud.delete')</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('nodejsapp/js/jquery.js')}}" type="text/javascript"></script>
    <script>
        $(document).on("click", "#test", function (e) {
            var link = $(this).attr('data-id');
            var modal = $('#exampleModal');
            modal.find(".card-body #user_id").val(link);
        })
    </script>
@endsection

