<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<style>
    td img {
        width: 6em;
    }
</style>
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Transaction List</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">Transaction List</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::About card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="row col-md-12">
                        <!--begin::Card title-->
                        <div class="col-md-4">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center ">
                                <div class="row" id="customerSearchBoxDiv"></div>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <div class="col-md-4">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Order" id="orderID" />
                            </div>
                            <!--end::Search-->
                        </div>

                        <!--end::Card title-->
                    </div>
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid float-end gap-0">
                        <!--begin::Flatpickr-->
                        <div class="input-group w-200px">
                            <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date" id="filter_start_date_picker" />
                        </div>
                        <div class="input-group w-200px">
                            <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date" id="filter_end_date_picker" />
                        </div>
                        <!--end::Flatpickr-->
                        <button class="btn btn-secondary today">Today</button>
                        <button class="btn btn-secondary yesterday">Yesterday</button>
                        <button class="btn btn-secondary last_week">Last Week</button>
                        <button class="btn btn-secondary last_month">Last Month</button>
                    </div>
                    <!--end::Card toolbar-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3 float-end">
                        <a href="<?= base_url('online_sales') ?>" class="btn btn-sm fw-bold btn-secondary">Reset</a>
                        <a href="javascript:;" class="btn btn-sm fw-bold btn-primary" id="searchbtn">Search</a>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Body-->
                <div class="card-body p-5 px-lg-19 py-lg-16">
                    <div class="row">
                        <div class="table-response">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="transaction-list">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Order </th>
                                        <th>Customer</th>
                                        <th>Payment Method</th>
                                        <th>Invoice Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!---->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::About card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
