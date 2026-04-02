@extends('layouts.app')

@section('title', 'Finance Dashboard')

@section('page-title')
<div class="page-title-head d-flex align-items-center">
    <div class="flex-grow-1">
        <h4 class="page-main-title m-0">Finance</h4>
    </div>
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Paces</a></li>
            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
            <li class="breadcrumb-item active">Finance</li>
        </ol>
    </div>
</div>
@endsection

@section('content')

{{-- Alert --}}
<div class="alert alert-primary alert-dismissible d-flex align-items-center" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <i class="ti ti-lifebuoy fs-24 me-1"></i>
    <div>
        <strong> Dear David Dev - </strong>
        We kindly encourage you to review your recent transactions and financial commitments to ensure that your account is in good standing.
    </div>
    <a href="#!" class="text-reset text-decoration-underline ms-auto link-offset-2"><b>Action Now</b></a>
</div>

{{-- Row 1: Balance + Stats --}}
<div class="row">
    <div class="col-xxl-4">
        <div class="card card-h-100">
            <div class="card-header border-0 justify-content-between">
                <h4 class="card-title">Total Balance</h4>
                <div class="dropdown ms-auto">
                    <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical fs-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="ti ti-wallet me-2"></i> Add Funds</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-cash-banknote-move-back me-2"></i> Withdraw Funds</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-transaction-dollar me-2"></i> Transaction History</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="ti ti-lock me-2"></i> Freeze Account</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body pt-0">
                <h2 class="fw-bold" id="user-balance-data">
                    <span id="user-balance-number">$76,852.36</span>
                    <span data-toggler="off" id="user-b-show-hide">
                        <a href="#" data-toggler-on class="d-none">
                            <i class="ti ti-eye text-warning fs-xxl"></i>
                        </a>
                        <a href="#" data-toggler-off>
                            <i class="ti ti-eye-off text-muted fs-xxl"></i>
                        </a>
                    </span>
                </h2>

                <div class="p-2 bg-light bg-opacity-50 rounded mt-3 gap-2 d-flex align-items-center">
                    <img src="assets/images/debit-card.png" alt="" height="36" class="rounded me-1" />
                    <div>
                        <p class="mb-0 fw-semibold">$<span data-target="59,258.25">0</span></p>
                        <p class="text-muted fs-12 mb-0">**** **** **** 3698</p>
                    </div>
                    <a href="#!" class="btn btn-link fw-medium text-reset ms-auto text-decoration-underline link-offset-2">Details</a>
                </div>

                <div class="row g-2 mt-3">
                    <div class="col">
                        <a href="#!" class="btn btn-secondary bg-gradient w-100"><i class="ti ti-coin me-1"></i> Transfer</a>
                    </div>
                    <div class="col">
                        <a href="#!" class="btn btn-info bg-gradient w-100"><i class="ti ti-coin me-1"></i> Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->

    <div class="col-xxl-8">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <iconify-icon icon="solar:leaf-bold-duotone" class="fs-36 text-success"></iconify-icon>
                        <h3 class="fw-bold mt-3 mb-1">$<span data-target="51.68">0</span>k</h3>
                        <p class="text-muted">Total Income</p>
                        <span class="badge fs-12 badge-soft-success"><i class="ti ti-arrow-badge-up"></i> 8.72%</span>
                        <div id="total-income-chart" class="mt-3"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <iconify-icon icon="solar:wallet-money-bold-duotone" class="fs-36 text-info"></iconify-icon>
                        <h3 class="fw-bold mt-3 mb-1">$<span data-target="24.03">0</span>k</h3>
                        <p class="text-muted">Total Expenses</p>
                        <span class="badge fs-12 badge-soft-danger"><i class="ti ti-arrow-badge-down"></i> 3.28%</span>
                        <div id="total-expenses-chart" class="mt-3"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <iconify-icon icon="solar:chart-2-bold-duotone" class="fs-36 text-warning"></iconify-icon>
                        <h3 class="fw-bold mt-3 mb-1">$<span data-target="48.21">0</span>k</h3>
                        <p class="text-muted">Investments</p>
                        <span class="badge fs-12 badge-soft-danger"><i class="ti ti-arrow-badge-down"></i> 5.69%</span>
                        <div id="investments-chart" class="mt-3"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <iconify-icon icon="solar:hand-money-bold" class="fs-36 text-secondary"></iconify-icon>
                        <h3 class="fw-bold mt-3 mb-1">$<span data-target="11.65">0</span>k</h3>
                        <p class="text-muted">Savings</p>
                        <span class="badge fs-12 badge-soft-success"><i class="ti ti-arrow-badge-up"></i> 10.58%</span>
                        <div id="savings-chart" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

