<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <form id="add-user-form" method="post">
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
                        <div class="col-sm-12">
                            <label for="input-userList">
                                <strong><U>ชื่อผู้ไปราชการ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <input type="hidden" name="trainId" value="<?= $trainingInfo['trainID']; ?>">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                </div>
                                <select class="chosen-select form-control input-userList" id="input-userList" name="userList">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($userList as $row) : ?>
                                        <option value="<?= $row->hospcode ?>"><?= $row->titlename . $row->firstname . ' ' . $row->lastname ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="input-status">
                                <strong><U>สถานะ</U></strong><small class="text-brown"> *</small>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <select class="form-control input-status" id="input-status" name="status">
                                    <?php foreach ($trainingStatus as $row) : ?>
                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label for="input-doc">
                                <strong><U>หมายเหตุ</U></strong><small class="text-brown"> *</small>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-doc" id="input-doc" name="doc" placeholder="เดินวันที่ 1 ต.ค. 63 ตอนเย็น" />
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-round" data-addId="" id="add-user"><i class="far fa-save text-120 mr-1"></i> บันทึก</button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>