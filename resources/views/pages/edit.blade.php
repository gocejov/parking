@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Setting Information</p>
                        <form method="POST" action="{{ route('update', $settings->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">Phone number</label>
                                        <input id="phone_number" name="phone_number" class="form-control" type="text"
                                               value="{{ $settings->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="license_plate" class="form-control-label">License Plate</label>
                                        <input id="license_plate" name="license_plate" class="form-control" type="text"
                                               value="{{ $settings->license_plate }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="default_park_time" class="form-control-label">Park Time</label>
                                        <input id="default_park_time" name="default_park_time" class="form-control"
                                               type="text" value="{{ $settings->default_park_time }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location" class="form-control-label">Location</label>
                                        <input id="location" name="location" class="form-control" type="text"
                                               value="{{ $settings->location }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
                @include('layouts.footers.auth.footer')
            </div>
@endsection
