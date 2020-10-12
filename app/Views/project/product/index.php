<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-header mb-2 pb-2 flex-column flex-sm-row align-items-start align-items-sm-center py-25 px-1">
    <h1 class="page-title text-primary-d2 text-120">
        <i class="fas fa-database"></i>
        ตารางรายการผลผลิต
    </h1>

    <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
        <div class="col-lg-12">
            <a class="btn btn-success border-2 brc-black-tp10 radius-round px-3 <?= !empty($admin) ? '' : 'disabled' ?>" href="#" id="add-submit" data-toggle="modal" data-target="#add-product">
                <i class="fas fa-plus"></i>
                เพิ่มข้อมูล
            </a>
        </div>
    </div>
</div>

<div class="card bcard  border-t-3 brc-blue-m2">
    <table id="tbl-planList" class="table table-striped table-bordered brc-black-tp11 collapsed  display" width="100%">

        <thead class="text-primary-d2 text-100">
            <tr>
                <th class="all text-center">
                    <i class="fas fa-sort-amount-down">
                    </i> ลำดับ
                </th>

                <th class="all">
                    <i class="fas fa-book"></i>
                    </i> ชื่อผลผลิต
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
            foreach ($productList as $row) : ?>
                <tr>
                    <td>
                        <?=  $no; ?>
                    </td>
                    <td>
                        <?=  $row->product_name; ?>
                    </td>

                    <td>
                        <?=  $row->product_id; ?>
                    </td>
                    <td>
                        <div class='action-buttons'>
                            <a class='view-product text-blue mx-1' href='#' data-getid="<?= $row->product_id; ?>" data-toggle="modal" data-target="#view-product">
                                <i class='fa fa-search-plus text-105'></i>
                            </a>
                            <a class='edit-product-details text-success mx-1 <?= !empty($admin) ? '' : 'disabled' ?>' href='#' data-getid="<?= $row->product_id; ?>" data-getyear="<?= $row->product_year; ?>" data-toggle="modal" data-target="#edit-product">
                                <i class='fa fa-pencil-alt text-105'></i>
                            </a>
                            <a class='trash-product-details text-danger-m1 mx-1 <?= !empty($admin) ? '' : 'disabled' ?>' href='#' data-getid="<?= $row->product_id; ?>" data-toggle="modal" data-target="#trash-product">
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
echo view('project/product/add');
echo view('project/product/view');
echo view('project/product/edit');
echo view('project/product/trash');
?>

<?= $this->endSection() ?>