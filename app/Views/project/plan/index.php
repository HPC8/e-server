<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card bcard  border-t-2 brc-blue-m2">
            <div class="card-header">
                <h1 class="page-title text-primary-d2 text-120">
                    <i class="fas fa-database"></i>
                    ตารางรายการแผนงาน
                    <a class="btn btn-sm btn-success border-2 brc-black-tp10 radius-round px-3 <?= !empty($admin) ? '' : 'disabled' ?>" href="#" id="add-submit" data-toggle="modal" data-target="#add-plan">
                        <i class="fas fa-plus"></i>
                        เพิ่มข้อมูล
                    </a>
                </h1>
                <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
                    P02-001
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card bcard">
    <table id="tbl-planList" class="table table-striped table-bordered brc-black-tp11 collapsed  display" width="100%">
        <thead class="text-primary-d2 text-100">
            <tr>
                <th class="all text-center">
                    <i class="fas fa-sort-amount-down">
                    </i> ลำดับ
                </th>

                <th class="all">
                    <i class="fas fa-book"></i>
                    </i> ชื่อแผนงาน
                </th>

                <th class="all">
                    <i class="fas fa-sync-alt"></i>
                    </i> สถานะ
                </th>

                <th class="all text-center">
                    <i class="fas fa-cog">
                    </i> Action
                </th>
            </tr>
        </thead>

        <tbody class="pos-rel">
            <?php $no = 1;
            foreach ($planList as $row) : ?>
                <tr>
                    <td>
                        <?= $no; ?>
                    </td>
                    <td>
                        <?= $row->plan_name; ?>
                    </td>

                    <td>
                        <?= $row->plan_id; ?>
                    </td>
                    <td>
                        <div class='action-buttons'>
                            <a class='view-plan text-blue mx-1' href='#' data-getid="<?= $row->plan_id; ?>" data-toggle="modal" data-target="#view-plan">
                                <i class='fa fa-search-plus text-105'></i>
                            </a>
                            <a class='edit-plan-details text-success mx-1 <?= !empty($admin) ? '' : 'disabled' ?>' href='#' data-getid="<?= $row->plan_id; ?>" data-toggle="modal" data-target="#edit-plan">
                                <i class='fa fa-pencil-alt text-105'></i>
                            </a>
                            <a class='trash-plan-details text-danger-m1 mx-1 <?= !empty($admin) ? '' : 'disabled' ?>' href='#' data-getid="<?= $row->plan_id; ?>" data-toggle="modal" data-target="#trash-plan">
                                <i class='fa fa-trash-alt text-105'></i>
                            </a>
                        </div>
                    </td>

                </tr>
            <?php $no++;
            endforeach;  ?>
        </tbody>
    </table>

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
echo view('project/alert');
echo view('project/plan/add');
echo view('project/plan/view');
echo view('project/plan/edit');
echo view('project/plan/trash');
?>

<?= $this->endSection() ?>