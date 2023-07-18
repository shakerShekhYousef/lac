@extends('layouts.app', ['name' => __('Create About Information')])

@section('content')
    @include('about.partials.header', [
        'name' =>__('Show Information'),
        'description' => __('Here you can show information'),
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Show Information') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('information') }}</h6>
                        <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                            <label for="content">Description</label>
                            <textarea name="content_ar" type="text"
                                      class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                      id="content"
                                      placeholder="حول"
                                      readonly>{{$about->content}}
                            </textarea>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">{{ __('information') }}</h6>
                        <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                            <label for="content">ِArabic Description</label>
                            <textarea name="content_ar" type="text"
                                      class="form-control form-control-alternative{{ $errors->has('content_ar') ? ' is-invalid' : '' }}"
                                      id="content"
                                      placeholder="Description"
                                      readonly>{{$about->content_ar}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
