<div class="modal fade" id="add-program" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <form id="add-program-form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title alert-heading text-success-m1 font-bolder">
                        <i class="fas fa-plus"></i>
                        เพิ่มข้อมูล
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="program-year">
                                <strong><U>ปีงบประมาณ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <select class="form-control input-program-year" id="program-year" name="programYear">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php for ($i = date("Y") + 543; $i <= date("Y") + 543 + 5; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="program-activityId">
                                <strong><U>ชื่อกิจกรรม</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <select class="form-control input-program-activityId" id="program-activityId" name="activityId">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($activityList as $row) : ?>
                                        <option value="<?= $row->activity_id ?>"><?= $row->activity_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="program-name">
                                <strong><U>ชื่อโครงการ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-program-name" id="program-name" name="programName" placeholder="ตัวอย่าง : โครงการขับเคลื่อนมหัศจรรย์1000 วันแรกของชีวิตเพื่อความรอบรู้สู่การมีสุขภาพที่ดีของแม่และเด็ก" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="program-money">
                                <strong><U>งบประมาณ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                                </div>
                                <input type="number" step="0.01" min="0" value="0.00" class="form-control input-program-money" id="program-money" name="programMoney" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-round" data-addId="" id="add-program"><i class="far fa-save text-120 mr-1"></i> บันทึก</button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>