{{-- Row 2: Financial Overview + Quick Transfer --}}
<div class="row">
    <div class="col-xl-8">
        <div class="card card-h-100">
            <div class="card-header border-0 justify-content-between">
                <h4 class="card-title">Financial Overview</h4>
                <div class="dropdown ms-auto">
                    <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical fs-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="ti ti-refresh me-2"></i> Refresh Data</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-chart-bar me-2"></i> View Analytics</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ti ti-filter-2 me-2"></i> Filter Report</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="ti ti-download me-2"></i> Export Data</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="bg-light bg-opacity-40">
                    <div class="row text-center">
                        <div class="col">
                            <p class="text-muted mt-3 mb-1">Revenue</p>
                            <h4 class="mb-3">
                                <span class="ti ti-square-rounded-arrow-down text-success me-1"></span>
                                <span>$<span data-target="29.56">0</span>k</span>
                            </h4>
                        </div>
                        <div class="col">
                            <p class="text-muted mt-3 mb-1">Expenses</p>
                            <h4 class="mb-3">
                                <span class="ti ti-square-rounded-arrow-up text-danger me-1"></span>
                                <span>$<span data-target="15.08">0</span>k</span>
                            </h4>
                        </div>
                        <div class="col">
                            <p class="text-muted mt-3 mb-1">Investment</p>
                            <h4 class="mb-3">
                                <span class="ti ti-chart-infographic me-1"></span>
                                <span>$<span data-target="3.67">0</span>k</span>
                            </h4>
                        </div>
                        <div class="col">
                            <p class="text-muted mt-3 mb-1">Savings</p>
                            <h4 class="mb-3">
                                <span class="ti ti-pig me-1"></span>
                                <span>$<span data-target="6.72">0</span>k</span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <div dir="ltr">
                        <div id="financial-overview-chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card bg-secondary bg-gradient">
            <div class="card-body"
                style="background-image: url(assets/images/flower-style.svg); background-size: contain; background-repeat: no-repeat; background-position: right bottom">
                <h4 class="text-white">Investment Growth</h4>
                <p class="text-white text-opacity-75">Track performance and see where your money is heading.</p>
                <a href="#!" class="btn btn-sm rounded-pill btn-info bg-gradient">View Portfolio</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header justify-content-between">
                <h4 class="card-title">
                    Quick Transfer
                    <i class="ti ti-info-octagon text-muted ms-1" data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-title="Quickly send money to your saved contacts."></i>
                </h4>
                <div class="dropdown ms-auto">
                    <a href="#" class="btn btn-sm btn-default btn-icon" data-bs-toggle="dropdown">
                        <i class="ti ti-dots-vertical fs-lg"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#!" class="dropdown-item"><span class="me-2 ti ti-user-plus"></span> Add Recipient</a>
                        <a href="#!" class="dropdown-item"><span class="me-2 ti ti-history"></span> Recent Transfers</a>
                        <a href="#!" class="dropdown-item"><span class="me-2 ti ti-download"></span> Export Transfers</a>
                        <a href="#!" class="dropdown-item text-danger"><span class="me-2 ti ti-trash"></span> Remove All</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2 justify-content-center">
                    <input type="radio" class="btn-check" name="recipient" id="rec1" autocomplete="off" checked />
                    <label class="avatar-label" for="rec1" data-bs-toggle="tooltip" data-bs-title="Alexa Newsome">
                        <img src="assets/images/users/user-4.jpg" alt="" class="rounded-circle img-thumbnail avatar-lg" />
                    </label>
                    <input type="radio" class="btn-check" name="recipient" id="rec2" autocomplete="off" />
                    <label class="avatar-label" for="rec2" data-bs-toggle="tooltip" data-bs-title="Shelly Dorey">
                        <img src="assets/images/users/user-5.jpg" alt="" class="rounded-circle img-thumbnail avatar-lg" />
                    </label>
                    <input type="radio" class="btn-check" name="recipient" id="rec3" autocomplete="off" />
                    <label class="avatar-label" for="rec3" data-bs-toggle="tooltip" data-bs-title="Fredrick Arnett">
                        <img src="assets/images/users/user-3.jpg" alt="" class="rounded-circle img-thumbnail avatar-lg" />
                    </label>
                    <input type="radio" class="btn-check" name="recipient" id="rec4" autocomplete="off" />
                    <label class="avatar-label" for="rec4" data-bs-toggle="tooltip" data-bs-title="Barbara Frink">
                        <img src="assets/images/users/user-8.jpg" alt="" class="rounded-circle img-thumbnail avatar-lg" />
                    </label>
                    <input type="radio" class="btn-check" name="recipient" id="rec5" autocomplete="off" />
                    <label class="avatar-label" for="rec5" data-bs-toggle="tooltip" data-bs-title="Adam M">
                        <img src="assets/images/users/user-2.jpg" alt="" class="rounded-circle img-thumbnail avatar-lg" />
                    </label>
                </div>

                <div class="my-3">
                    <label for="sendFrom" class="form-label">Send From</label>
                    <select id="sendFrom" class="form-select">
                        <option value="visa">Visa •••• 3698</option>
                        <option value="mastercard">Mastercard •••• 1425</option>
                        <option value="paypal">PayPal Wallet</option>
                    </select>
                </div>

                <div class="row g-3 mb-2">
                    <div class="col-12 col-md-6">
                        <label for="currency" class="form-label">Currency</label>
                        <select id="currency" class="form-select">
                            <option value="USD">$ USD — US Dollar</option>
                            <option value="EUR">€ EUR — Euro</option>
                            <option value="GBP">£ GBP — British Pound</option>
                            <option value="INR">₹ INR — Indian Rupee</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="enterAmount" class="form-label">Amount</label>
                        <input type="number" id="enterAmount" class="form-control" placeholder="0.00" min="1" step="0.01" />
                    </div>
                </div>

                <div class="row g-2 mt-3">
                    <div class="col">
                        <a href="#!" class="btn btn-primary w-100">Send Money</a>
                    </div>
                    <div class="col">
                        <a href="#!" class="btn btn-outline-secondary w-100">Save as Draft</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

