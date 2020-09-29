<input type="hidden" name="activityId" value="<?= $activity['activity_id']; ?>">
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
                    <option <?php if ($i == $activity['activity_year']) {
                                echo 'selected="selected"';
                            } ?> value="<?php echo $i ?>"><?php echo $i ?> </option>
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
                    <option <?php if ($row->product_id == $activity['product_id']) {
                                echo 'selected="selected"';
                            } ?> value="<?= $row->product_id ?>"><?= $row->product_name ?></option>
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
            <input type="text" class="form-control input-activity-name" id="activity-name" name="activityName" placeholder="ตัวอย่าง : การจัดการอนามัยสิ่งแวดล้อมในพื้นที่พัฒนาเขตเศรษฐกิจพิเศษให้เกิดเมืองน่าอยู่อย่างยั่งยืน" value="<?= $activity['activity_name']; ?>" />
        </div>
    </div>
</div>