<script>
    const Init = {
        dataTables: () => {
            // Transaction List Datatable
            if ($.fn.DataTable.isDataTable('#transaction-list')) {
                // $('#transaction-list').dataTable().fnClearTable();
                $('#transaction-list').dataTable().fnDestroy();
            }
            $("#transaction-list").DataTable({
                language: {
                    // processing: `<img src="${siteLogo}" width="100">`,
                },
                serverSide: true,
                ajax: {
                    url: `${apiURL}new_transactionlist.php`,
                    data: {
                        'from_date': $("#filter_start_date_picker").val(),
                        'end_date': $("#filter_end_date_picker").val(),
                        'orderID': $("#orderID").val(),
                        'customer': $("#customer").val(),
                    },
                },
                columns: [{
                        data: "wp_posts.ID",
                        mRender: (data, type, full) => {
                            return `${full.index}`;
                        },
                    },
                    {
                        data: "date_created",
                        mRender: (data, type, full) => {
                            return `${full.date_created}`;
                        },
                    },
                    {
                        data: "date_created",
                        mRender: (data, type, full) => {
                            return `${full.date_time}`;
                        },
                    },
                    {
                        data: "id",
                        mRender: (data, type, full) => {
                            return `${full.id}`;
                        },
                    },
                    {
                        data: 'customer',
                        mRender: (data, type, full) => {
                            return `${full.customer}`;
                        },
                    },
                    {
                        data: 'paymentmethod',
                        mRender: (data, type, full) => {
                            return `${full.paymentmethod}`;
                        },
                    },
                    {
                        data: 'total',
                        mRender: (data, type, full) => {
                            return `${full.total}`;
                        },
                    },
                    {
                        data: null,
                        mRender: (data, type, full) => {
                            return `
                            <div class="row">
                                <div class="col-md-6">
                                    <a target="_blank" href="${siteURL}online_sales/generate_pdf?id=${full.id}" class="btn-sm btn btn-primary"><i class="fa fa-print"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn-sm btn btn-primary" onclick="sendMail(${full.id})"><i class="fa fa-envelope"></i></button>
                                </div>
                            </div>
                            `;
                        },
                    },
                ],
                dom: "Brtip",
            });
        },
        datePicker: () => {
            // Filters date picker
            flatpickr = $('#filter_start_date_picker').flatpickr({
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
            });
            flatpickr = $('#filter_end_date_picker').flatpickr({
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
            });
        },
    }

    const Events = {
        filterDate: () => {
            // On date change fire datatable reload


            $("#orderID").on("keyup", (e) => {
                if (e.key === "Enter") {

                    e.preventDefault();
                }
            })
        }
    }

    const customerSearchBox = {
        init: () => {
            $("#customerSearchBoxDiv").html(`
                <div class="w-100 position-relative mb-5">
                    <input id="customerSearchBox" type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search customer by name or email..." data-kt-search-element="input" />
                    <input type="hidden" id="customer">
                    <button class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5" onclick="customerSearchBox.clearAll()">
                        X
                    </button>
                </div>
                <div class="py-5">
                    <div id="customerResultDiv" data-kt-search-element="results">
                        <div class="d-flex float-end p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1">
                            <div class="fw-semibold">
                                <a href="javascript:void(0)" class="btn btn-flush top-50 end-0 translate-middle-y lh-0 me-5" onclick="customerSearchBox.resultHide()">
                                Hide
                                </a>
                            </div>
                        </div>
                        <div class="mh-300px scroll-y me-n5 pe-5" id="resultInnerHTML">
                        </div>
                    </div>
                    <div id="customerEmptyDiv" data-kt-search-element="empty" class="text-center">
                        <div data-kt-search-element="empty" class="text-center">
                            <div class="fw-semibold py-0 mb-10">
                                <div class="text-gray-600 fs-3 mb-2">No customer found</div>
                                <div class="text-gray-400 fs-6">Try to search by full name or email...</div>
                            </div>
                        </div>
                    </div>
                </div>
            `)
            $("#customerResultDiv").hide();
            $("#customerEmptyDiv").hide();
            customerSearchBox.inputHandler();
        },
        clear: () => {
            $(`#customerResultDiv`).hide();
            $(`#customerEmptyDiv`).hide();
            $(`#resultInnerHTML`).html('');

        },
        clearAll: () => {
            $(`#customer`).val('');
            $(`#customerResultDiv`).hide();
            $(`#customerEmptyDiv`).hide();
            $(`#resultInnerHTML`).html('');
            $("#customerSearchBox").val('')
        },

        inputHandler: () => {
            $("#customerSearchBox").on('keyup', (e) => {
                customerSearchBox.clear();
                let searchVal = $("#customerSearchBox").val();
                if (searchVal !== "" && searchVal != null && searchVal) {
                    $.ajax({
                        url: `${apiURL}getcustomer.php`,
                        type: "GET",
                        dataType: "JSON",
                        data: {
                            'term': searchVal
                        },
                        success: (result) => {
                            $(`#resultInnerHTML`).html('');
                            if (result.length > 0) {
                                $.each(result, (i, val) => {
                                    $(`#resultInnerHTML`).append(
                                        `<div class="cutomer d-flex align-items-center p-3 rounded-3 border-hover border border-dashed border-gray-300 cursor-pointer mb-1 customers" data-kt-search-element="customer" data-id="${val.id}" onclick="customerSearchBox.process(${val.id}, '${val.first_name} ${val.last_name}', '${val.user_email}')">
                                            <div class="fw-semibold">
                                                <span class="fs-6 text-gray-800 me-2">${val.first_name} ${val.last_name}</span>
                                                <span class="badge badge-light">${val.user_email}</span>
                                            </div>
                                        </div>`
                                    )
                                })
                                $(`#customerResultDiv`).show();
                            } else {
                                $(`#customerResultDiv`).hide();
                                $(`#customerEmptyDiv`).show();
                            }
                        },
                        beforeSend: () => {
                            $(`#resultInnerHTML`).html('');
                        },
                    });
                }
                if (e.key === "Enter") {
                    e.preventDefault();
                }
            })
        },
        process: (id, name, email) => {
            $("#customerSearchBox").val(`${name} - ${email}`)
            $(`#customer`).val(id);
            customerSearchBox.clear();
        },
        resultHide: () => {
            $(`#customerResultDiv`).hide();
            $(`#customerEmptyDiv`).hide();
            $(`#resultInnerHTML`).html('');
        }
    }

    const sendMail = (id) => {
        $.ajax({
            url: `${siteURL}online_sales/send_invoice_email`,
            type: "GET",
            dataType: "JSON",
            data: {
                id: id
            },
            success: (result) => {
                if (result.status == 200) {
                    toastr.success("Success", result.message);
                } else {
                    toastr.error("Error", result.message);
                }
            },
            beforeSend: () => {
                toastr.info("Information", "Please wait your request is under process");
            },
            completed: () => {}
        });
    }

    $("#searchbtn").on("click", () => {
        Init.dataTables();
    })

    $(document).ready(() => {
        Init.datePicker();
        Init.dataTables();
        Events.filterDate();
        customerSearchBox.init();
    })

    $(document).on("click", ".today", function() {
        var d = new Date();
        $('#filter_start_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        $('#filter_end_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        Init.datePicker()
    })
    $(document).on("click", ".yesterday", function() {
        var d = new Date();
        d.setDate(d.getDate() - 1);
        $('#filter_start_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        $('#filter_end_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        Init.datePicker()
    })
    $(document).on("click", ".last_week", function() {
        var d = new Date();
        d.setDate(d.getDate() - 7);
        $('#filter_start_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        var d = new Date();
        $('#filter_end_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        Init.datePicker()
    })
    $(document).on("click", ".last_month", function() {
        var d = new Date();
        $('#filter_start_date_picker').val(`${d.getFullYear()}/${d.getMonth()}/${d.getDate()}`)
        $('#filter_end_date_picker').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
        Init.datePicker()
    })
</script>
<?= $this->endSection('content') ?>