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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Sales List</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('retail_sales') ?>" class="text-muted text-hover-primary">Sales List</a>
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
                <!--begin::Body-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="col-md-12">
                        <a href="<?= base_url('retail_sales') ?>" class="float-end btn btn-sm fw-bold btn-secondary">Add Sales</a>
                    </div>
                </div>
                <div class="card-body p-5 px-lg-19 py-lg-16">
                    <div class="row">
                        <div class="table-response">
                            <table class="table  table-row-bordered fs-6 gy-5 dataTable no-footer" id="sales-list">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Reference no</th>
                                        <th>Date Time</th>
                                        <th>Customer</th>
                                        <th>Invoice Total</th>
                                        <th>Paid</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

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
<input type="hidden" class="sales_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<script>
    const Init = {
        dataTables: () => {
            // Transaction List Datatable
            if ($.fn.DataTable.isDataTable('#sales-list')) {
                $('#sales-list').dataTable().fnClearTable();
                $('#sales-list').dataTable().fnDestroy();
            }
            $("#sales-list").DataTable({
                language: {
                    // processing: `<img src="${siteLogo}" width="100">`,
                },
                serverSide: true,
                order: [
                    [0, 'desc']
                ],
                "searching": true,
                ajax: {
                    url: `${siteURL}retail_sales/salesJson`,
                    data: {

                    },
                },
                columns: [{
                        data: "sales.id",
                        mRender: (data, type, full) => {
                            return `${full.id}`;
                        },
                    },
                    {
                        data: "sales.reference_no",
                        mRender: (data, type, full) => {
                            return `RF-${full.reference_no}`;
                        },
                    },
                    {
                        data: "sales.date_time",
                        mRender: (data, type, full) => {
                            return `${full.date_time}`;
                        },
                    },
                    {
                        data: "customer.name",
                        mRender: (data, type, full) => {
                            return `${full.name}`;
                        },
                    },
                    {
                        data: "sales.grand_total",
                        mRender: (data, type, full) => {
                            return `$${Init.formateAmount(full.grand_total)}`;
                        },
                    },
                    {
                        data: "sales.grand_total",
                        mRender: (data, type, full) => {
                            return `$${Init.formateAmount(full.paid_amount)}`;
                        },
                    },
                    {
                        data: "sales.grand_total",
                        mRender: (data, type, full) => {
                            return `$${Init.formateAmount(full.balance)}`;
                        },
                    },
                    {
                        data: null,
                        mRender: (data, type, full) => {
                            return `

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="${siteURL}retail_sales/sales_details/${full.id}" class="btn btn-icon btn-neutral btn-icon-mini" ><i class="fa fa-eye"></i></a>
                                    <a href="${siteURL}${full.invoice}" title="invoice" target="_blank" class="btn btn-icon btn-neutral btn-icon-mini" ><i class="fa fa-file"></i></a>
                                    <a href="${siteURL}retail_sales/edit_sale/${full.id}" title="Edit" class="btn btn-icon btn-neutral btn-icon-mini" ><i class="fa fa-pen"></i></a>
                                    <button class="btn btn-icon btn-neutral btn-icon-mini" title="Delete" onclick="deleteSales(${full.id})"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            `;
                        },
                    },
                ],
                dom: "Bfrtips",
                "searching": true,
            });
        },
        formateAmount: (val) => {
            return (parseFloat(val)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }
    }

    $(document).ready(() => {
        Init.dataTables();
    })

    const deleteSales = (id = 0) => {
        if (id) {
            Swal.fire({
                html: `You won't be able to recover this sales and its details`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: 'Nope, cancel it',
                confirmButtonText: "Yes, delete it",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then(function(data) {

                if (data.isConfirmed) {
                    $.ajax({
                        url: `${siteURL}retail_sales/delete_sales`,
                        type: "get",
                        dataType: "json",
                        data: {
                            id: id,
                        },
                        success: (result) => {
                            toastr.clear()
                            if (result.status == 200) {
                                toastr.success("Success", result.message);
                                Init.dataTables();
                            } else {
                                toastr.danger("Error", result.message);
                            }
                        },
                        beforeSend: () => {
                            toastr.info("Information", "Please wait your request is under process");
                        },
                        onError: () => {
                            toastr.danger("Error", "Something went wrong");

                        }
                    });
                }
            });
        }
    }
</script>
<?= $this->endSection('content') ?>