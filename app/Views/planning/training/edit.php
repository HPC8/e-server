<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div role="main" class="container-plus">
    <div class="border-t-3 w-100 brc-primary-m1 radius-t-1"></div>
    <div class="card bcard">
        <div class="card-header">
            <h3 class="card-title text-125">
                <i class="fas fa-edit"></i>
                แบบฟอร์มขออนุมัติไปราชการ
            </h3>
        </div>

        <div class="card-body px-3 pb-1">
            <form class="mt-lg-3" autocomplete="off" id="update-training-form" method="post">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> รายละเอียดใบขออนุมัติ
                </p>
                <input type="hidden" name="trainId" value="<?= $trainingInfo['trainID']; ?>">
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-letter" class="mb-0">
                            เลขที่หนังสือขออนุมัติ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-letter col-sm-8 col-md-4" id="train-letter" name="letter" value="<?= $trainingInfo['letter']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-createDate" class="mb-0">
                            วันที่ขออนุมัติ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-4 train-createDate" id="train-createDate" name="createDate" value="<?= $trainingInfo['createDate']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-hospcode" class="mb-0">
                            ผู้ขออนุมัติ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-hospcode" id="train-hospcode" value="<?= view_cell('\App\Models\UserModel::getUsername', ['data' => $trainingInfo['hospcode']]); ?>" autocomplete="off" disabled>
                            <input type="hidden" name="hospcode" value="<?= $trainingInfo['hospcode']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-reportHospcode" class="mb-0">
                            ผู้สรุปรายงาน :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>

                            <select class="form-control train-reportHospcode" id="train-reportHospcode" name="reportHospcode">
                                <?php foreach ($trainingReport as $row) : ?>
                                    <option <?php if ($trainingInfo['reportHospcode'] == $row->hospcode) {
                                                echo 'selected="selected"';
                                            } ?> value="<?= $row->hospcode ?>"><?= $row->titlename . $row->firstname . ' ' . $row->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-subject" class="mb-0">
                            มีราชการ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-subject" id="train-subject" name="subject" value="<?= $trainingInfo['subject']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-location" class="mb-0">
                            ณ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-location" id="train-location" name="location" value="<?= $trainingInfo['location']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-form" class="mb-0">
                            จาก :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-form" id="train-form" name="form" value="<?= $trainingInfo['form']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-startDate" class="mb-0">
                            วันที่มีราชการจริง :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-startDate" id="train-startDate" name="startDate" value="<?= $trainingInfo['startDate']; ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-endDate" id="train-endDate" name="endDate" value="<?= $trainingInfo['endDate']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-startTravel" class="mb-0">
                            วันที่ขออนุมัติเดินทาง :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-startTravel" id="train-startTravel" name="startTravel" value="<?= $trainingInfo['startTravel']; ?>">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-endTravel" id="train-endTravel" name="endTravel" value="<?= $trainingInfo['endTravel']; ?>">
                        </div>
                    </div>
                </div>
                <hr class="border-dotted">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> รายชื่อผู้ไปราชการ
                </p>

                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="" class="mb-0">
                            <a class="btn btn-success btn-sm border-2 brc-black-tp10 radius-round px-2" href="#" data-toggle="modal" data-target="#add-user">
                                <i class="fas fa-plus"></i>
                                เพิ่มข้อมูล
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-10">
                        <table id="tbl-training-user" class="table table-striped table-bordered brc-black-tp11 collapsed display responsive" width="100%">
                            <thead>
                                <tr class="bgc-primary-d2 text-white text-100">
                                    <th class="text-center" width="5%">
                                        <i class="fas fa-sort-amount-down">ลำดับ</th>
                                    <th class="" width="25%">
                                        <i class="fas fa-user-tie">
                                        </i> ชื่อ-สกุล
                                    </th>
                                    <th class="" width="20%">สถานะ</th>
                                    <th class="" width="30%">หมายเหตุ</th>
                                    <th class="text-center" width="10%">
                                        <i class="fas fa-cog">
                                        </i> Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1;
                                foreach ($trainingUser as $row) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= view_cell('\App\Models\UserModel::getUsername', ['data' => $row->hospcode]); ?>
                                        </td>
                                        <td>
                                            <?= view_cell('\App\Models\PlanningModel::getMission', ['data' => $row->status]); ?>
                                        </td>
                                        <td>
                                            <?= $row->doc; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class='action-buttons'>
                                                <a class='trash-user-details text-danger-m1 mx-1' href='#' data-toggle="modal" data-getid="<?= $row->id; ?>" data-target="#trash-user">
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
                </div>
                <hr class="border-dotted">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> รายละเอียดค่าใช้จ่าย
                </p>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-allowance" class="mb-0">
                            ค่าเบี้ยเลี้ยง :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-allowance" id="train-allowance" name="allowance" value="<?= $trainingExpenses['allowance']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-hotel" class="mb-0">
                            ค่าที่พัก :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-hotel" id="train-hotel" name="hotel" value="<?= $trainingExpenses['hotel']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-traveling" class="mb-0">
                            ค่าพาหนะ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-traveling" id="train-traveling" name="traveling" value="<?= $trainingExpenses['traveling']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-oilPrice" class="mb-0">
                            ค่าน้ำมัน :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-oilPrice" id="train-oilPrice" name="oilPrice" value="<?= $trainingExpenses['oilPrice']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-otherValues" class="mb-0">
                            ค่าอื่นๆ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-otherValues" id="train-otherValues" name="otherValues" value="<?= $trainingExpenses['otherValues']; ?>" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-sum" class="mb-0">
                            รวมทั้งหมด :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-sum" id="train-sum" name="sum" disabled />
                        </div>
                    </div>
                </div>


                <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                    <div class="text-center">
                        <button type="button" id="update-training" class="btn btn-info border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="far fa-save text-120 mr-1"></i>
                            บันทึกข้อมูล
                        </button>
                        <button type="button" id="confirm-training" class="btn btn-success border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="far fa-check-square text-120 mr-1"></i>
                            ยืนยันข้อมูล
                        </button>
                    </div>
                </div>
            </form>
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
echo view('planning/training/addUser');
echo view('planning/training/trashUser');
?>
<?= $this->endSection() ?>
<!-- //echo view_cell('\App\Libraries\MyLibrary::bahtText', ['data' => 200.21]); -->