<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<div class="page-header mb-2 pb-2 flex-column flex-sm-row align-items-start align-items-sm-center py-25 px-1">
    <h1 class="page-title text-primary-d2 text-120">
        <i class="fas fa-database"></i>

        ตารางรายชื่อ<?= $category[0]->category_name; ?>
    </h1>
    <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
        P01-003
    </div>
</div>

<div class="card bcard  border-t-3 brc-blue-m2">
    <table id="tbl-category" class="table table-striped table-bordered brc-black-tp11 collapsed  display responsive" width="100%">

        <thead class="text-primary-d2 text-100">
            <tr>
                <th class="all text-center">
                    <i class="fas fa-sort-amount-down">
                    </i> ลำดับ
                </th>

                <th class="all">
                    <i class="far fa-id-card">
                    </i> รหัสประจำตัว
                </th>

                <th class="min-tablet-p">
                    <i class="fas fa-user-tie">
                    </i> ชื่อ-สกุล
                </th>

                <th class="min-tablet-l">
                    <i class="fas fa-user-tag">
                    </i> ตำแหน่ง
                </th>

                <th class="none">
                    <i class="fas fa-sitemap">
                    </i> กลุ่มงาน
                </th>

                <th class="all">
                    <i class="fas fa-cog">
                    </i> Action
                </th>
            </tr>
        </thead>

        <tbody class="pos-rel">
            <?php $no = 1;
            foreach ($listCategory as $row) : ?>
                <tr>
                    <td>
                        <?= $no; ?>
                    </td>
                    <td>
                        <?= $row->hospcode; ?>
                    </td>

                    <td>
                        <?= $row->titlename . $row->firstname . ' ' . $row->lastname; ?>
                    </td>

                    <td>
                        <?= $row->position_name . $row->level_name; ?>
                    </td>
                    <td>
                        <?= $row->department_name; ?>
                    </td>
                    <td>
                        <div class='action-buttons'>
                            <a class='text-blue mx-1' href='hr/profile/<?= $row->hospcode; ?>'>
                                <i class='fa fa-search-plus text-105'></i>
                            </a>
                            <a class='text-success mx-1' href='hr/edit/<?= $row->hospcode; ?>'>
                                <i class='fa fa-pencil-alt text-105'></i>
                            </a>
                            <a class='text-danger-m1 mx-1' href='hr/transfer/<?= $row->hospcode; ?>'>
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




<?= $this->endSection() ?>