<div class="modal fade" id="edit-activity" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog" role="document">
        <form id="edit-activity-form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title alert-heading text-secondary-m1 font-bolder">
                        <i class="fas fa-edit"></i>
                        แก้ไขข้อมูล
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="render-edit-activity">
                    <div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-round" data-editId="" id="edit-activity"><i class="far fa-save text-120 mr-1"></i> บันทึก</button>
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal"><i class="fas fa-times"></i> ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>