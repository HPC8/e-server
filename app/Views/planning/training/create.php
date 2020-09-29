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
            <form class="mt-lg-3" autocomplete="off" id="hr-register-form" method="post">

                <p class="text-100 text-success">
                    <i class="fas fa-info-circle"></i> รายละเอียดใบขออนุมัติ
                </p>

                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-letter" class="mb-0">
                            เลขที่บันทึกขออนุมัติ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-letter col-sm-8 col-md-4" id="train-letter" name="letter" value="<?= $user['department_letter']; ?>/" autocomplete="off" />
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
                            <input type="text" class="form-control col-sm-8 col-md-4 train-createDate" id="train-createDate" name="createDate" value="">
                        </div>
                    </div>
                </div>
                <fieldset disabled>
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
                                <input type="text" class="form-control train-hospcode" id="train-hospcode" name="hospcode" value="<?php echo $user['titlename'] . $user['firstname'] . ' ' . $user['lastname']; ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </fieldset>
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

                            <select class="chosen-select form-control train-reportHospcode" id="train-reportHospcode" name="reportHospcode">
                                <option value="">-- กรุณาเลือก --</option>
                                <?php foreach ($listUser as $row) : ?>
                                    <option <?php if ($user['hospcode'] == $row->hospcode) {
                                                echo 'selected="selected"';
                                            } ?> value="<?= $row->hospcode ?>"><?= $row->titlename . $row->firstname . ' ' . $row->lastname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-letter" class="mb-0">
                            มีราชการ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-letter" id="train-letter" name="letter" value="" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-letter" class="mb-0">
                            ณ :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-letter" id="train-letter" name="letter" value="" autocomplete="off" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-letter" class="mb-0">
                            จาก :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control train-letter" id="train-letter" name="letter" value="" autocomplete="off" />
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
                            <input type="text" class="form-control col-sm-8 col-md-3 train-startDate" id="train-startDate" name="startDate" value="">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-startDate" id="train-startDate" name="startDate" value="">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 col-form-label text-sm-right pr-0">
                        <label for="train-startDate" class="mb-0">
                            วันที่ขออนุมัติเดินทาง :
                        </label>
                    </div>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-startDate" id="train-startDate" name="startDate" value="">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                            </div>
                            <input type="text" class="form-control col-sm-8 col-md-3 train-startDate" id="train-startDate" name="startDate" value="">
                        </div>
                    </div>
                </div>
                <hr class="border-dotted">
                <p class="text-100 text-success">
                    <i class="fas fa-info-circle"></i> รายชื่อผู้ไปราชการ
                </p>














                <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                    <div class="text-center">
                        <button type="button" id="add-submit" class="btn btn-info border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="far fa-save text-120 mr-1"></i>
                            บันทึกข้อมูล
                        </button>
                        <button type="reset" class="btn btn-secondary border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="fas fa-redo-alt text-120 mr-1"></i>
                            ล้างข้อมูล
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>


<?= $this->endSection() ?>