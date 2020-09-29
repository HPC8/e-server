<!-- hidden -->
<input type="hidden" id="hospcode" class="form-control input-user-hospcode" name="hospcode" value="<?= $user['hospcode']; ?>">
<div class="form-group row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label for="passwd-old">
            <strong><U>รหัสผ่านปัจจุบัน</U></strong><small class="text-brown"> *</small>
        </label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-unlock"></i></span>
            </div>
            <input type="password" class="form-control input-passwd-old" id="passwd-old" name="passwd_old" />
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label for="passwd-new">
            <strong><U>รหัสผ่านใหม่</U></strong><small class="text-brown"> *</small>
        </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" class="form-control input-passwd-new" id="passwd-new" name="passwd_new" value="" placeholder="กรุณาใส่ 6-32 ตัวอักษร ที่มีทั้งตัวพิมพ์เล็กพิมพ์ใหญ่และตัวเลข" />
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <input type="password" class="form-control input-passwd-confirm" id="passwd-confirm" name="passwd_confirm" value="" placeholder="กรุณายืนยันรหัสผ่านของคุณอีกครั้ง" />
        </div>
    </div>
</div>