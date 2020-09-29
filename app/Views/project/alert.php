<div class="modal fade" id="alerts-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title alert-heading text-danger-m1 font-bolder">
                    <i class="fas fa-exclamation-triangle mr-1 mb-1"></i>
                    Warning
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body alert bgc-red-l4 border-none border-l-4 brc-red-tp1 radius-0">
                <?php echo session('info');
                session()->remove('msg'); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                    ปิด
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title alert-heading text-success-m1 font-bolder">
                    <i class="fas fa-check-circle mr-1 mb-1"></i>
                    Success
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body alert bgc-green-l4 border-none border-l-4 brc-green-tp1 radius-0">
                <?php echo session('info');
                session()->remove('msg'); ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">
                    ปิด
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loading-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title alert-heading text-info">
                    <i class="fas fa-cog fa-spin"></i>
                    กำลังประมวลผล
                </h5>
            </div>

            <div class="modal-body">
                <div class="text-center"><img src="assets/image/theme/loading.gif" style="max-width:360px;width:100%"></div>
            </div>
        </div>
    </div>
</div>