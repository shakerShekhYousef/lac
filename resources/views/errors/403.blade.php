@extends('layouts.app')
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create New Answer') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h1>Error 403</h1>
                        <p>You don't have the right to access this page.</p>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
