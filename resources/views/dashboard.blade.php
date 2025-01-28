@extends('falcon.master')
@section('content')
    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-1.png') }});">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative">
                    <h6>Users</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-warning"
                        data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                        {{ $usersCount }}</div><a class="fw-semi-bold fs-10 text-nowrap"
                        href="{{ route('users.index') }}">See
                        all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-2.png') }});">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative">
                    <h6>Posts</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif text-info"
                        data-countup="{&quot;endValue&quot;:23.434,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                        {{ $postsCount }}</div><a class="fw-semi-bold fs-10 text-nowrap"
                        href="{{ route('posts.index') }}">All posts<span class="fas fa-angle-right ms-1"
                            data-fa-transform="down-1"></span></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card overflow-hidden" style="min-width: 12rem">
                <div class="bg-holder bg-card"
                    style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-3.png') }});">
                </div><!--/.bg-holder-->
                <div class="card-body position-relative">
                    <h6>Views</h6>
                    <div class="display-4 fs-5 mb-2 fw-normal font-sans-serif"
                        data-countup="{&quot;endValue&quot;:43594,&quot;prefix&quot;:&quot;$&quot;}">{{ $viewsCount }}
                    </div>
                    <a class="fw-semi-bold fs-10 text-nowrap" href="index.html">Statistics<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
                                    <div class="avatar-name rounded-circle bg-primary-subtle text-dark"><span
                                            class="fs-9 text-primary">F</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link"
                                            href="#!">Falcon</a><span
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
                        href="{{ route('posts.index') }}">Show all posts<span
                            class="fas fa-chevron-right ms-1 fs-11"></span></a>
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

    <div class="row">
        <div class="col-md-6 col-xxl-4">
            <div class="card h-100">
                <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                    <h6 class="mb-2">Posts Status</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center py-0">
                    <div class="my-auto py-5 py-md-0 justify-content-center">
                        <canvas class="py-5 px-5 justify-content-center" id="pieChart" width="100%"
                            height="200px"></canvas>
                    </div>
                    <div class="border-top">
                        <table class="table table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center"><i class="fa fa-asterisk text-warning"
                                                aria-hidden="true"></i>
                                            <h6 class="text-600 mb-0 ms-2">Draft</h6>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center"><span
                                                class="fas fa-circle fs-11 me-2 text-primary"></span>
                                            <h6 class="fw-normal text-700 mb-0" id="valDraft">0%</h6>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center justify-content-end"><span
                                                class="fas fa-caret-right text-success"></span>
                                            <h6 class="fs-11 mb-0 ms-2 text-700" id="draftCount">0</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center"> <i
                                                class="fa fa-exclamation-circle text-info" aria-hidden="true"></i>
                                            <h6 class="text-600 mb-0 ms-2">Approval</h6>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center"><span
                                                class="fas fa-circle fs-11 me-2 text-success"></span>
                                            <h6 class="fw-normal text-700 mb-0" id="valApproval">0%</h6>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center justify-content-end"><span
                                                class="fas fa-caret-right text-success"></span>
                                            <h6 class="fs-11 mb-0 ms-2 text-700" id="approvalCount">0</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center"><i class="fa fa-check-circle text-success"
                                                aria-hidden="true"></i>
                                            <h6 class="text-600 mb-0 ms-2">Published</h6>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center"><span
                                                class="fas fa-circle fs-11 me-2 text-info"></span>
                                            <h6 class="fw-normal text-700 mb-0" id="valPublished">0%</h6>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center justify-content-end"><span
                                                class="fas fa-caret-right text-success"></span>
                                            <h6 class="fs-11 mb-0 ms-2 text-700" id="publishedCount">0</h6>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-body-tertiary py-2">
                    <div class="row flex-between-center g-0">
                        <div class="col-auto">
                            <select class="form-select form-select-sm" id="filter">
                                <option value="week" selected="selected">Last 7 days</option>
                                <option value="month">Last month</option>
                                <option value="year">Last Year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xxl-8">
            <div class="card h-100">
                <div class="card-header d-flex flex-between-center bg-body-tertiary py-2">
                    <h6 class="mb-2">Activities</h6>
                </div>
                <div class="card-body d-flex flex-column justify-content-center py-0">
                    <div class="my-auto  justify-content-center" style="height: 400px;">
                        <canvas class="justify-content-center" id="activityChart" width="100%"
                            ></canvas>
                    </div>
                </div>
                <div class="card-footer bg-body-tertiary py-2">
                    <div class="row flex-between-center g-0">
                        <div class="col-auto">
                            <select class="form-select form-select-sm" id="filterActivity">
                                <option value="week" selected="selected">Last 7 days</option>
                                <option value="month">Last month</option>
                                <option value="year">Last Year</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;
        let pichartInstance = null;
        let barchartInstance = null;

        loadPostChart();
        generateTop5();
        postStatus();
        loadActivityBarChart();
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
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,

                                },
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $('#top5Select').change(function(e) {
            e.preventDefault();
            generateTop5();
        });

        function generateTop5() {

            $('#top5Container').html(
                '<div class="d-flex justify-content-center mt-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
            );
            $.ajax({
                type: "post",
                url: "{{ route('dashboard.ajaxLoadTop5') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: $('#top5Select').val()
                },
                dataType: "json",
                success: function(response) {
                    $('#top5Container').html('');
                    var color = ['bg-success-subtle', 'bg-info-subtle', 'bg-warning-subtle',
                        'bg-primary-subtle', 'bg-danger-subtle'
                    ];
                    $.each(response, function(indexInArray, element) {
                        if ($('#top5Select').val() == 3) {
                            value = element.comments_count;
                        } else {
                            value = element.value;
                        }
                        var elem = value / 3000 * 100;

                        $('#top5Container').append(`
                            <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
                                <div class="col ps-x1 py-1 position-static">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl me-3">
                                            <div class="avatar-name rounded-circle ` + color[indexInArray] + ` text-dark"><span class="fs-9 text-primary"><strong>${element.title.charAt(0)}</strong></span></div>
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
                                                <div class="progress-bar rounded-pill" style="width: ` + elem + `%"></div>
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

        $('#filter').change(function(e) {
            e.preventDefault();
            postStatus();
        });

        function postStatus() {
            $.ajax({
                url: "{{ route('dashboard.ajaxLoadStatusCount') }}", // Replace with your server endpoint
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    filter: $('#filter').val()
                },
                success: function(response) {
                    var total = 0;
                    var draft = 0;
                    var approval = 0;
                    var published = 0;
                    $.each(response, function(indexInArray, value) {
                        total += value.count;
                        if (value.status == 0) {
                            draft = value.count;
                        } else if (value.status == 1) {
                            published = value.count;
                        } else {
                            approval = value.count;
                        }
                    });

                    $('#valDraft').text(((draft / total) * 100).toFixed(2) + '%');
                    $('#valApproval').text(((approval / total) * 100).toFixed(2) + '%');
                    $('#valPublished').text(((published / total) * 100).toFixed(2) + '%');

                    $('#draftCount').text(draft + ' Post(s)');
                    $('#approvalCount').text(approval + ' Post(s)');
                    $('#publishedCount').text(published + ' Post(s)');

                    var pieChart = document.getElementById('pieChart');

                    if (pichartInstance) {
                        pichartInstance.destroy();
                    }

                    pichartInstance = new Chart(pieChart, {
                        type: 'doughnut',
                        data: {
                            labels: ['Draft', 'Approval', 'Published'],
                            datasets: [{
                                label: 'Post Status',
                                data: [draft, approval, published],
                                backgroundColor: [
                                    'rgba(245, 128, 62, 1)',
                                    'rgba(39, 188, 253, 1)',
                                    'rgba(0, 210, 122, 1)'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            plugins: {
                                legend: {
                                    display: false,
                                },
                                title: {
                                    display: false,
                                },
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $('#filterActivity').change(function(e) {
            e.preventDefault();
            loadActivityBarChart();
        });

        function loadActivityBarChart() {
            $.ajax({
                url: "{{ route('dashboard.ajaxLoadActivityChart') }}", // Replace with your server endpoint
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    filter: $('#filterActivity').val()
                },
                success: function(response) {
                    var labels = [];
                    var data = [];
                    $.each(response, function(indexInArray, value) {
                        labels.push(value.event);
                        data.push(value.count);
                    });

                    var activityChart = document.getElementById('activityChart');

                    if (barchartInstance) {
                        barchartInstance.destroy();
                    }

                    const backgroundColors = [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ];

                    const borderColors = [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ];

                    barchartInstance = new Chart(activityChart, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Activities',
                                data: data,
                                backgroundColor: backgroundColors.slice(0, data.length),
                                borderColor: borderColors.slice(0, data.length),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false,
                                },
                                title: {
                                    display: false,
                                },
                            }
                        },
                    });

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });

        }
    </script>
@endsection
