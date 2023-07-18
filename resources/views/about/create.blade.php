@extends('layouts.app', ['name' => __('Create About Information')])
@section('content')
    @include('about.partials.header', [
        'name' =>__('Create New Information'),
        'description' => __('Here you can create new information'),
        'class' => 'col-lg-12'
    ])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Create New Information') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('about.store')}}" method="post" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('information') }}</h6>
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
                            <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                <label for="description">Description</label>
                                <textarea name="description" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          id="editor"
                                          placeholder="Description"
                                          ></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description_ar') ? ' has-danger' : '' }}">
                                <label for="description">Arabic Description</label>
                                <textarea name="description_ar" type="text"
                                          class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                          id="description"
                                          placeholder="Description"
                                          ></textarea>
                                @if ($errors->has('description_ar'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description_ar') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success btn-lg">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
