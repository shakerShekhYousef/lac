@extends('layouts.app', ['name' => __('Update User Groups')])

@section('content')
    @include('chat.partials.header', [
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">@lang('labels.backend.access.users.update-group')</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <form method="post" action="{{ route('updateGroupUser',$user) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
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
                                <div class="col-md-12" id="group">
                                    <div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
                                        <div class="form-group">
                                            <label for="groupSelect">@lang('labels.backend.access.users.update-group')</label>
                                            <select name="groups[]" class="js-example-basic-multiple"
                                                    data-style="btn btn-link"
                                                    id="groupSelect" multiple>
                                                @foreach($groups_in as $group)
                                                    @if($group->id != 1)
                                                    <option selected value="{{$group->id}}">{{$group->code}}</option>
                                                    @endif
                                                @endforeach
                                                @foreach($groups_out as $group)
                                                        @if($group->id != 1)
                                                            <option value="{{$group->id}}">{{$group->code}}</option>
                                                        @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($errors->has('group'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('group') }}</strong>
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
        </div>
        @include('layouts.footers.auth')
    </div>
    <script src="{{asset('nodejsapp/js/jquery.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                width: '400px'
            });
        });
    </script>
@endsection
