<!--begin::Head-->

<head>
    <base href="../" />
    <title>POS | <?= $systemSetting['title'] ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <?php if ($systemSetting['favicon']) : ?>
        <link rel="shortcut icon" href="<?= base_url('public/uploads/' . $systemSetting['favicon']) ?>" />
    <?php else : ?>
        <link rel="shortcut icon" href="<?= base_url('public/admin/media/logos/favicon.ico') ?>" />
    <?php endif; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= base_url('public/admin/plugins/custom/datatables/datatables.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('public/admin/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('public/admin/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/admin/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('public/admin/js/scripts.bundle.js') ?>"></script>
    <script src="<?= base_url('public/admin/plugins/custom/datatables/datatables.bundle.js') ?>"></script>
    <script>
        const apiURL = 'https://www.georgiaphonecase.com/pos_api/api/';
        const siteURL = '<?= base_url() ?>/';
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toastr-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <style>
        .form-check-custom.form-check-solid .form-check-input {
            border: 0 !important;
            background-color: #9b9b9b !important;
        }
    </style>
    <!--end::Vendors Javascript-->
</head>
<!--end::Head-->