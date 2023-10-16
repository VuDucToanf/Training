@extends('layouts.contentNavbarLayout')
@section('script')
    <script src="{{ asset('assets/js/controllers/user-controller.js') }}"></script>
@endsection
@section('content')
    <div class="content-wrapper" ng-controller="UserController">
        <div class="flex-grow-1">
            <h4 class="mb-4">
                User
            </h4>
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row mx-1">
                            <div
                                class="col-12 col-md-3 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                                <div
                                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
                                    <div class="dt-buttons">
                                        <button
                                            class="dt-button btn btn-primary"
                                            tabindex="0"
                                            aria-controls="DataTables_Table_0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#basicModal"
                                            ng-click="showModalUser()"
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
                                class="col-12 col-md-9 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>
                                        <input
                                            id="search-email"
                                            type="search"
                                            class="form-control"
                                            placeholder="Search by email"
                                            aria-controls="DataTables_Table_0">
                                    </label>
                                </div>
                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                    <label>
                                        <input
                                            id="search-full_name"
                                            type="search"
                                            class="form-control"
                                            placeholder="Search by full name"
                                            aria-controls="DataTables_Table_0">
                                    </label>
                                </div>
                                <div class="invoice_status mb-3 mb-md-0">
                                    <select id="UserStatus" class="form-select">
                                        <option value=""> Select Status</option>
                                        <option value="PENDING" class="text-capitalize">PENDING</option>
                                        <option value="ACTIVE" class="text-capitalize">ACTIVE</option>
                                        <option value="SUSPEND" class="text-capitalize">SUSPEND</option>
                                    </select>
                                </div>
                                <div class="invoice_gender mb-3 mb-md-0">
                                    <select id="UserGender" class="form-select">
                                        <option value=""> Select Gender</option>
                                        <option value="MALE" class="text-capitalize">MALE</option>
                                        <option value="FEMALE" class="text-capitalize">FEMALE</option>
                                    </select>
                                </div>
                                <div
                                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
                                    <a
                                        href="javascript:void(0);"
                                        ng-click="reset()"
                                        class="btn btn-secondary">
                                        Reset
                                    </a>
                                </div>
                                <div
                                    class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
                                    <a
                                        href="javascript:void(0);"
                                        ng-click="search()"
                                        class="btn btn-primary btn-buy-now">
                                        Search
                                    </a>
                                </div>
                            </div>
                        </div>
                        <table
                            id="DataTables_Table_0"
                            class="invoice-list-table table border-top dataTable no-footer dtr-column"
                            aria-describedby="DataTables_Table_0_info"
                            ng-class="isLoading ? 'show' : 'hidden'">
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
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a
                                            href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/invoice/preview"
                                            class="text-body border-light-primary pr-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#basicModal"
                                            ng-click="showModalUser(item)"
                                            aria-label="Edit Invoice" data-bs-original-title="Edit Invoice">
                                            <i class="bx bx-edit-alt mx-1"></i>
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div
                            class="row mx-2"
                            ng-class="isLoading ? 'show' : 'hidden'">
                            <div class="col-sm-12 col-lg-6">
                                <div
                                    class="dataTables_info"
                                    id="DataTables_Table_0_info"
                                    role="status"
                                    aria-live="polite">
                                    Showing @{{ ((params.page_id - 1) * params.page_size + 1) }} to
                                    @{{ params.page_size }} of @{{ total }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div
                                    id="DataTables_Table_0_paginate"
                                    class="dataTables_paginate paging_simple_numbers"
                                    ng-if="params.page_id && total > params.page_size"
                                    style="padding-right: 40px;">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item"
                                            ng-disabled="isLoading"
                                            ng-class="(page == params.page_id) ? 'active' : ''"
                                            ng-repeat="page in pageList">
                                            <a
                                                href="#"
                                                aria-controls="DataTables_Table_0"
                                                role="link" aria-current="page"
                                                data-dt-idx="0" tabindex="0"
                                                ng-click="params.page_id = page;find()"
                                                class="page-link">
                                                @{{ page }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.modal-form-user')
    </div>
@endsection
