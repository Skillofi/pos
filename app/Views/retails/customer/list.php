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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Customer List</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('customer') ?>" class="text-muted text-hover-primary">Customer List</a>
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
                        <a onclick="Customer.addModal()" href="javascript:;" data-bs-toggle="modal" data-bs-target="#modal" class="float-end btn btn-sm fw-bold btn-secondary">Add Customer</a>
                    </div>
                </div>
                <div class="card-body p-5 px-lg-19 py-lg-16">
                    <div class="row">
                        <div class="table-response">
                            <table class="table  table-row-bordered fs-6 gy-5 dataTable no-footer" id="customer-list">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone </th>
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
<input type="hidden" class="customer_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<script>
    const Init = {
        dataTables: () => {
            // Transaction List Datatable
            if ($.fn.DataTable.isDataTable('#customer-list')) {
                $('#customer-list').dataTable().fnClearTable();
                $('#customer-list').dataTable().fnDestroy();
            }
            $("#customer-list").DataTable({
                language: {
                    // processing: `<img src="${siteLogo}" width="100">`,
                },
                serverSide: true,
                ajax: {
                    url: `${siteURL}customer/customerJson`,
                    data: {

                    },
                },
                columns: [{
                        data: "company",
                        mRender: (data, type, full) => {
                            return (full.company) ? `${full.company}` : '-';
                        },
                    },
                    {
                        data: "name",
                        mRender: (data, type, full) => {
                            return `${full.name}`;
                        },
                    },
                    {
                        data: "email",
                        mRender: (data, type, full) => {
                            return (full.email) ? `${full.email}` : '-';
                        },
                    },
                    {
                        data: "phone",
                        mRender: (data, type, full) => {
                            return `${full.phone}`;
                        },
                    },
                    {
                        data: null,
                        mRender: (data, type, full) => {
                            return `
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" onclick="Customer.updateModal(${full.id})"><i class="fa fa-pen"></i></button>
                                    <button class="btn-sm btn btn-primary" onclick="Customer.deleteCustomer(${full.id})"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            `;
                        },
                    },
                ],
                dom: "Blrtip",
                "searching": true,
            });
        },
    }

    const Customer = {
        addModal: () => {
            $.ajax({
                url: `${siteURL}customer/add_customer`,
                type: "GET",
                dataType: "HTML",
                data: {},
                success: (result) => {
                    toastr.clear()
                    $("#modal-content").html(result)
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                }
            });
        },
        updateModal: (id) => {
            $.ajax({
                url: `${siteURL}customer/update_customer`,
                type: "GET",
                dataType: "HTML",
                data: {
                    id: id
                },
                success: (result) => {
                    toastr.clear()
                    $("#modal-content").html(result)
                },
                beforeSend: () => {
                    toastr.info("Information", "Please wait your request is under process");
                }
            });
        },

        addCustomer: (data) => {
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $.ajax({
                url: `${siteURL}customer/add_customer`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    'name': data.name,
                    'phone': data.phone,
                    'email': data.email,
                    'company': data.company,
                    'address': data.address,
                    'city': data.city,
                    'state': data.state,
                    'postal_code': data.postal_code,
                    'country': data.country,
                },
                success: (result) => {
                    toastr.clear()
                    if (result.status == 200) {
                        toastr.success("Success", result.message);
                        Init.dataTables();
                        $("#modal").modal('hide');
                        $("#modal-content").html('');
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
        },

        updateCustomer: (data) => {
            console.log(data)
            var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.txt_csrfname').val(); // CSRF hash
            $.ajax({
                url: `${siteURL}customer/update_customer`,
                type: "POST",
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    id: data.id,
                    'name': data.name,
                    'phone': data.phone,
                    'email': data.email,
                    'company': data.company,
                    'address': data.address,
                    'city': data.city,
                    'state': data.state,
                    'postal_code': data.postal_code,
                    'country': data.country,
                },
                success: (result) => {
                    toastr.clear()
                    if (result.status == 200) {
                        toastr.success("Success", result.message);
                        Init.dataTables();
                        $("#modal").modal('hide');
                        $("#modal-content").html('');
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
        },
        deleteCustomer: (id) => {
            Swal.fire({
                html: `You won't be able to recover this customer`,
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
                        url: `${siteURL}customer/delete_customer`,
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
                                $("#modal").modal('hide');
                                $("#modal-content").html('');
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

    $(document).ready(() => {
        Init.dataTables();

    })
</script>
<?= $this->endSection('content') ?>