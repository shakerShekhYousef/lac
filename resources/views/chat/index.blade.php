@extends('layouts.app', ['title' => __('Rooms')])
@section('content')
<script>
    function unReadGroup(id){
    $.ajax({
        // url: "http://127.0.0.1:4000/getUnReadMessages",
       url: "http://lac.alifouad91.com:4000/getUnReadMessages",
	method: "POST",
	data: {
            roomId:id
	},
        success: function (response) {
            var messg = JSON.parse(response);
            console.log(response);
        try {
        var unR = messg[0]["COUNT(*)"];
        var un = document.getElementById("unreadMessages"+id).innerHTML = unR;
        return unR;
        alert('ssss' +roomId);
    }catch(err) {
}

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error");
        }
    });
}
</script>
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
                                    <h3 class="mb-0">@lang('labels.backend.access.groups.main')</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{route('Chat.create')}}" class="btn btn-sm btn-primary">@lang('buttons.general.crud.create')</a>
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
                                    <th scope="col">@lang('labels.backend.access.groups.name')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.code')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.days')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.times')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.times')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.status')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.create-date')</th>
                                    <th scope="col">@lang('labels.backend.access.groups.last-update')</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>

                                            @if ($room->status == 0 )
                                                {{$room->groupName}}
                                            @elseif ($room->status == 1)

                                                <a href="/chat.show/{{$room->id}}">
                                                    {{$room->groupName}}
                                                </a>
                                            @endif

                                            @if (auth()->user()->hasRole('superAdmin'))
                                                @if ($room->status == 0 )
                                                <form action="activeRoom/{{$room->id}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-lg "><i class="fas fa-check"></i></button>
                                                </form>
                                                @elseif ($room->status == 1)
                                                    <i class="fas fa-check-double"></i>
                                                @endif
                                            @endif

                                            <p id="unreadMessages{{$room->id}}"  style="display: inline;"></p>
                                        </td>
                                        <td>
                                            <script>document.addEventListener("DOMContentLoaded", unReadGroup({{$room->id}}));</script>
                                            {{$room->code}}
                                        </td>
                                        <td>
                                            {{$room->days}}
                                        </td>
                                        <td>
                                            {{$room->timeFrom}}
                                        </td>
                                        <td>
                                            {{$room->timeTo}}
                                        </td>
                                        <td>
                                            @if ($room->status == 0 )
                                                Waiting for activation
                                            @elseif ($room->status == 1)
                                                Activated
                                            @endif
                                        </td>
                                        <td>
                                            {{$room->created_at}}
                                        </td>
                                        <td>
                                            {{$room->updated_at}}
                                        </td>
                                        <td>
                                            <a href="{{route('group_user',$room)}}">
                                                <button class="btn btn-icon btn-2 btn-success" type="button">
                                                    <span class="btn-inner--icon"><i class="fa fa-eye"></i></span>
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
                                                    <a class="dropdown-item" href="editRoom/{{$room->id}}">@lang('buttons.general.crud.edit')</a>
                                                    <form action="D/{{$room->id}}">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <input type="text" name="room_id" id="room_id">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('nodejsapp/js/jquery.js')}}" type="text/javascript"></script>
    <script>

        $(document).on("click", "#test", function () {
            var link = $(this).attr('data-id');
            var modal = $('#exampleModal');
            modal.find(".card-body #room_id").val(link);
        });
    </script>
@endsection

