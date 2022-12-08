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
                            <form action="<?= base_url('retail_report/summary_pdf') ?>" target="_blank">
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
                            From <?= isset($from_date) ? $from_date : '-' ?> To <?= isset($to_date) ? $to_date : '-' ?>
                        </center>
                        <div class="table-response">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover ng-star-inserted">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-end">Sales Report</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales</td>
                                        <td><?= $formatter->formatCurrency($totalSale, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td><?= $formatter->formatCurrency($discount, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td><?= $formatter->formatCurrency($shipping, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td><?= $formatter->formatCurrency($tax, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><?= $formatter->formatCurrency($grandTotal, 'USD') ?></td>
                                    </tr>
                                </tbody>
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Payment</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cash</td>
                                        <td><?= $formatter->formatCurrency($cashTotal, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Gift Card</td>
                                        <td><?= $formatter->formatCurrency($giftCardTotal, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Credit Card</td>
                                        <td><?= $formatter->formatCurrency($creditCardTotal, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cheque</td>
                                        <td><?= $formatter->formatCurrency($chequeTotal, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td><?= $formatter->formatCurrency($otherTotal, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Deposite</td>
                                        <td><?= $formatter->formatCurrency($depositeTotal, 'USD') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Payment</td>
                                        <td><?= $formatter->formatCurrency($totalPayment, 'USD') ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Total Balance</td>
                                        <td><?= $formatter->formatCurrency(floatval($grandTotal) - floatval($totalPayment), 'USD') ?></td>
                                    </tr> -->
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
                                        <td><?= $salesCount ?></td>
                                    </tr>
                                    <tr>
                                        <td>Number of Total Item Sold</td>
                                        <td><?= $salesItemCount ?></td>
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