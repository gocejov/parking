@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Your Settings</h6>
                        <p class="text-xs text-secondary mb-0">
                            {{auth()->user()->firstname . ' '. auth()->user()->lastname}}</p>
                    </div>
                    @csrf
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">
                                        Phone number
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">
                                        License Plate Number
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">
                                        Park Time
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-9">
                                        Location
                                    </th>
                                    <th class="text-secondary opacity-9"></th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($userSettings as $usrSet)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$usrSet->phone_number}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="text-xs font-weight-bold mb-0">{{$usrSet->license_plate}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-xs font-weight-bold mb-0">{{$usrSet->default_park_time}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold mb-0">{{$usrSet->location}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{route('edit', $usrSet->id)}}"
                                               class="btn btn-warning rounded-l-full font-weight-bold text-xs"
                                               data-toggle="tooltip" data-original-title="Edit">
                                                Edit setting
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

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
    </script>
@endpush
