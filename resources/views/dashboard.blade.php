@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"></h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('user.index')}}" class="btn btn-sm btn-primary">@lang('labels.general.all')</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">@lang('labels.frontend.user.profile.avatar')</th>
                                <th scope="col">@lang('labels.frontend.user.profile.name')</th>
                                <th scope="col">@lang('labels.backend.access.roles.table.role')</th>
                                <th scope="col">@lang('labels.general.create-date')</th>
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
                                       {{$user->role->name}}
                                    </td>
                                    <td>
                                        {{$user->created_at->diffForHumans()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
