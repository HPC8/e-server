<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div role="main" class="container-plus">
    <div class="border-t-2 w-100 brc-primary-m1 radius-t-1"></div>
    <div class="card bcard">
        <div class="card-header">
            <h3 class="card-title text-125">
                <a href="planning/trainingEdit/<?= $trainingInfo['trainID']; ?>" class="btn btn-sm btn-secondary border-2 brc-black-tp10 radius-round px-3 mb-1">
                    <i class="fas fa-edit"></i>
                    ขออนุมัติไปราชการ
                </a>
                <a href="planning/trainingExpect/<?= $trainingInfo['trainID']; ?>" class="btn btn-sm btn-orange border-2 brc-black-tp10 radius-round px-3 mb-1">
                    <i class="fas fa-university"></i>
                    การยืมเงิน
                </a>

            </h3>
            <div class="page-tools mt-3 mt-sm-0 mb-sm-n1">
                P06-004
            </div>

        </div>

        <div class="card-body px-3 pb-1">
            <form class="mt-lg-3" autocomplete="off" id="expect-form" method="post">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> รายละเอียดการยืมเงินในครั้งนี้
                </p>
                <input type="hidden" name="trainId" value="<?= $trainingInfo['trainID']; ?>">
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-loanNo" class="mb-0">
                            เลขที่ใบยืม :
                        </label>
                    </div>

                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control expect-loanNo" id="expect-loanNo" name="loanNo" autocomplete="off" value="<?= $expectInfo['loanNo']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-moneyNo" class="mb-0">
                            เงินทดลองราชการเลขที่ :
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-4 expect-moneyNo" id="expect-moneyNo" name="moneyNo" autocomplete="off" value="<?= $expectInfo['moneyNo']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-moneyDate" class="mb-0">
                            วันที่ยืมเงิน :
                        </label>
                    </div>

                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control expect-moneyDate" id="expect-moneyDate" name="moneyDate" value="<?= $expectInfo['moneyDate']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-approveDate" class="mb-0">
                            วันที่อนุมัติ :
                        </label>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control expect-approveDate" id="expect-approveDate" name="approveDate">
                        </div>
                    </div>
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-deadline" class="mb-0">
                            วันครบกำหนด :
                        </label>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control expect-deadline" id="expect-deadline" name="deadline">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-borrower" class="mb-0">
                            ผู้ยืมเงิน :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>

                            <select class="form-control expect-borrower" id="expect-borrower" name="borrower">
                                <?php foreach ($trainingReport as $row) : ?>
                                    <option <?php if ($expectInfo['borrower'] == $row->hospcode) {
                                                echo 'selected="selected"';
                                            } ?> value="<?= $row->hospcode ?>">
                                        <?= $row->titlename . $row->firstname . ' ' . $row->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-moneyType" class="mb-0">
                            ประเภทเงินยืม :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>

                            <select class="form-control expect-moneyType" id="expect-moneyType" name="moneyType">
                                <?php foreach ($moneyType as $row) : ?>
                                    <option <?php if ($trainingInfo['reportHospcode'] == $row->id) {
                                                echo 'selected="selected"';
                                            } ?> value="<?= $row->id ?>"><?= $row->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-subject" class="mb-0">
                            เรื่องที่ไปราชการ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control expect-subject" id="expect-subject" value="<?= $trainingInfo['subject'] . ' ณ ' . $trainingInfo['location']; ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="expect-date" class="mb-0">
                            ระหว่างวันที่ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control expect-date" id="expect-date" value="<?= $thaidate->rangeDateFull($trainingInfo['startTravel'], $trainingInfo['endTravel']);  ?>" disabled>
                        </div>
                    </div>
                </div>

                <?php $summary = 0; ?>
                <hr class="border-dotted">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> ค่าเบี้ยเลี้ยงเดินทาง
                </p>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="" class="mb-0">
                            <a class="btn btn-success btn-sm border-2 brc-black-tp10 radius-round px-2" href="#" data-toggle="modal" data-target="#add-allowance">
                                <i class="fas fa-plus"></i>
                                เพิ่มข้อมูล
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-10">
                        <table id="" class="table table-striped table-bordered brc-black-tp11 collapsed display responsive" width="100%">
                            <thead>
                                <tr class="bgc-primary-d2 text-white text-100">
                                    <th class="text-center" width="5%">
                                        <i class="fas fa-sort-amount-down">ลำดับ</th>
                                    <th class="" width="37%">
                                        </i> ประเภทบุคคล
                                    </th>
                                    <th class="text-right" width="10%">จำนวนคน</th>
                                    <th class="text-right" width="10%">จำนวนวัน</th>
                                    <th class="text-right" width="10%">วันละ</th>
                                    <th class="text-right" width="13%">รวมเงิน</th>
                                    <th class="text-center" width="10%">
                                        <i class="fas fa-cog">
                                        </i> Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $total = 0;
                                $sum = 0;
                                foreach ($allowance as $row) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= view_cell('\App\Models\PlanningModel::getPersonType', ['data' => $row->personType]); ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->peopleNumber; ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->dayNumber; ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->price; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php $sum = (($row->dayNumber * $row->price) * $row->peopleNumber);
                                            echo number_format($sum, 2);
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <div class='action-buttons'>
                                                <a class='trash-expect-allowance text-danger-m1 mx-1' href='#' data-toggle="modal" data-getid="<?= $row->id; ?>" data-target="#trash-allowance">
                                                    <i class='fa fa-trash-alt text-105'></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php $no++;
                                    $total = $total + $sum;
                                endforeach;  ?>
                                <tr style="background-color: #F0FFFF;">
                                    <td colspan="5" class="text-right">
                                        รวมทั้งหมด
                                    <td class="text-right">
                                        <?php
                                        echo number_format($total, 2);
                                        $summary = $summary + $total;
                                        ?>

                                    </td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr class="border-dotted">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> ค่าเช่าที่พัก
                </p>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="" class="mb-0">
                            <a class="btn btn-success btn-sm border-2 brc-black-tp10 radius-round px-2" href="#" data-toggle="modal" data-target="#add-hotel">
                                <i class="fas fa-plus"></i>
                                เพิ่มข้อมูล
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-10">
                        <table id="" class="table table-striped table-bordered brc-black-tp11 collapsed display responsive" width="100%">
                            <thead>
                                <tr class="bgc-primary-d2 text-white text-100">
                                    <th class="text-center" width="5%">
                                        <i class="fas fa-sort-amount-down">ลำดับ</th>
                                    <th class="" width="35%">
                                        </i> ประเภทห้อง
                                    </th>
                                    <th class="text-right" width="12%">จำนวนห้อง</th>
                                    <th class="text-right" width="10%">จำนวนวัน</th>
                                    <th class="text-right" width="10%">วันละ</th>
                                    <th class="text-right" width="13%">รวมเงิน</th>
                                    <th class="text-center" width="10%">
                                        <i class="fas fa-cog">
                                        </i> Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $total = 0;
                                $sum = 0;
                                foreach ($hotel as $row) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= view_cell('\App\Models\PlanningModel::getRoomType', ['data' => $row->roomType]); ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->roomNumber; ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->dayNumber; ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->price; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php $sum = (($row->dayNumber * $row->price) * $row->roomNumber);
                                            echo number_format($sum, 2);
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <div class='action-buttons'>
                                                <a class='trash-expect-hotel text-danger-m1 mx-1' href='#' data-toggle="modal" data-getid="<?= $row->id; ?>" data-target="#trash-hotel">
                                                    <i class='fa fa-trash-alt text-105'></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php $no++;
                                    $total = $total + $sum;
                                endforeach;  ?>
                                <tr style="background-color: #F0FFFF;">
                                    <td colspan="5" class="text-right">
                                        รวมทั้งหมด
                                    <td class="text-right">
                                        <?php
                                        echo number_format($total, 2);
                                        $summary = $summary + $total;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="border-dotted">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> ค่ายานพาหนะ
                </p>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="" class="mb-0">
                            <a class="btn btn-success btn-sm border-2 brc-black-tp10 radius-round px-2" href="#" data-toggle="modal" data-target="#add-traveling">
                                <i class="fas fa-plus"></i>
                                เพิ่มข้อมูล
                            </a>
                        </label>
                    </div>
                    <div class="col-sm-10">
                        <table id="" class="table table-striped table-bordered brc-black-tp11 collapsed display responsive" width="100%">
                            <thead>
                                <tr class="bgc-primary-d2 text-white text-100">
                                    <th class="text-center" width="5%">
                                        <i class="fas fa-sort-amount-down">ลำดับ</th>
                                    <th class="" width="45%">
                                        </i> ประเภทบุคคล
                                    </th>
                                    <th class="text-right" width="10%">จำนวนคน</th>
                                    <th class="text-right" width="12%">จำนวนเงิน</th>
                                    <th class="text-right" width="13%">รวมเงิน</th>
                                    <th class="text-center" width="10%">
                                        <i class="fas fa-cog">
                                        </i> Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                $total = 0;
                                $sum = 0;
                                foreach ($traveling as $row) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= view_cell('\App\Models\PlanningModel::getPersonType', ['data' => $row->personType]); ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->peopleNumber; ?>
                                        </td>
                                        <td class="text-right">
                                            <?= $row->price; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php $sum = ($row->peopleNumber * $row->price);
                                            echo number_format($sum, 2);
                                            ?>
                                        </td>

                                        <td class="text-center">
                                            <div class='action-buttons'>
                                                <a class='trash-expect-traveling text-danger-m1 mx-1' href='#' data-toggle="modal" data-getid="<?= $row->id; ?>" data-target="#trash-traveling">
                                                    <i class='fa fa-trash-alt text-105'></i>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php $no++;
                                    $total = $total + $sum;
                                endforeach;  ?>
                                <tr style="background-color: #F0FFFF;">
                                    <td colspan="4" class="text-right">
                                        รวมทั้งหมด
                                    <td class="text-right">
                                        <?php
                                        echo number_format($total, 2);
                                        $summary = $summary + $total;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="border-dotted">
                <p class="text-100 text-warning">
                    <i class="fas fa-info-circle"></i> รวมเป็นเงินทั้งสิ้น
                </p>
                <div class="alert bgc-secondary-l3">
                    <H3 class="card-title text-130"><i class="fab fa-btc mr-2 mb-1"></i>
                        <?php echo number_format($summary, 2);
                        echo '&nbsp;&nbsp;&nbsp;&nbsp; (' . view_cell('\App\Libraries\MyLibrary::bahtText', ['data' => $summary]) . ')'; ?>
                    </H3>

                </div>
                <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                    <div class="text-center">
                        <a href="javascript:history.back();" class="btn btn-secondary border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="fas fa-undo-alt text-120 mr-1"></i>
                            ย้อนกลับ
                        </a>
                        <button type="button" id="add-expect" class="btn btn-success border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="fas fa-download text-120 mr-1"></i>
                            บันทึกข้อมูล
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
echo view('planning/training/addAllowance');
echo view('planning/training/trashAllowance');
echo view('planning/training/addHotel');
echo view('planning/training/trashHotel');
echo view('planning/training/addTraveling');
echo view('planning/training/trashTraveling');
?>
<?= $this->endSection() ?>
<!-- //echo view_cell('\App\Libraries\MyLibrary::bahtText', ['data' => 200.21]); -->