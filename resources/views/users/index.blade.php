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
                                <div class="col-4 text-right">
                                    <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">
                                        @lang('buttons.backend.access.users.create')
                                    </a>
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
                            <table id="example" class="table align-items-center table-flush" id="laravel_datatable">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">@lang('labels.frontend.user.profile.avatar')</th>
                                    <th scope="col">@lang('labels.frontend.user.profile.name')</th>
                                    <th scope="col">@lang('labels.frontend.user.profile.email')</th>
                                    <th scope="col">@lang('labels.frontend.user.profile.code')</th>
                                    <th scope="col">@lang('labels.frontend.user.profile.status')</th>
                                    <th scope="col">@lang('labels.frontend.user.profile.has-changes')</th>
                                    <th scope="col">@lang('labels.general.create-date')</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.show',$user)}}">
                                                <img src="storage/images/users/{{$user->image}}"
                                                     style="width: 100px;height: 100px">
                                            </a>
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            @if($user->code)
                                                {{$user->code}}
                                            @else
                                                Nan
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->status)
                                                {{$user->status->name}}
                                            @else
                                                Nan
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->has_changes == 1)
                                                <a href="{{route('showRequest',$user)}}"
                                                   class="badge badge-success"> @lang('buttons.backend.access.users.has')</a>
                                            @elseif($user->has_changes == 0)
                                                <span
                                                    class="badge badge-danger"> @lang('buttons.backend.access.users.doesnt has')</span>
                                            @endif
                                            @if($user->password_change == 1)
                                                <a
                                                    id="test"
                                                    class="badge badge-success"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    data-id="{{ $user->id }}"
                                                > @lang('buttons.backend.access.users.password_change')</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{$user->created_at->diffForHumans()}}
                                        </td>
                                        <td>
                                            <a href="{{route('updateGroupUserView',$user)}}">
                                                <button class="btn btn-icon btn-2 btn-success" type="button"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Edit user's groups">
                                                    <span class="btn-inner--icon"><i class="fa fa-pen"></i></span>
                                                </button>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if(auth()->user()->role_id ==1)
                                                    @if( $user->role_id !== 1)
                                                        @if($user->has_changes == 0)
                                                            <a class="dropdown-item"
                                                               href="{{route('user.edit',$user)}}">@lang('buttons.general.crud.edit')</a>
                                                        @endif
                                                    @endif
                                                    @endif
                                                    @if(auth()->user()->role_id == 2)
                                                    @if($user->role_id !== 1)
                                                        @if($user->has_changes == 0)
                                                            <a class="dropdown-item"
                                                               href="{{route('user.edit',$user)}}">@lang('buttons.general.crud.edit')</a>
                                                        @endif
                                                    @endif
                                                    @endif
                                                    <form action="{{route('user.destroy',$user)}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                                class="dropdown-item">@lang('buttons.general.crud.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
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
    <!-- Modal -->
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

