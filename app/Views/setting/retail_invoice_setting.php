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
                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">Retail Invoice Setting</a>
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
        <form method="post">
            <?= csrf_field() ?>
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::About card-->
                <div class="card">
                    <!--begin::Card header-->
                    <!--begin::Body-->
                    <div class="card-body p-5 px-lg-19 py-lg-16">
                        <div class="d-flex flex-column flex-md-row gap-5">

                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">Terms & Conditions</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control" rows="10" name="terms"><?= $data['terms'] ?></textarea>
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('terms')) ? $validation->getError('terms') : "" ?>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-5 mt-10">
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="email" placeholder="" value="<?= $data['email'] ?>">
                                <span class="text-danger">
                                    <?= ($validation->hasError('email')) ? $validation->getError('email') : "" ?>
                                </span>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required form-label">Tel</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="phone" placeholder="" value="<?= $data['phone'] ?>">
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('phone')) ? $validation->getError('phone') : "" ?>
                                </span>
                            </div>
                            <div class="fv-row flex-row-fluid fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required form-label">Fax</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control" name="fax" placeholder="" value="<?= $data['fax'] ?>">
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('fax')) ? $validation->getError('fax') : "" ?>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-5 mt-10">
                            <div class="flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label">Address</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea rows="3" class="form-control" name="address"><?= $data['address'] ?></textarea>
                                <!--end::Input-->
                                <span class="text-danger">
                                    <?= ($validation->hasError('address')) ? $validation->getError('address') : "" ?>
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