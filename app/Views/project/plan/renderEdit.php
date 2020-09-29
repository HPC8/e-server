<input type="hidden" name="planId" value="<?= $plan['plan_id']; ?>">
<div class="form-group row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label for="plan-year">
            <strong><U>ปีงบประมาณ</U></strong><small class="text-brown"> *</small>
        </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
            <select class="form-control input-plan-year" id="plan-year" name="planYear">
                <option value="">-- กรุณาเลือก --</option>
                <?php for ($i = date("Y") + 543; $i <= date("Y") + 543 + 5; $i++) { ?>
                    <option <?php if ($i == $plan['plan_year']) {
                                echo 'selected="selected"';
                            } ?> value="<?php echo $i ?>"><?php echo $i ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label for="plan-name">
            <strong><U>ชื่อแผนงาน</U></strong><small class="text-brown"> *</small>
        </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tag"></i></span>
            </div>
            <input type="text" class="form-control input-plan-name" id="plan-name" name="planName" placeholder="ตัวอย่าง : บูรณาการพัฒนาพื้นที่เขตเศรษฐกิจพิเศษ" value="<?= $plan['plan_name']; ?>" />
        </div>
    </div>
</div>