@extends('layouts.app', ['title' => __('messages Profile')])
@section('content')

<script>
function unRead(id){
    $.ajax({
       //  url: "http://127.0.0.1:3000/getUnReadMessages",
      url: "http://lac.alifouad91.com:3000/getUnReadMessages",
	method: "POST",
	data: {
            idSender:id,
            idReceiver:'{{auth()->user()->id}}',
	},
        success: function (response) {
            // var d = '*';
            var messg = JSON.parse(response);
            console.log(response);
        try {
        var unR = messg[0]["COUNT(*)"];
        var un = document.getElementById("unreadMessages"+id).innerHTML = unR;
        return unR;

    }catch(err) {
}

        },
        error: function (jqXHR, textStatus, errorThrown) {
            // console.log("error");
        }
    });
}

function unReadStudent(id){
    $.ajax({
     //  url: "http://127.0.0.1:4000/getUnReadMessages",
       url: "http://lac.alifouad91.com:4000/getUnReadMessages",
	method: "POST",
	data: {
            roomId:id+"000000",
	},
        success: function (response) {
            var messg = JSON.parse(response);
            console.log(response);
        try {
        var unR = messg[0]["COUNT(*)"];
        var un = document.getElementById("unreadMessages"+id).innerHTML = unR;
        return unR;
        // alert('ssss' +roomId);
    }catch(err) {
}
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error");
        }
    });
}
</script>


<script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Has Changes</th>
                                    <th scope="col">Creation Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $user)
                                <tr>
                                    <td>
                                        <img src="storage/images/users/{{$user->image}}"
                                             style="width: 100px;height: 100px">
                                    </td>
                                    <td>
                                        <div id="chat-sidebar">
                                          @if ((auth()->user()->role->id == 1)||(auth()->user()->role->id == 2))
                                            @if ($user->role->id == 3)
                                               <script>document.addEventListener("DOMContentLoaded", unReadStudent({{$user->id}}));</script>
                                            <a href="/conve/{{$user->id}}">
                                                {{$user->name}}&emsp;<i class="far fa-comments ico"></i>
                                                <p id="unreadMessages{{$user->id}}"  style="display: inline;"></p>
                                            </a>
                                            <div id="sidebar-user-box" data-input="{{$user->name}}" class="{{$user->id}}" RoleReceiverId="{{$user->role->id}}" clicked="0">
                                                <script>document.addEventListener("DOMContentLoaded", unRead({{$user->id}}));</script>
                                                <span id="slider-username" >
                                                    Private
                                                    <p id="unreadMessages{{$user->id}}"  style="display: inline;"></p>
                                                </span>
                                            </div>
                                            @else
                                            <div id="sidebar-user-box" data-input="{{$user->name}}" class="{{$user->id}}" RoleReceiverId="{{$user->role->id}}" clicked="0">
                                                <script>document.addEventListener("DOMContentLoaded", unRead({{$user->id}}));</script>
                                                <span id="slider-username" >
                                                    {{$user->name}}&emsp;<i class="far fa-comments ico"></i>
                                                    <p id="unreadMessages{{$user->id}}"  style="display: inline;"></p>
                                                </span>
                                            </div>
                                            @endif
                                          @elseif (auth()->user()->role->id == 3)
                                            @if (($user->role->id == 1)||($user->role->id == 2))
                                            <a href="/conve/{{auth()->user()->id}}">
                                                {{$user->name}}&emsp;<i class="far fa-comments ico"></i>

                                            </a>
                                            @else
                                                <div id="sidebar-user-box" data-input="{{$user->name}}" class="{{$user->id}}" RoleReceiverId="{{$user->role->id}}" clicked="0">
                                                    <script>document.addEventListener("DOMContentLoaded", unRead({{$user->id}}));</script>
                                                    <span id="slider-username" >
                                                        {{$user->name}}&emsp;<i class="far fa-comments ico"></i>
                                                        <p id="unreadMessages{{$user->id}}"  style="display: inline;"></p>
                                                    </span>
                                                </div>
                                            @endif
                                          @else
                                                <div id="sidebar-user-box" data-input="{{$user->name}}" class="{{$user->id}}" RoleReceiverId="{{$user->role->id}}" clicked="0">
                                                    <script>document.addEventListener("DOMContentLoaded", unRead({{$user->id}}));</script>
                                                    <span id="slider-username" onclick="getOldMessages('{{$user->name}}','{{$user->id}}','{{$user->role->id}}')" >
                                                        {{$user->name}}&emsp;<i class="far fa-comments ico"></i>
                                                        <p id="unreadMessages{{$user->id}}"  style="display: inline;"></p>
                                                    </span>
                                                </div>
                                                @endif
                                                </div>
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
                                                    {{$user->status}}
                                                    @else
                                                    Nan
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->has_changes == 1)
                                                    <a href="{{route('showRequest',$user)}}"
                                                       class="badge badge-success">HAS</a>
                                                    @elseif($user->has_changes == 0)
                                                    <span class="badge badge-danger">Does not has</span>
                                                    @endif
                                                    @if($user->password_change == 1)
                                                    <a href="{{route('showRequest',$user)}}"
                                                       class="badge badge-success" data-toggle="modal"
                                                       data-target="#exampleModal">Password Change</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$user->created_at->diffForHumans()}}
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
                                                {{$messages->links()}}
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
                                                                <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}</h5>

                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <form method="post" action="{{route('update.password',$user)}}" autocomplete="off"
                                                                          enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        This user has password changes
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                    <div class="text-center mt-4">
                                                                        <form action="{{route('deletePasswordRequest',$user->id)}}" method="post">
                                                                            @method('receiverDELETE')
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-danger">Delete changes</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endsection


