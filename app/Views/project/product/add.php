<div class="modal fade" id="add-product" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <form id="add-product-form" method="post">
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
                            <label for="product-year">
                                <strong><U>ปีงบประมาณ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <select class="form-control input-product-year" id="product-year" name="productYear">
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
                            <label for="product-PlanId">
                                <strong><U>ชื่อแผนงาน</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <select class="form-control input-product-PlanId" id="product-PlanId" name="productPlanId">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($planList as $row) : ?>
                                        <option value="<?= $row->plan_id ?>"><?= $row->plan_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="product-name">
                                <strong><U>ชื่อผลผลิต</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-product-name" id="product-name" name="productName" placeholder="ตัวอย่าง : โครงการเสริมสร้างทักษะชีวิตให้มีความเข้มแข็งและมั่นคง" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-round" data-addId="" id="add-product"><i class="far fa-save text-120 mr-1"></i> บันทึก</button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>