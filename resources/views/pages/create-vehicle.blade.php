@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Vehicle'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header pb-0">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add Vehicle</p>
                            </div>
                        </div>
                        <div class="card-body">

                            <form role="form" method="POST" action="{{ route('vehicle.save') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehicle_make" class="form-control-label">Vehicle Make</label>
                                            <input id="vehicle_make" name="vehicle_make" class="form-control"
                                                   type="text"
                                                   placeholder="Ford">
                                            @error('vehicle_make')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vehicle_model" class="form-control-label">Vehicle Model</label>
                                            <input id="vehicle_model" name="vehicle_model" class="form-control"
                                                   type="text"
                                                   placeholder="Focus">
                                            @error('vehicle_model')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="license_plate" class="form-control-label">License Plate</label>
                                            <input id="license_plate" name="license_plate" class="form-control"
                                                   type="text"
                                                   placeholder="AA-1234-BB">
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
                                                   placeholder="1">
                                            @error('default_park_time')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number" class="form-control-label">Phone Number</label>
                                            <input id="phone_number" name="phone_number" class="form-control"
                                                   type="text"
                                                   placeholder="+38970123456">
                                            @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('layouts.footers.auth.footer')
                </div>
            </div>
        </div>
    </div>

@endsection
