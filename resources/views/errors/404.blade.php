@extends('layouts.app', ['name' => __('Create New Answer')])
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
                        <h1>Error 404</h1>
                        <p>The requested page was not found.</p>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
