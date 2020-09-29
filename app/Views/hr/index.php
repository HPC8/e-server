<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card bcard">
            <div class="card-header">
                <h5 class="card-title">
                    ข้อมูลบุคลากร
                </h5>

                <div class="card-toolbar">


                    <a href="#" data-action="reload" class="card-toolbar-btn text-green">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="#" data-action="toggle" class="card-toolbar-btn text-grey-d1">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close" class="card-toolbar-btn text-danger">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0 text-danger" style="width:100%">
                    <thead class="text-dark-l2 text-95">
                        <tr>
                            <th width="75%">
                                <i class="fas fa-user-tag"></i>
                                ประเภทบุคลากร
                            </th>

                            <th class="text-center" width="25%">
                                <i class="fas fa-sort-amount-down"></i>
                                จำนวน
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($category as $row) : ?>
                            <tr>
                                <td class="text-dark-m2"><i class="fa fa-chevron-right text-blue" aria-hidden="true"> </i>
                                    <a href='hr/category/<?= $row->category_id; ?>'><?php echo $row->category_name; ?></a>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="text-primary-d2"><B><?= view_cell('\App\Controllers\Hr::count', ['id' => $row->category_id]) ?></B></a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td class="text-dark-m2"><i class="fa fa-chevron-right text-blue" aria-hidden="true"> </i>
                                <a href='hr/listings'>บุคลากรทั้งหมด</a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="text-success-d2"><B><?= view_cell('\App\Controllers\Hr::count', ['id' => '']) ?></B></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-dark-m2"><i class="fa fa-chevron-right text-blue" aria-hidden="true"> </i>
                                <a href='hr/discard'>บุคลากรที่จำหน่าย</a>
                            </td>
                            <td class="text-center">
                                <a href="#" class="text-danger"><B><?= view_cell('\App\Controllers\Hr::count', ['id' => 0]) ?></B></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card bcard">
            <div class="card-header">
                <h5 class="card-title">
                    สรุปข้อมูลบุคลากร
                </h5>

                <div class="card-toolbar">


                    <a href="#" data-action="reload" class="card-toolbar-btn text-green">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="#" data-action="toggle" class="card-toolbar-btn text-grey-d1">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close" class="card-toolbar-btn text-danger">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div id="pieCategory" class="pieCategory"></div>
            </div>
        </div>
        <br>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card bcard">
            <div class="card-header">
                <h5 class="card-title">
                    ข้อมูลบุคลากรแบ่งตาม ระดับการศึกษา
                </h5>

                <div class="card-toolbar">


                    <a href="#" data-action="reload" class="card-toolbar-btn text-green">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="#" data-action="toggle" class="card-toolbar-btn text-grey-d1">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close" class="card-toolbar-btn text-danger">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div id="pieEducation" class="pieEducation"></div>
            </div>
        </div>
    </div>
    <br>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card bcard">
            <div class="card-header">
                <h5 class="card-title">
                    ข้อมูลบุคลากรแบ่งตาม Generation
                </h5>

                <div class="card-toolbar">
                    <a href="#" data-action="reload" class="card-toolbar-btn text-green">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="#" data-action="toggle" class="card-toolbar-btn text-grey-d1">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close" class="card-toolbar-btn text-danger">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div id="pieGen" class="pieGen"></div>
            </div>
        </div>
        <br>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="card bcard">
            <div class="card-header">
                <h5 class="card-title">
                    ข้อมูลบุคลากรแบ่งตาม ระดับตําแหน่ง
                </h5>

                <div class="card-toolbar">
                    <a href="#" data-action="reload" class="card-toolbar-btn text-green">
                        <i class="fas fa-sync-alt"></i>
                    </a>

                    <a href="#" data-action="toggle" class="card-toolbar-btn text-grey-d1">
                        <i class="fa fa-chevron-up"></i>
                    </a>

                    <a href="#" data-action="close" class="card-toolbar-btn text-danger">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div id="pieLavel" class="pieLavel"></div>
            </div>
        </div>
        <br>
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
echo view('hr/modal/alert');
?>

<?= $this->endSection() ?>