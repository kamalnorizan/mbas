@extends('falcon.master')
@section('content')
    <div class="row">
        <div class="col-lg-6 pe-lg-2 mb-3">
            <div class="card h-lg-100 overflow-hidden">
                <div class="card-header bg-body-tertiary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">Top 5</h6>
                        </div>
                        <div class="col-auto text-center pe-x1">
                            <select class="form-select form-select-sm" id="top5Select">
                                <option selected value="1">Post Viewed</option>
                                <option value="2">Post Liked</option>
                                <option value="3">Comments</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0" id="top5Container">
                    <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col ps-x1 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <div class="avatar-name rounded-circle bg-primary-subtle text-dark"><span class="fs-9 text-primary">F</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Falcon</a><span
                                            class="badge rounded-pill ms-2 bg-200 text-primary">38%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pe-2">
                                    <div class="fs-10 fw-semi-bold">12:50:00</div>
                                </div>
                                <div class="col-5 pe-x1 ps-2">
                                    <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                        aria-valuenow="38" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar rounded-pill" style="width: 38%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2"
                        href="{{route('posts.index')}}">Show all posts<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11"
                            aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                            </path>
                        </svg><!-- <span class="fas fa-chevron-right ms-1 fs-11"></span> Font Awesome fontawesome.com --></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-2 mb-3">
            <div class="card h-lg-100">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-auto">
                            <h6 class="mb-0">Monthly Posts</h6>
                        </div>
                        <div class="col-auto d-flex"><select class="form-select form-select-sm select-month me-2">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas class="" id="totalPostChart" width="100%" height="50px"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;

        loadPostChart();
        generateTop5();

        $('.select-month').change(function(e) {
            e.preventDefault();
            loadPostChart();
        });

        function loadPostChart() {
            $.ajax({
                url: "{{ route('dashboard.ajaxLoadPostChart') }}", // Replace with your server endpoint
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    month: $('.select-month').val()
                },
                success: function(response) {
                    const ctx = document.getElementById('totalPostChart');

                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    chartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: response.labels,
                            datasets: [{
                                label: '# of Posts',
                                data: response.data,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,

                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $('#top5Select').change(function (e) {
            e.preventDefault();
            generateTop5();
        });

        function generateTop5(){

            $('#top5Container').html('<div class="d-flex justify-content-center mt-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            $.ajax({
                type: "post",
                url: "{{ route('dashboard.ajaxLoadTop5') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: $('#top5Select').val()
                },
                dataType: "json",
                success: function (response) {
                    $('#top5Container').html('');
                    var color = ['bg-success-subtle', 'bg-info-subtle', 'bg-warning-subtle', 'bg-primary-subtle', 'bg-danger-subtle' ];
                    $.each(response, function (indexInArray, element){
                        if($('#top5Select').val()==3){
                            value = element.comments_count;
                        }else{
                            value = element.value;
                        }
                        var elem = value/3000*100;

                        $('#top5Container').append(`
                            <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                                <div class="col ps-x1 py-1 position-static">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl me-3">
                                            <div class="avatar-name rounded-circle `+color[indexInArray]+` text-dark"><span class="fs-9 text-primary"><strong>${element.title.charAt(0)}</strong></span></div>
                                        </div>
                                        <div class="flex-1">
                                            <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">${element.title}</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col py-1">
                                    <div class="row flex-end-center g-0">
                                        <div class="col-auto pe-2">
                                            <div class="fs-10 fw-semi-bold">${value}</div>
                                        </div>
                                        <div class="col-5 pe-x1 ps-2">
                                            <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar"
                                                aria-valuenow="${value}" aria-valuemin="0" aria-valuemax="3000">
                                                <div class="progress-bar rounded-pill" style="width: `+elem+`%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        }
    </script>
@endsection
