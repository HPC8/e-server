<div class="modal fade" id="add-activity" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <form id="add-activity-form" method="post">
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
                            <label for="activity-year">
                                <strong><U>ปีงบประมาณ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <select class="form-control input-activity-year" id="activity-year" name="activityYear">
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
                            <label for="activity-ProductId">
                                <strong><U>ชื่อผลผลิต</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <select class="form-control input-activity-ProductId" id="activity-ProductId" name="activityProductId">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($productList as $row) : ?>
                                        <option value="<?= $row->product_id ?>"><?= $row->product_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="activity-name">
                                <strong><U>ชื่อกิจกรรม</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-activity-name" id="activity-name" name="activityName" placeholder="ตัวอย่าง : การจัดการอนามัยสิ่งแวดล้อมในพื้นที่พัฒนาเขตเศรษฐกิจพิเศษให้เกิดเมืองน่าอยู่อย่างยั่งยืน" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-round" data-addId="" id="add-activity"><i class="far fa-save text-120 mr-1"></i> บันทึก</button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>