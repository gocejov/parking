@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>My Dashboard</h6>
                        <p class="text-xs text-secondary mb-2">
                            Name: {{auth()->user()->firstname . ' '. auth()->user()->lastname}}</p>
                        <p class="text-xs text-secondary mb-2">
                            username: {{auth()->user()->username}}</p>
                    </div>
                    @csrf
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="card-body justify-content mb-3">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                                <i class="fas fa-plus"></i> Add Vehicle
                            </button>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        Phone number
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        License Plate Number
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        Vehicle Make
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        Vehicle Model
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        Park Time
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        Last Location
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-12 font-weight-bold">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->vehicles as $vehicle)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$vehicle->phone_number}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold mb-0">{{$vehicle->license_plate}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold mb-0">{{$vehicle->vehicle_make}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold mb-0">{{$vehicle->vehicle_model}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold mb-0">{{$vehicle->default_park_time}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold mb-0">{{$vehicle->zone->name}}</span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-icon btn-warning btn-sm me-2"
                                                        onclick="openEditModal({{ $vehicle->id }})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('vehicle.delete') }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this vehicle?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                                    <button type="submit" class="btn btn-icon btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal_{{ $vehicle->id }}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="editModalLabel_{{ $vehicle->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel_{{ $vehicle->id }}">Edit
                                                        Vehicle</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editForm_{{ $vehicle->id }}">
                                                        <div class="form-group">
                                                            <label for="license_plate">License Plate</label>
                                                            <input type="text" class="form-control" id="license_plate"
                                                                   name="license_plate"
                                                                   value="{{ $vehicle->license_plate }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="default_park_time">Default Park Time</label>
                                                            <input type="text" class="form-control"
                                                                   id="default_park_time" name="default_park_time"
                                                                   value="{{ $vehicle->default_park_time }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone_number">Phone Number</label>
                                                            <input type="text" class="form-control" id="phone_number"
                                                                   name="phone_number"
                                                                   value="{{ $vehicle->phone_number }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="vehicle_make">Vehicle Make</label>
                                                            <input type="text" class="form-control" id="vehicle_make"
                                                                   name="vehicle_make"
                                                                   value="{{ $vehicle->vehicle_make }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="vehicle_model">Vehicle Model</label>
                                                            <input type="text" class="form-control" id="vehicle_model"
                                                                   name="vehicle_model"
                                                                   value="{{ $vehicle->vehicle_model }}">
                                                        </div>
                                                    </form>
                                                    <div class="alert alert-success" role="alert" style="display: none;"
                                                         id="editSuccessAlert">
                                                        Changes were saved successfully.
                                                    </div>
                                                    <div class="alert alert-danger" role="alert" style="display: none;"
                                                         id="editErrorAlert">
                                                        Changes could not be saved. Please try again.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="submitEditForm({{ $vehicle->id }})">Save Changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal_{{$vehicle->id}}" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="deleteModalLabel_{{$vehicle->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel_{{$vehicle->id}}">
                                                        Confirm Deletion</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this vehicle?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <a href="{{ route('vehicle.delete', ['vehicle_id' => $vehicle->id]) }}"
                                                       class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="modal fade" id="createModal" tabindex="-1" role="dialog"
                                     aria-labelledby="createModalLabel" aria-hidden="true">
                                    <!-- Create modal content goes here -->
                                </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid py-4 mt-auto">
            {{--                    <div class="row">--}}
            {{--                        <div class="col-lg-8">--}}
            {{--                            <div class="row">--}}
            {{--                                <div class="col-xl-6 mb-xl-0 mb-4">--}}
            {{--                                    <div class="card bg-transparent shadow-xl">--}}
            {{--                                        <div class="overflow-hidden position-relative border-radius-xl"--}}
            {{--                                             style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg');">--}}
            {{--                                            <span class="mask bg-gradient-dark"></span>--}}
            {{--                                            <div class="card-body position-relative z-index-1 p-3">--}}
            {{--                                                <i class="fas fa-wifi text-white p-2"></i>--}}
            {{--                                                <h5 class="text-white mt-4 mb-5 pb-2">--}}
            {{--                                                    4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>--}}
            {{--                                                <div class="d-flex">--}}
            {{--                                                    <div class="d-flex">--}}
            {{--                                                        <div class="me-4">--}}
            {{--                                                            <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>--}}
            {{--                                                            <h6 class="text-white mb-0">Jack Peterson</h6>--}}
            {{--                                                        </div>--}}
            {{--                                                        <div>--}}
            {{--                                                            <p class="text-white text-sm opacity-8 mb-0">Expires</p>--}}
            {{--                                                            <h6 class="text-white mb-0">11/22</h6>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                    <div--}}
            {{--                                                        class="ms-auto w-20 d-flex align-items-end justify-content-end">--}}
            {{--                                                        <img class="w-60 mt-2" src="/img/logos/mastercard.png"--}}
            {{--                                                             alt="logo">--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-xl-6">--}}
            {{--                                    <div class="row">--}}
            {{--                                        <div class="col-md-6">--}}
            {{--                                            <div class="card">--}}
            {{--                                                <div class="card-header mx-4 p-3 text-center">--}}
            {{--                                                    <div--}}
            {{--                                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">--}}
            {{--                                                        <i class="fas fa-landmark opacity-10"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                                <div class="card-body pt-0 p-3 text-center">--}}
            {{--                                                    <h6 class="text-center mb-0">Salary</h6>--}}
            {{--                                                    <span class="text-xs">Belong Interactive</span>--}}
            {{--                                                    <hr class="horizontal dark my-3">--}}
            {{--                                                    <h5 class="mb-0">+$2000</h5>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="col-md-6 mt-md-0 mt-4">--}}
            {{--                                            <div class="card">--}}
            {{--                                                <div class="card-header mx-4 p-3 text-center">--}}
            {{--                                                    <div--}}
            {{--                                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">--}}
            {{--                                                        <i class="fab fa-paypal opacity-10"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                                <div class="card-body pt-0 p-3 text-center">--}}
            {{--                                                    <h6 class="text-center mb-0">Paypal</h6>--}}
            {{--                                                    <span class="text-xs">Freelance Payment</span>--}}
            {{--                                                    <hr class="horizontal dark my-3">--}}
            {{--                                                    <h5 class="mb-0">$455.00</h5>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="col-md-12 mb-lg-0 mb-4">--}}
            {{--                                    <div class="card mt-4">--}}
            {{--                                        <div class="card-header pb-0 p-3">--}}
            {{--                                            <div class="row">--}}
            {{--                                                <div class="col-6 d-flex align-items-center">--}}
            {{--                                                    <h6 class="mb-0">Payment Method</h6>--}}
            {{--                                                </div>--}}
            {{--                                                <div class="col-6 text-end">--}}
            {{--                                                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i--}}
            {{--                                                            class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="card-body p-3">--}}
            {{--                                            <div class="row">--}}
            {{--                                                <div class="col-md-6 mb-md-0 mb-4">--}}
            {{--                                                    <div--}}
            {{--                                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">--}}
            {{--                                                        <img class="w-10 me-3 mb-0" src="/img/logos/mastercard.png"--}}
            {{--                                                             alt="logo">--}}
            {{--                                                        <h6 class="mb-0">--}}
            {{--                                                            ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852</h6>--}}
            {{--                                                        <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"--}}
            {{--                                                           data-bs-toggle="tooltip" data-bs-placement="top"--}}
            {{--                                                           title="Edit Card"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                                <div class="col-md-6">--}}
            {{--                                                    <div--}}
            {{--                                                        class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">--}}
            {{--                                                        <img class="w-10 me-3 mb-0" src="/img/logos/visa.png"--}}
            {{--                                                             alt="logo">--}}
            {{--                                                        <h6 class="mb-0">--}}
            {{--                                                            ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248</h6>--}}
            {{--                                                        <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"--}}
            {{--                                                           data-bs-toggle="tooltip" data-bs-placement="top"--}}
            {{--                                                           title="Edit Card"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-lg-4">--}}
            {{--                            <div class="card h-100">--}}
            {{--                                <div class="card-header pb-0 p-3">--}}
            {{--                                    <div class="row">--}}
            {{--                                        <div class="col-6 d-flex align-items-center">--}}
            {{--                                            <h6 class="mb-0">Invoices</h6>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="col-6 text-end">--}}
            {{--                                            <button class="btn btn-outline-primary btn-sm mb-0">View All</button>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="card-body p-3 pb-0">--}}
            {{--                                    <ul class="list-group">--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>--}}
            {{--                                                <span class="text-xs">#MS-415646</span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="d-flex align-items-center text-sm">--}}
            {{--                                                $180--}}
            {{--                                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i--}}
            {{--                                                        class="fas fa-file-pdf text-lg me-1"></i> PDF--}}
            {{--                                                </button>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="text-dark mb-1 font-weight-bold text-sm">February, 10,--}}
            {{--                                                    2021</h6>--}}
            {{--                                                <span class="text-xs">#RV-126749</span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="d-flex align-items-center text-sm">--}}
            {{--                                                $250--}}
            {{--                                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i--}}
            {{--                                                        class="fas fa-file-pdf text-lg me-1"></i> PDF--}}
            {{--                                                </button>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="text-dark mb-1 font-weight-bold text-sm">April, 05, 2020</h6>--}}
            {{--                                                <span class="text-xs">#FB-212562</span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="d-flex align-items-center text-sm">--}}
            {{--                                                $560--}}
            {{--                                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i--}}
            {{--                                                        class="fas fa-file-pdf text-lg me-1"></i> PDF--}}
            {{--                                                </button>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="text-dark mb-1 font-weight-bold text-sm">June, 25, 2019</h6>--}}
            {{--                                                <span class="text-xs">#QW-103578</span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="d-flex align-items-center text-sm">--}}
            {{--                                                $120--}}
            {{--                                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i--}}
            {{--                                                        class="fas fa-file-pdf text-lg me-1"></i> PDF--}}
            {{--                                                </button>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="text-dark mb-1 font-weight-bold text-sm">March, 01, 2019</h6>--}}
            {{--                                                <span class="text-xs">#AR-803481</span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="d-flex align-items-center text-sm">--}}
            {{--                                                $300--}}
            {{--                                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i--}}
            {{--                                                        class="fas fa-file-pdf text-lg me-1"></i> PDF--}}
            {{--                                                </button>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                    </ul>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-md-7 mt-4">--}}
            {{--                            <div class="card">--}}
            {{--                                <div class="card-header pb-0 px-3">--}}
            {{--                                    <h6 class="mb-0">Billing Information</h6>--}}
            {{--                                </div>--}}
            {{--                                <div class="card-body pt-4 p-3">--}}
            {{--                                    <ul class="list-group">--}}
            {{--                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="mb-3 text-sm">Oliver Liam</h6>--}}
            {{--                                                <span class="mb-2 text-xs">Company Name: <span--}}
            {{--                                                        class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>--}}
            {{--                                                <span class="mb-2 text-xs">Email Address: <span--}}
            {{--                                                        class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>--}}
            {{--                                                <span class="text-xs">VAT Number: <span--}}
            {{--                                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="ms-auto text-end">--}}
            {{--                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0"--}}
            {{--                                                   href="javascript:;"><i--}}
            {{--                                                        class="far fa-trash-alt me-2"></i>Delete</a>--}}
            {{--                                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i--}}
            {{--                                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="mb-3 text-sm">Lucas Harper</h6>--}}
            {{--                                                <span class="mb-2 text-xs">Company Name: <span--}}
            {{--                                                        class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>--}}
            {{--                                                <span class="mb-2 text-xs">Email Address: <span--}}
            {{--                                                        class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>--}}
            {{--                                                <span class="text-xs">VAT Number: <span--}}
            {{--                                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="ms-auto text-end">--}}
            {{--                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0"--}}
            {{--                                                   href="javascript:;"><i--}}
            {{--                                                        class="far fa-trash-alt me-2"></i>Delete</a>--}}
            {{--                                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i--}}
            {{--                                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">--}}
            {{--                                            <div class="d-flex flex-column">--}}
            {{--                                                <h6 class="mb-3 text-sm">Ethan James</h6>--}}
            {{--                                                <span class="mb-2 text-xs">Company Name: <span--}}
            {{--                                                        class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>--}}
            {{--                                                <span class="mb-2 text-xs">Email Address: <span--}}
            {{--                                                        class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>--}}
            {{--                                                <span class="text-xs">VAT Number: <span--}}
            {{--                                                        class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="ms-auto text-end">--}}
            {{--                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0"--}}
            {{--                                                   href="javascript:;"><i--}}
            {{--                                                        class="far fa-trash-alt me-2"></i>Delete</a>--}}
            {{--                                                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i--}}
            {{--                                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                    </ul>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="col-md-5 mt-4">--}}
            {{--                            <div class="card h-100 mb-4">--}}
            {{--                                <div class="card-header pb-0 px-3">--}}
            {{--                                    <div class="row">--}}
            {{--                                        <div class="col-md-6">--}}
            {{--                                            <h6 class="mb-0">Your Transaction's</h6>--}}
            {{--                                        </div>--}}
            {{--                                        <div class="col-md-6 d-flex justify-content-end align-items-center">--}}
            {{--                                            <i class="far fa-calendar-alt me-2"></i>--}}
            {{--                                            <small>23 - 30 March 2020</small>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                                <div class="card-body pt-4 p-3">--}}
            {{--                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>--}}
            {{--                                    <ul class="list-group">--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex align-items-center">--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">--}}
            {{--                                                    <i--}}
            {{--                                                        class="fas fa-arrow-down"></i></button>--}}
            {{--                                                <div class="d-flex flex-column">--}}
            {{--                                                    <h6 class="mb-1 text-dark text-sm">Netflix</h6>--}}
            {{--                                                    <span class="text-xs">27 March 2020, at 12:30 PM</span>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                            <div--}}
            {{--                                                class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">--}}
            {{--                                                - $ 2,500--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex align-items-center">--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">--}}
            {{--                                                    <i--}}
            {{--                                                        class="fas fa-arrow-up"></i></button>--}}
            {{--                                                <div class="d-flex flex-column">--}}
            {{--                                                    <h6 class="mb-1 text-dark text-sm">Apple</h6>--}}
            {{--                                                    <span class="text-xs">27 March 2020, at 04:30 AM</span>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                            <div--}}
            {{--                                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">--}}
            {{--                                                + $ 2,000--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                    </ul>--}}
            {{--                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>--}}
            {{--                                    <ul class="list-group">--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex align-items-center">--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">--}}
            {{--                                                    <i--}}
            {{--                                                        class="fas fa-arrow-up"></i></button>--}}
            {{--                                                <div class="d-flex flex-column">--}}
            {{--                                                    <h6 class="mb-1 text-dark text-sm">Stripe</h6>--}}
            {{--                                                    <span class="text-xs">26 March 2020, at 13:45 PM</span>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                            <div--}}
            {{--                                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">--}}
            {{--                                                + $ 750--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex align-items-center">--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">--}}
            {{--                                                    <i--}}
            {{--                                                        class="fas fa-arrow-up"></i></button>--}}
            {{--                                                <div class="d-flex flex-column">--}}
            {{--                                                    <h6 class="mb-1 text-dark text-sm">HubSpot</h6>--}}
            {{--                                                    <span class="text-xs">26 March 2020, at 12:30 PM</span>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                            <div--}}
            {{--                                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">--}}
            {{--                                                + $ 1,000--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex align-items-center">--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">--}}
            {{--                                                    <i--}}
            {{--                                                        class="fas fa-arrow-up"></i></button>--}}
            {{--                                                <div class="d-flex flex-column">--}}
            {{--                                                    <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>--}}
            {{--                                                    <span class="text-xs">26 March 2020, at 08:30 AM</span>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                            <div--}}
            {{--                                                class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">--}}
            {{--                                                + $ 2,500--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">--}}
            {{--                                            <div class="d-flex align-items-center">--}}
            {{--                                                <button--}}
            {{--                                                    class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">--}}
            {{--                                                    <i--}}
            {{--                                                        class="fas fa-exclamation"></i></button>--}}
            {{--                                                <div class="d-flex flex-column">--}}
            {{--                                                    <h6 class="mb-1 text-dark text-sm">Webflow</h6>--}}
            {{--                                                    <span class="text-xs">26 March 2020, at 05:00 AM</span>--}}
            {{--                                                </div>--}}
            {{--                                            </div>--}}
            {{--                                            <div class="d-flex align-items-center text-dark text-sm font-weight-bold">--}}
            {{--                                                Pending--}}
            {{--                                            </div>--}}
            {{--                                        </li>--}}
            {{--                                    </ul>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            @include('layouts.footers.auth.footer')
        </div>
        @endsection




        @push('js')
            <script src="./assets/js/plugins/chartjs.min.js"></script>
            <script>
                var ctx1 = document.getElementById("chart-line").getContext("2d");

                var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

                gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
                gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
                new Chart(ctx1, {
                    type: "line",
                    data: {
                        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        datasets: [{
                            label: "Mobile apps",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#fb6340",
                            backgroundColor: gradientStroke1,
                            borderWidth: 3,
                            fill: true,
                            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                            maxBarThickness: 6

                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#fbfbfb',
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#ccc',
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                        },
                    },
                });

                function submitEditForm(vehicleId) {
                    const form = $('#editForm_' + vehicleId);

                    $.ajax({
                        url: '{{ route('vehicle.save') }}',
                        method: 'POST',
                        data: form.serialize() + '&vehicle_id=' + vehicleId,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function () {
                            // Handle success
                            $('#editSuccessAlert').fadeIn();

                            // Close modal after a brief delay
                            setTimeout(function () {
                                $('#editModal_' + vehicleId).modal('hide');
                            }, 1500); // Adjust the delay time as needed
                        },
                        error: function (xhr, status, error) {
                            // Handle error
                            $('#editErrorAlert').modal('hide');

                        }
                    });
                }

                function openEditModal(vehicleId) {
                    // Reset modal content before opening
                    $('#editForm_' + vehicleId)[0].reset();
                    $('#editSuccessAlert').hide();
                    $('#editModal_' + vehicleId).modal('show');
                }



            </script>
    @endpush
