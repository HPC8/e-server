<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-header mb-2 pb-2 flex-column flex-sm-row align-items-start align-items-sm-center py-25 px-1">
    <h1 class="page-title text-primary-d2 text-120">
        <i class="fas fa-database"></i>
        ตารางรายการขออนุมัติไปราชการ
    </h1>

    <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
        <div class="col-lg-12">
            <a class="btn btn-success border-2 brc-black-tp10 radius-round px-3 " href="planning/trainingCreate">
                <i class="fas fa-plus"></i>
                เพิ่มข้อมูล
            </a>
        </div>
    </div>
</div>



<?= $this->endSection() ?>