{{-- Row 3: Recent Transactions Table --}}
<div class="row">
    <div class="col-12">
        <div data-table data-table-rows-per-page="8" class="card">
            <div class="card-header border-light justify-content-between">
                <h4 class="card-title">
                    Recent Transactions
                    <span class="text-muted fw-normal fs-14">(95.6k+ Transactions)</span>
                </h4>
                <div class="d-flex align-items-center gap-2">
                    <span class="me-2 fw-semibold">Filter By:</span>
                    <div class="app-search">
                        <select data-table-filter="transaction-status" class="form-select form-control my-1 my-md-0">
                            <option value="All">All Status</option>
                            <option value="Success">Success</option>
                            <option value="Pending">Pending</option>
                            <option value="Failed">Failed</option>
                            <option value="Processing">Processing</option>
                            <option value="Onhold">On Hold</option>
                        </select>
                        <i class="ti ti-filter-2 app-search-icon text-muted"></i>
                    </div>
                    <div class="app-search">
                        <input data-table-search type="search" class="form-control" placeholder="Search transactions..." />
                        <i class="ti ti-search app-search-icon text-muted"></i>
                    </div>
                    <div>
                        <select data-table-set-rows-per-page class="form-select form-control my-1 my-md-0">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom table-nowrap table-centered table-select table-hover w-100 mb-0">
                    <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                        <tr class="text-uppercase fs-xxs">
                            <th data-table-sort class="text-muted">ID</th>
                            <th data-table-sort class="text-muted">Name / Business</th>
                            <th class="text-muted">Description</th>
                            <th data-table-sort class="text-muted">Amount</th>
                            <th data-table-sort class="text-muted">Timestamp</th>
                            <th data-table-sort class="text-muted">Type</th>
                            <th data-table-sort class="text-muted">Payment Method</th>
                            <th data-table-sort data-column="transaction-status" class="text-muted">Status</th>
                            <th class="text-muted">•••</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#!" class="fw-medium text-reset">#TX901</a></td>
                            <td>
                                <img src="assets/images/users/user-5.jpg" alt="" class="avatar-xs rounded-circle me-1" />
                                <span class="align-middle text-reset">Sophia Miller</span>
                            </td>
                            <td>Subscription Renewal</td>
                            <td class="text-success">USD $299.00</td>
                            <td>22 Nov,25 <small class="text-muted">08:24 am</small></td>
                            <td>Credit</td>
                            <td><img src="assets/images/cards/visa.svg" height="24" class="me-1" /> *4321</td>
                            <td><span class="badge bg-success-subtle text-success p-1">Success</span></td>
                            <td><a href="#!" class="text-muted fs-20"><i class="ti ti-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#!" class="fw-medium text-reset">#TX900</a></td>
                            <td>
                                <img src="assets/images/users/user-2.jpg" alt="" class="avatar-xs rounded-circle me-1" />
                                <span class="align-middle">James Carter</span>
                            </td>
                            <td>Refund Processed</td>
                            <td class="text-danger">-USD $150.50</td>
                            <td>21 Nov,25 <small class="text-muted">07:40 pm</small></td>
                            <td>Debit</td>
                            <td><img src="assets/images/cards/mastercard.svg" height="24" class="me-1" /> *9333</td>
                            <td><span class="badge bg-warning-subtle text-warning p-1">Pending</span></td>
                            <td><a href="#!" class="text-muted fs-20"><i class="ti ti-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#!" class="fw-medium text-reset">#TX899</a></td>
                            <td>
                                <div class="avatar-xs d-inline-block me-1">
                                    <span class="avatar-title bg-secondary-subtle text-secondary fw-semibold rounded-circle">W</span>
                                </div>
                                WavePay
                            </td>
                            <td>Wallet Top-Up</td>
                            <td class="text-success">USD $620.00</td>
                            <td>21 Nov,25 <small class="text-muted">03:12 pm</small></td>
                            <td>Credit</td>
                            <td><img src="assets/images/cards/paypal.svg" height="24" class="me-1" /> PayPal</td>
                            <td><span class="badge bg-success-subtle text-success p-1">Success</span></td>
                            <td><a href="#!" class="text-muted fs-20"><i class="ti ti-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#!" class="fw-medium text-reset">#TX898</a></td>
                            <td>
                                <img src="assets/images/users/user-3.jpg" alt="" class="avatar-xs rounded-circle me-1" />
                                <span class="align-middle">Liam Thompson</span>
                            </td>
                            <td>Service Charge</td>
                            <td class="text-danger">-USD $19.99</td>
                            <td>20 Nov,25 <small class="text-muted">11:09 am</small></td>
                            <td>Debit</td>
                            <td><img src="assets/images/cards/stripe.svg" height="24" class="me-1" /> Stripe</td>
                            <td><span class="badge bg-danger-subtle text-danger p-1">Failed</span></td>
                            <td><a href="#!" class="text-muted fs-20"><i class="ti ti-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#!" class="fw-medium text-reset">#TX897</a></td>
                            <td>
                                <img src="assets/images/users/user-4.jpg" alt="" class="avatar-xs rounded-circle me-1" />
                                <span class="align-middle">Emma Stone</span>
                            </td>
                            <td>Invoice #2112</td>
                            <td class="text-success">EUR €420.72</td>
                            <td>18 Nov,25 <small class="text-muted">09:51 pm</small></td>
                            <td>Credit</td>
                            <td><img src="assets/images/cards/mastercard.svg" height="24" class="me-1" /> *2112</td>
                            <td><span class="badge bg-success-subtle text-success p-1">Success</span></td>
                            <td><a href="#!" class="text-muted fs-20"><i class="ti ti-eye"></i></a></td>
                        </tr>
                        <tr>
                            <td><a href="#!" class="fw-medium text-reset">#TX889</a></td>
                            <td>
                                <img src="assets/images/users/user-3.jpg" alt="" class="avatar-xs rounded-circle me-1" />
                                <span class="align-middle">Emily Frost</span>
                            </td>
                            <td>Client Invoice #2455</td>
                            <td class="text-success">USD $980.00</td>
                            <td>09 Nov,24 <small class="text-muted">11:21 am</small></td>
                            <td>Credit</td>
                            <td><img src="assets/images/cards/paypal.svg" height="24" class="me-1" /> PayPal</td>
                            <td><span class="badge bg-success-subtle text-success p-1">Success</span></td>
                            <td><a href="#!" class="text-muted fs-20"><i class="ti ti-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div data-table-pagination-info="transactions"></div>
                    <div data-table-pagination></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

