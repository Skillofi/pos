<?= $this->extend('base') ?>
<?= $this->section('content') ?>
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Setting</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">System Setting</a>
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
        <?= view('general/alerts') ?>
        <form method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::About card-->
                <div class="card">
                    <!--begin::Card header-->
                    <!--begin::Body-->
                    <div class="card-body p-5 px-lg-19 py-lg-16">
                        <div class="d-flex flex-column flex-md-row gap-10 mt-10">
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="title" placeholder="" value="<?= $data['title'] ?>">
                                <span class="text-danger">
                                    <?= ($validation->hasError('title')) ? $validation->getError('title') : "" ?>
                                </span>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-5 mt-10 d-none">
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">SMTP Host</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="smtp_host" placeholder="" value="<?= $data['smtp_host'] ?>">
                                <span class="text-danger">
                                    <?= ($validation->hasError('smtp_host')) ? $validation->getError('smtp_host') : "" ?>
                                </span>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container d-none">
                                <!--begin::Label-->
                                <label class="required form-label">SMTP Port</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" class="form-control" name="smtp_port" placeholder="" value="<?= $data['smtp_port'] ?>">
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('smtp_port')) ? $validation->getError('smtp_port') : "" ?>
                                </span>
                            </div>
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container d-none">
                                <!--begin::Label-->
                                <label class="required form-label">SMTP Username</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="smtp_username" placeholder="" value="<?= $data['smtp_username'] ?>">
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('smtp_username')) ? $validation->getError('smtp_username') : "" ?>
                                </span>
                            </div>
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container d-none">
                                <!--begin::Label-->
                                <label class="required form-label">SMTP Password</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="smtp_password" placeholder="" value="<?= $data['smtp_password'] ?>">
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('smtp_password')) ? $validation->getError('smtp_password') : "" ?>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-5 mt-10">
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                                <!--begin::Label-->
                                <div class="row">
                                    <?php if ($data['logo'] != "") : ?>
                                        <div class="text-center">
                                            <div class="symbol symbol-100px  ">
                                                <img src="<?= base_url('public/uploads/' . $data['logo']) ?>" alt="image">
                                            </div>
                                        </div><br>
                                    <?php endif; ?>
                                    <div class="">
                                        <label class="form-label">Logo</label>
                                        <input type="file" class="form-control" name="logo" placeholder="" accept="image/*">
                                    </div>
                                </div>
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('logo')) ? $validation->getError('logo') : "" ?>
                                </span>
                            </div>
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                                <!--begin::Label-->
                                <div class="row">
                                    <?php if ($data['favicon'] != "") : ?>
                                        <div class="text-center">
                                            <div class="symbol symbol-100px  ">
                                                <img src="<?= base_url('public/uploads/' . $data['favicon']) ?>" alt="image">
                                            </div>
                                        </div><br>
                                    <?php endif; ?>
                                    <div class="">
                                        <label class="form-label">Favicon</label>
                                        <input type="file" class="form-control" name="favicon" placeholder="" accept="image/*">
                                    </div>
                                </div>
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('favicon')) ? $validation->getError('favicon') : "" ?>
                                </span>
                            </div>

                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::About card-->
                <div class="d-flex justify-content-end mt-5">
                    <!--begin::Button-->
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Save Changes</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
        </form>
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
<?= $this->endSection('content') ?>