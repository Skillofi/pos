<?php $session = \Config\Services::session();  ?>
<?php if ($session->getFlashdata('flashData')): ?>
    <?php if ($session->getFlashdata('flashData')['status'] == 200) : ?>
        <!--begin::Alert-->
        <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="mb-2 light text-light">Success</h4>
                <!--end::Title-->
                <!--begin::Content-->
                <span><?= $session->getFlashdata('flashData')['message'] ?></span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <span class="svg-icon svg-icon-2x svg-icon-light">X</span>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
    <?php else : ?>
        <!--begin::Alert-->
        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="mb-2 light text-light">Error</h4>
                <!--end::Title-->
                <!--begin::Content-->
                <span><?= $session->getFlashdata('flashData')['message'] ?></span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                <span class="svg-icon svg-icon-2x svg-icon-light">X</span>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
    <?php endif; ?>
<?php endif; ?>