@extends('layouts.contentNavbarLayout')
@section('script')
    <script src="{{ asset('assets/js/controllers/user-controller.js') }}"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="flex-grow-1">
            <h4 class="mb-4">
                User
            </h4>
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row mx-1">
                            <div
                                class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                                <div
                                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
                                    <div class="dt-buttons">
                                        <button
                                            class="dt-button btn btn-primary"
                                            tabindex="0"
                                            aria-controls="DataTables_Table_0"
                                            type="button">
                                            <span>
                                                <i class="bx bx-plus me-md-1"></i>
                                                <span class="d-md-inline-block d-none">
                                                    Create user
                                                </span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>
                                        <input
                                            type="search"
                                            class="form-control"
                                            placeholder="Search by email"
                                            aria-controls="DataTables_Table_0">
                                    </label>
                                </div>
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>
                                        <input
                                            type="search"
                                            class="form-control"
                                            placeholder="Search by full name"
                                            aria-controls="DataTables_Table_0">
                                    </label>
                                </div>
                                <div class="invoice_status mb-3 mb-md-0">
                                    <select id="UserRole" class="form-select">
                                        <option value=""> Select Status</option>
                                        <option value="Downloaded" class="text-capitalize">Downloaded</option>
                                        <option value="Draft" class="text-capitalize">Draft</option>
                                        <option value="Paid" class="text-capitalize">Paid</option>
                                        <option value="Partial Payment" class="text-capitalize">Partial Payment</option>
                                        <option value="Past Due" class="text-capitalize">Past Due</option>
                                        <option value="Sent" class="text-capitalize">Sent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table
                            id="DataTables_Table_0"
                            class="invoice-list-table table border-top dataTable no-footer dtr-column"
                            aria-describedby="DataTables_Table_0_info"
                            ng-controller="UserController">
                            <thead>
                            <tr>
                                <th tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" style="width: 50px;">
                                    #ID
                                </th>
                                <th class="" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 150px;">
                                    Full name
                                </th>
                                <th class="" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 110px;">
                                    Email
                                </th>
                                <th class="text-truncate " tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" style="width: 110px;">
                                    Gender
                                </th>
                                <th class="" rowspan="1" colspan="1" style="width: 110px;">
                                    Address
                                </th>
                                <th class="" rowspan="1" colspan="1" style="width: 110px;">
                                    Status
                                </th>
                                <th class="cell-fit" rowspan="1" colspan="1" style="width: 110px;">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-if="users" ng-repeat="item in users">
                                <td>
                                    <a href="javascript:void(0);">
                                        <span class="fw-medium">@{{ item.id }}</span>
                                    </a>
                                </td>
                                <td>
                                    <span class="fw-medium">@{{ item.full_name }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium">@{{ item.email }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium">@{{ item.gender }}</span>
                                </td>
                                <td>
                                    <span class="fw-medium">@{{ item.address }}</span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-label-success"
                                        ng-class="{'bg-label-success': item.status == 'ACTIVE', 'bg-label-warning': item.status == 'PENDING', 'bg-label-danger': item.status == 'SUSPEND'}">
                                        @{{ item.status }}
                                    </span>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
