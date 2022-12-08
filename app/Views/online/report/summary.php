<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<?php $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY); ?>
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #section-to-print,
        #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Transaction Summary</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">POS Summary</a>
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
                <div class="">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid gap-5">
                            <!--begin::Flatpickr-->
                            <div class="input-group w-700px">
                                <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date" id="kt_ecommerce_sales_flatpickr" value="<?= (isset($_GET['date'])) ? $_GET['date'] : '' ?>" />

                            </div>
                            <form>
                                <input type="hidden" id="search" name="date" value="<?= (isset($_GET['date'])) ? $_GET['date'] : '' ?>" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </form>
                            <!--end::Flatpickr-->
                        </div>
                        <!--end::Card toolbar-->
                        <script>
                            $("#kt_ecommerce_sales_flatpickr").on("change", function() {
                                $("#pdf").val($(this).val())
                                $("#search").val($(this).val())
                            })
                        </script>
                        <div class="card-toolbar flex-row-fluid gap-5 justify-content-end">
                            <!--begin::Flatpickr-->
                            <button data-bs-toggle="modal" data-bs-target="#modal-summary" class="btn btn-primary"><i class="fa fa-envelope"></i></button>
                            <form action="<?= base_url('online_report/summary_pdf') ?>" target="_blank">
                                <input type="hidden" id="pdf" name="date" value="<?= (isset($_GET['date'])) ? $_GET['date'] : '' ?>" />

                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
                            </form>

                            <!--end::Flatpickr-->
                        </div>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Body-->
                <div class="card-body p-5 px-lg-19 py-lg-16" id="section-to-print">
                    <div class="row">
                        <center>
                            <h3>POS Summary</h3>
                            From <?= $data['fromDate'] ?> To <?= $data['endDate'] ?>
                        </center>
                        <div class="table-response">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover ng-star-inserted">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Sales Report</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales</td>
                                        <td><?= $formatter->formatCurrency(($data['total_sale']) ? $data['total_sale'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td><?= $formatter->formatCurrency(($data['total_discount']) ? $data['total_discount'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Refund</td>
                                        <td><?= $formatter->formatCurrency(($data['total_refund']) ? $data['total_refund'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td><?= $formatter->formatCurrency(($data['total_shipping']) ? $data['total_shipping'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td><?= $formatter->formatCurrency(($data['total_tax']) ? $data['total_tax'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Fee</td>
                                        <td><?= $formatter->formatCurrency(($data['total_fee']) ? $data['total_fee'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><?= $formatter->formatCurrency(($data['order_total']) ? $data['order_total'] : 0, 'USD') ?></td>
                                    </tr>
                                </tbody>
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Payment Gateway</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>POS Card</td>
                                        <td><?= $formatter->formatCurrency(($data['pos_card']) ? $data['pos_card'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>POS Checks</td>
                                        <td><?= $formatter->formatCurrency(($data['pos_check']) ? $data['pos_check'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>POS CASH</td>
                                        <td><?= $formatter->formatCurrency(($data['pos_cash']) ? $data['pos_cash'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>PAYPAL</td>
                                        <td><?= $formatter->formatCurrency(($data['paypal']) ? $data['paypal'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>WEBSITE CREDITCARD</td>
                                        <td><?= $formatter->formatCurrency(($data['creditcard']) ? $data['creditcard'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ebay Card Payment</td>
                                        <td><?= $formatter->formatCurrency(($data['others']) ? $data['others'] : 0, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><?= $formatter->formatCurrency(($data['order_total']) ? $data['order_total'] : 0, 'USD') ?></td>
                                    </tr>
                                </tbody>
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Numbers</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Number of Order Total</td>
                                        <td><?= ($data['orders_count']) ? $data['orders_count'] : 0 ?></td>
                                    </tr>
                                    <tr>
                                        <td>Number of Total Item Sold</td>
                                        <td><?= ($data['items_count']) ? $data['items_count'] : 0 ?></td>
                                    </tr>
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
<div class="modal" tabindex="-1" id="modal-summary">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" id="modal-content">
            <form method="post" action="<?= base_url('online_report/mail_pdf_report') ?>">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Send Report</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="fv-row mb-8">
                        <input type="hidden" id="date" name="date" value="<?= (isset($_GET['date'])) ? $_GET['date'] : '' ?>">
                        <!--begin::Email-->
                        <input type="email" placeholder="Email Address" id="email" name="email" autocomplete="off" class="form-control bg-transparent" required />
                        <!--end::Email-->
                        <span class="text-danger email-error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const element = $("#kt_ecommerce_sales_flatpickr");
    var d = new Date();
    const Init = {
        datePicker: () => {
            // $element.val(d);
            flatpickr = $(element).flatpickr({
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
                mode: "range",
                onChange: function(selectedDates, dateStr, instance) {
                    // handleFlatpickr(selectedDates, dateStr, instance);
                },
            });
        },
        dateFormat: (date) => {
            return `${date.getMonth()+1}/${date.getDate()}/${date.getFullYear()}`;
        },
        dateFilters: () => {
            $(element).parent().append(`
                <button class="btn btn-secondary today" id="${$(element).attr('id')}_today">Today</button>
                <button class="btn btn-secondary yesterday" id="${$(element).attr('id')}_yesterday">Yesterday</button>
                <button class="btn btn-secondary last_week" id="${$(element).attr('id')}_last_week">Last Week</button>
                <button class="btn btn-secondary last_month" id="${$(element).attr('id')}_last_month">Last Month</button>
            `);

            $(document).on("click", ".today", function() {
                var d = new Date();
                $('#kt_ecommerce_sales_flatpickr').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
                $("#pdf").val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`)
                $("#search").val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`)
                Init.datePicker()
            })
            $(document).on("click", ".yesterday", function() {
                var d = new Date();
                d.setDate(d.getDate() - 1);
                $('#kt_ecommerce_sales_flatpickr').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
                $("#pdf").val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`)
                $("#search").val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`)
                Init.datePicker()
            })
            $(document).on("click", ".last_week", function() {
                var d = new Date();
                d.setDate(d.getDate() - 7);
                $('#kt_ecommerce_sales_flatpickr').val(`${d.getFullYear()}/${d.getMonth()+1}/${d.getDate()}`)
                $("#pdf").val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`)
                $("#search").val(`${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`)
                Init.datePicker()
            })
            $(document).on("click", ".last_month", function() {
                $('#kt_ecommerce_sales_flatpickr').val(`${d.getFullYear()}/${d.getMonth()}/${d.getDate()}`)
                $("#pdf").val(`${d.getFullYear()}-${d.getMonth()}-${d.getDate()}`)
                $("#search").val(`${d.getFullYear()}-${d.getMonth()}-${d.getDate()}`)
                Init.datePicker()
            })
        }
    }

    $(document).ready(function() {
        Init.datePicker();
        Init.dateFilters();
    })
</script>
<?= $this->endSection('content') ?>