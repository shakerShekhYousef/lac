@extends('layouts.app',['title' => __('Reports')])
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
                                    <h3 class="mb-0">@lang('labels.backend.access.activates.main')</h3>
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
                            <table  id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th scope="col">@lang('labels.backend.access.activates.student')</th>
                                    <th scope="col">@lang('labels.backend.access.activates.count_login')</th>
                                    <th scope="col">@lang('labels.backend.access.activates.count_messages')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $user)
                                    <tr>
                                        <td>
                                            <a href="{{route('user.show',$user->id)}}">
                                                <img src=" http://lac.alifouad91.com/storage/images/users/{{$user->image}}"
                                                     style="width: 100px;height: 100px">
                                            </a>
                                        </td>
                                        <td>
                                            {{$user->name}}
                                        </td>
                                        <td>
                                           {{$user->count_login}}
                                        </td>
                                        <td>
                                            <?php
                                            $count_private=\App\Models\Message::where('idSender',$user->id)->get()->count();
                                            $count_group=DB::table('msggrops')->where('userId',$user->id)->get()->count();
                                            $count_messages=$count_private + $count_group;
                                            ?>
                                            {{$count_messages}}
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

@endsection

