@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->firstname ?? ' Name'}} {{ auth()->user()->lastname ?? 'Surname'}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{auth()->user()->email}}
                        </p>
                    </div>
                </div>
{{--                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">--}}
{{--                    <div class="nav-wrapper position-relative end-0">--}}
{{--                        <ul class="nav nav-pills nav-fill p-1" role="tablist">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "--}}
{{--                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">--}}
{{--                                    <i class="ni ni-app"></i>--}}
{{--                                    <span class="ms-2">App</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "--}}
{{--                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">--}}
{{--                                    <i class="ni ni-email-83"></i>--}}
{{--                                    <span class="ms-2">Messages</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center "--}}
{{--                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">--}}
{{--                                    <i class="ni ni-settings-gear-65"></i>--}}
{{--                                    <span class="ms-2">Settings</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
{{--    <div id="alert">--}}
{{--        @include('components.alert')--}}
{{--    </div>--}}
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form role="form" method="POST" action="{{ route('profile.update') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="card-body">
                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Username</label>
                                        <input class="form-control" type="text" name="username" value="{{ old('username', auth()->user()->username) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" name="firstname"
                                               value="{{ old('firstname', auth()->user()->firstname) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" name="lastname"
                                               value="{{ old('lastname', auth()->user()->lastname) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city" class="form-control-label">City</label>
                                        <input class="form-control" type="text" name="city"
                                               value="{{ old('city', auth()->user()->city) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">Address</label>
                                        <input class="form-control" type="text" name="address"
                                               value="{{ old('address', auth()->user()->address) }}">
                                    </div>
                                </div>
                            </div>
                            {{--                            <hr class="horizontal dark">--}}
                            {{--                            <p class="text-uppercase text-sm bold">Add or Edit your vehicle</p>--}}
                            {{--                                                        <div class="row">--}}
                            {{--                                                            @foreach(auth()->user()->vehicles as $vehicle)--}}
                            {{--                                                                <div class="col-md-4">--}}
                            {{--                                                                    <div class="form-group">--}}
                            {{--                                                                        <label for="vehicle_make" class="form-control-label">Vehicle Make</label>--}}
                            {{--                                                                        <input class="form-control" type="text" name="vehicle_make"--}}
                            {{--                                                                               value="{{ old('vehicle_make', $vehicle->vehicle_make) }}">--}}
                            {{--                                                                    </div>--}}
                            {{--                                                                </div>--}}

                            {{--                                                                <div class="col-md-4">--}}
                            {{--                                                                    <div class="form-group">--}}
                            {{--                                                                        <label for="vehicle_model" class="form-control-label">Vehicle Model</label>--}}
                            {{--                                                                        <input class="form-control" type="text" name="license_plate"--}}
                            {{--                                                                               value="{{ old('vehicle_model', $vehicle->vehicle_model) }}">--}}
                            {{--                                                                    </div>--}}
                            {{--                                                                </div>--}}
                            {{--                                                                <div class="col-md-4">--}}
                            {{--                                                                    <div class="form-group">--}}
                            {{--                                                                        <label for="license_plate" class="form-control-label">License Plate</label>--}}
                            {{--                                                                        <input class="form-control" type="text" name="license_plate"--}}
                            {{--                                                                               value="{{ old('license_plate', $vehicle->license_plate) }}">--}}
                            {{--                                                                    </div>--}}
                            {{--                                                                </div>--}}
                            {{--                                                                <div class="col-md-4">--}}
                            {{--                                                                    <div class="form-group">--}}
                            {{--                                                                        <label for="default_park_time" class="form-control-label">Phone number for payment</label>--}}
                            {{--                                                                        <input class="form-control" type="text" name="phone_number"--}}
                            {{--                                                                               value="{{ old('default_park_time', $vehicle->phone_number) }}">--}}
                            {{--                                                                    </div>--}}
                            {{--                                                                </div>--}}
                            {{--                                                                <div class="col-md-4">--}}
                            {{--                                                                    <div class="form-group">--}}
                            {{--                                                                        <label for="default_park_time" class="form-control-label">Default Park Time For POC</label>--}}
                            {{--                                                                        <input class="form-control" type="text" name="default_park_time"--}}
                            {{--                                                                               value="{{ old('default_park_time', $vehicle->default_park_time) }}">--}}
                            {{--                                                                    </div>--}}
                            {{--                                                                </div>--}}
                            {{--                                                            @endforeach--}}
                            {{--                                                        </div>--}}
                        </div>
                    </form>
                </div>
                @include('layouts.footers.auth.footer')
            </div>
@endsection
