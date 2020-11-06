<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div role="main" class="container-plus">
    <div class="border-t-2 w-100 brc-primary-m1 radius-t-1"></div>
    <div class="card bcard">
        <div class="card-header">
            <h1 class="page-title text-primary-d2 text-120">
                <i class="fas fa-database"></i>
                ตารางรายการขออนุมัติไปราชการ

                <a class="btn btn-sm btn-success border-2 brc-black-tp10 radius-round px-3 " href="planning/trainingCreate">
                    <i class="fas fa-plus"></i>
                    เพิ่มข้อมูล
                </a>
            </h1>
            <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
                P06-001
            </div>

        </div>

        <div class="card bcard">
            <table id="tbl-training" class="table table-striped table-bordered brc-black-tp11 collapsed display responsive" width="100%">

                <thead class="text-primary-d2 text-100">
                    <tr>
                        <th class="all text-center">
                            <i class="fas fa-sort-amount-down">
                            </i> เลขที่เอกสาร
                        </th>

                        <th class="all">
                            <i class="far fa-id-card">
                            </i> เรื่องที่ไปราชการ
                        </th>

                        <th class="min-tablet-p">
                            <i class="fas fa-user-tie">
                            </i> วันที่ไปราชการ
                        </th>

                        <th class="min-tablet-l text-center">
                            <i class="fas fa-sync-alt"></i>
                            </i> สถานะ
                        </th>

                        <th class="none">
                            <i class="fas fa-sitemap">
                            </i> สถานที่
                        </th>
                        <th class="none">
                            <i class="fas fa-sitemap">
                            </i> ผู้ข้ออนุมัติ
                        </th>
                        <th class="none">
                            <i class="fas fa-sitemap">
                            </i> วันที่ขออนุมัติ
                        </th>

                        <th class="all">
                            <i class="fas fa-cog">
                            </i> Action
                        </th>
                    </tr>
                </thead>

                <tbody class="pos-rel">

                </tbody>
            </table>


        </div>
    </div>

</div>

<?php
if (session('msg') == '1') { { ?>
        <a id="alerts-auto" data-toggle="modal" data-target="#alerts-modal"></a>
    <?php }
} elseif (session('msg') == '0') { ?>
    <a id="success-auto" data-toggle="modal" data-target="#success-modal"></a>
<?php }
?>

<?php
echo view('planning/alert');
?>

<?= $this->endSection() ?>