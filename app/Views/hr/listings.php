<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<div class="page-header mb-2 pb-2 flex-column flex-sm-row align-items-start align-items-sm-center py-25 px-1">
    <h1 class="page-title text-primary-d2 text-120">
        <i class="fas fa-database"></i>

        ตารางรายชื่อบุคลากรทั้งหมด
    </h1>

    <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
    </div>
</div>

<div class="card bcard  border-t-3 brc-blue-m2">
    <table id="tbl-listings" class="table table-striped table-bordered brc-black-tp11 collapsed  display responsive" width="100%">

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

        </tbody>
    </table>

</div>




<?= $this->endSection() ?>