{{-- Row 4: Targets & Goals --}}
<div class="d-flex align-items-center mb-3 mt-2">
    <h4 class="fw-bold fs-md">My Targets &amp; Goals</h4>
    <a href="#!" class="text-decoration-underline fw-semibold fs-15 ms-auto link-offset-2 link-dark">See All</a>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-5">
    <div class="col">
        <div class="card border-0 rounded-3 text-white"
            style="background-image: url(assets/images/stock/small-1.jpg); background-size: cover">
            <div class="card-body bg-gradient bg-primary bg-opacity-90 rounded-3">
                <iconify-icon icon="solar:bus-bold-duotone" class="fs-36"></iconify-icon>
                <p class="text-white text-opacity-75 mb-1 text-uppercase">Goal</p>
                <h3 class="fw-semibold mb-2 fs-20 text-white">New Car</h3>
                <h4 class="fw-medium fs-16 mb-1 text-white">$<span data-target="25000">0</span></h4>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-0 rounded-3 text-white"
            style="background-image: url(assets/images/stock/small-2.jpg); background-size: cover">
            <div class="card-body bg-gradient bg-secondary bg-opacity-90 rounded-3">
                <iconify-icon icon="solar:globus-bold-duotone" class="fs-36"></iconify-icon>
                <p class="text-white text-opacity-75 mb-1 text-uppercase">Goal</p>
                <h3 class="fw-semibold mb-2 fs-20 text-white">Vacation Trip</h3>
                <h4 class="fw-medium fs-16 mb-1 text-white">$<span data-target="7500">0</span></h4>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-0 rounded-3 text-white"
            style="background-image: url(assets/images/stock/small-3.jpg); background-size: cover">
            <div class="card-body bg-gradient bg-warning bg-opacity-90 rounded-3">
                <iconify-icon icon="solar:square-academic-cap-2-bold-duotone" class="fs-36"></iconify-icon>
                <p class="text-white text-opacity-75 mb-1 text-uppercase">Goal</p>
                <h3 class="fw-semibold mb-2 fs-20 text-white">Education</h3>
                <h4 class="fw-medium fs-16 mb-1 text-white">$<span data-target="15200">0</span></h4>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-0 rounded-3 text-white"
            style="background-image: url(assets/images/stock/small-4.jpg); background-size: cover">
            <div class="card-body bg-gradient bg-danger bg-opacity-90 rounded-3">
                <iconify-icon icon="solar:home-2-bold-duotone" class="fs-36"></iconify-icon>
                <p class="text-white text-opacity-75 mb-1 text-uppercase">Goal</p>
                <h3 class="fw-semibold mb-2 fs-20 text-white">New Home</h3>
                <h4 class="fw-medium fs-16 mb-1 text-white">$<span data-target="120000">0</span></h4>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card border-0 rounded-3 text-white"
            style="background-image: url(assets/images/stock/small-5.jpg); background-size: cover">
            <div class="card-body bg-gradient bg-info bg-opacity-90 rounded-3">
                <iconify-icon icon="solar:banknote-2-bold-duotone" class="fs-36"></iconify-icon>
                <p class="text-white text-opacity-75 mb-1 text-uppercase">Goal</p>
                <h3 class="fw-semibold mb-2 fs-20 text-white">Emergency Fund</h3>
                <h4 class="fw-medium fs-16 mb-1 text-white">$<span data-target="10000">0</span></h4>
            </div>
        </div>
    </div>
</div>
<!-- end row-->

@endsection

@push('scripts')
<script src="assets/js/pages/dashboard-finance.js"></script>
@endpush
