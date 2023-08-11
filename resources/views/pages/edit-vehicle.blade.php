@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Vehicle'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form role="form" method="POST" action={{ route('vehicle.save') }}>
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Vehicle information</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_make" class="form-control-label">Vehicle Make</label>
                                        <input id="vehicle_make" name="vehicle_make" class="form-control" type="text"
                                               value="{{ old('vehicle_make', $vehicle->vehicle_make) }}">
                                        @error('vehicle_make')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_model" class="form-control-label">Vehicle Model</label>
                                        <input id="vehicle_model" name="vehicle_model" class="form-control" type="text"
                                               value="{{ old('vehicle_model', $vehicle->vehicle_model) }}">
                                        @error('vehicle_model')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license_plate" class="form-control-label">License Plate</label>
                                        <input id="license_plate" name="license_plate" class="form-control" type="text"
                                               value="{{ old('license_plate', $vehicle->license_plate) }}">
                                        @error('license_plate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="default_park_time" class="form-control-label">Default Park
                                            Time</label>
                                        <input id="default_park_time" name="default_park_time" class="form-control"
                                               type="text"
                                               value="{{ old('default_park_time', $vehicle->default_park_time) }}">
                                        @error('default_park_time')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">Phone Number</label>
                                        <input id="phone_number" name="phone_number" class="form-control" type="text"
                                               value="{{ old('phone_number', $vehicle->phone_number) }}">
                                        @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label for="address" class="form-control-label">Address</label>--}}
                                {{--                                        <input class="form-control" type="text" name="address"--}}
                                {{--                                               value="{{ old('address', auth()->user()->address) }}">--}}
                                {{--                                    </div>--}}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                </div>
                            </div>
                        </div>

@endsection
