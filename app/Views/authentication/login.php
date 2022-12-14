<?php $systemSettingModel = model(SystemSettingModel::class); ?>
<?php $systemSetting = $systemSettingModel->where('id', '1')->first(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>POS | <?= $systemSetting['title'] ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="POS" />
    <meta name="keywords" content="POS" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?= base_url('public/favicon.ico') ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="<?= base_url('public/admin/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('public/admin/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-image: url('<?= base_url('public/admin/media/auth/bg4.jpg') ?>');
        }

        [data-theme="dark"] body {
            background-image: url('<?= base_url('public/admin/media/auth/bg4-dark.jpg') ?>');
        }
    </style>
</head>

<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <a href="<?= base_url('dashboard') ?>" class="mb-7">
                        <img alt="Logo" src="<?= base_url('public/uploads/' . $systemSetting['logo']) ?>" />
                    </a>
                    <h2 class="text-white fw-normal m-0">Branding tools designed for your business</h2>
                </div>
            </div>
            <div class="d-flex flex-center w-lg-50 p-10">
                <div class="card rounded-3 w-md-550px">
                    <div class="card-body p-10 p-lg-20">
                        <?= view('general/alerts') ?>
                        <form class="form w-100" novalidate="validate" id="kt_sign_in_form" method="POST">
                            <?= csrf_field() ?>
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Enter your credentails</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Username" id="username" name="username" autocomplete="off" class="form-control bg-transparent" />
                                <span class="text-danger">
                                    <?= ($validation->hasError('username')) ? $validation->getError('username') : "" ?>
                                </span>
                            </div>
                            <div class="fv-row mb-3">
                                <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
                                <span class="text-danger">
                                    <?= ($validation->hasError('password')) ? $validation->getError('password') : "" ?>
                                </span>
                            </div>
                            <div class="d-grid mb-10">
                                <button id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">Sign In</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="<?= base_url('public/admin/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('public/admin/js/scripts.bundle.js') ?>"></script>
</body>
</html>