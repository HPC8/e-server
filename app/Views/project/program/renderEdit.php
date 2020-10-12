<input type="hidden" name="programId" value="<?= $program['program_id']; ?>">
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
                    <option <?php if ($i == $program['program_year']) {
                                echo 'selected="selected"';
                            } ?> value="<?= $i ?>"><?= $i ?> </option>
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
                    <option <?php if ($row->activity_id == $program['activity_id']) {
                                echo 'selected="selected"';
                            } ?> value="<?= $row->activity_id ?>"><?= $row->activity_name ?></option>
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
            <input type="text" class="form-control input-program-name" id="program-name" name="programName" value="<?= $program['program_name']; ?>" placeholder="ตัวอย่าง : โครงการขับเคลื่อนมหัศจรรย์1000 วันแรกของชีวิตเพื่อความรอบรู้สู่การมีสุขภาพที่ดีของแม่และเด็ก" />
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
            <input type="number" step="0.01" min="0" value="<?= $program['program_money']; ?>" class="form-control input-program-money" id="program-money" name="programMoney" />
        </div>
    </div>
</div>