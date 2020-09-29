<input type="hidden" name="productId" value="<?= $product['product_id']; ?>">
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
                    <option <?php if ($i == $product['product_year']) {
                                echo 'selected="selected"';
                            } ?> value="<?php echo $i ?>"><?php echo $i ?> </option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <label for="product-planId">
            <strong><U>ชื่อแผนงาน</U></strong><small class="text-brown"> *</small>
        </label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tag"></i></span>
            </div>
            <select class="form-control input-product-planId" id="product-planId" name="planId">
                <option value="">-- กรุณาเลือก --</option>
                <?php foreach ($planList as $row) : ?>
                    <option <?php if ($row->plan_id == $product['plan_id']) {
                                echo 'selected="selected"';
                            } ?> value="<?= $row->plan_id ?>"><?= $row->plan_name ?></option>
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
            <input type="text" class="form-control input-product-name" id="product-name" name="productName" placeholder="ตัวอย่าง : บูรณาการพัฒนาพื้นที่เขตเศรษฐกิจพิเศษ" value="<?= $product['product_name']; ?>" />
        </div>
    </div>
</div>