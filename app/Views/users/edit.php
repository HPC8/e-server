<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div role="main" class="container-plus">
    <div class="border-t-3 w-100 brc-primary-m1 radius-t-1"></div>
    <div class="card bcard">
        <div class="card-header">
            <h3 class="card-title text-125">
                <i class="fas fa-edit text-dark-l3 mr-1"></i>
                แก้ไขข้อมูล
            </h3>
        </div>

        <div class="card-body px-3 pb-1">
            <form class="mt-lg-3" autocomplete="off" id="user-edit-form" method="post">
                <fieldset disabled>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <label for="input-titlename">
                                <strong><U>รหัสประจำตัว</U></strong>
                            </label>

                            <div class="input-group">
                                <label for="hospcode" class="text-brown">
                                    <?= "<h5><B>" . $user['hospcode'] . "</B></h5>"; ?>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="form-group">
                                <label for="input-sex">
                                    <strong><U>เพศ</U></strong>
                                </label>

                                <div class="input-group input-sex">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="bgc-blue" id="sex1" value="1" name="sex" <?= $user['sex'] == '1' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="sex1">ชาย</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="bgc-blue" id="sex2" value="2" name="sex" <?= $user['sex'] == '2' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="sex2">หญิง</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="bgc-blue" id="sex3" value="3" name="sex" <?= $user['sex'] == '3' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="sex3">อื่นๆ</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="input-marital">
                                    <strong><U>สถานภาพ</U></strong>
                                </label>

                                <div class="input-group input-marital">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="marital1" class="bgc-blue" value="1" name="marital" <?= $user['marital'] == '1' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="marital1">โสด</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="marital2" class="bgc-blue" value="2" name="marital" <?= $user['marital'] == '2' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="marital2">คู่</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="marital3" class="bgc-blue" value="3" name="marital" <?= $user['marital'] == '3' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="marital3">หม้าย</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="marital4" class="bgc-blue" value="4" name="marital" <?= $user['marital'] == '4' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="marital4">หย่า</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="marital5" class="bgc-blue" value="5" name="marital" <?= $user['marital'] == '5' ? 'checked' : '' ?> />
                                        <label class="form-check-label" for="marital5">แยก</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-blood">
                                <strong><U>กรุ๊ปเลือด</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-medkit"></i></span>
                                </div>
                                <select class="form-control input-blood" id="input-blood" name="blood">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($blood as $row) : ?>
                                        <option <?php if ($user['blood'] == $row->blood_name) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->blood_name ?>"><?= $row->blood_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-titlename">
                                <strong><U>คำนำหน้าชื่อ</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-md"></i></span>
                                </div>
                                <select class="form-control input-titlename" id="input-titlename" name="titlename">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($titlename as $row) : ?>
                                        <option <?php if ($user['titlename'] == $row->titlename_name) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->titlename_name ?>"><?= $row->titlename_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-firstname">
                                <strong><U>ชื่อ</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-firstname" id="input-firstname" name="firstname" value="<?= $user['firstname']; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-lastname">
                                <strong><U>นามสกุล</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-lastname" id="input-lastname" name="lastname" value="<?= $user['lastname']; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-cid">
                                <strong><U>เลขบัตรประชาชน</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                </div>
                                <input type="text" class="form-control input-cid" id="input-cid" name="cid" value="<?= $user['cid']; ?>" />
                            </div>
                        </div>

                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <fieldset disabled>
                            <label for="input-birthday">
                                <strong><U>วันเกิด</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control input-birthday" id="input-birthday" name="birthday" value="<?= $user['birthday']; ?>">
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <fieldset disabled>
                            <label for="input-firstnameEng">
                                <strong><U>ชื่อ</U></strong> (ภาษาอังกฤษ)
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-firstnameEng" id="input-firstnameEng" name="firstnameEng" value="<?= $user['lastname_eng']; ?>" />
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <fieldset disabled>
                            <label for="input-lastnameEng">
                                <strong><U>นามสกุล</U></strong> (ภาษาอังกฤษ)
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                </div>
                                <input type="text" class="form-control input-lastnameEng" id="input-lastnameEng" name="lastnameEng" value="<?= $user['firstname_eng']; ?>" />
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="input-email">
                            <strong><U>อีเมล์</U></strong><small class="text-brown"> *</small>
                        </label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control input-email" id="input-email" name="email" value="<?= $user['email']; ?>" />
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="input-address">
                            <strong><U>ที่อยู่</U></strong><small class="text-brown"> *</small>
                        </label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                            </div>
                            <input type="text" class="form-control input-address" id="input-address" name="address" value="<?= $user['address']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="input-province">
                            <strong><U>จังหวัด</U></strong><small class="text-brown"> *</small>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                            </div>
                            <select class="chosen-select form-control input-province" id="input-province" name="province">
                                <option value="">-- กรุณาเลือก --</option>
                                <?php foreach ($provinces as $row) : ?>
                                    <option <?php if ($user['province_id'] == $row->province_id) {
                                                echo 'selected="selected"';
                                            } ?> value="<?= $row->province_id ?>"><?= $row->province_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="input-province">
                            <strong><U>อำเภอ</U></strong><small class="text-brown"> *</small>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                            </div>
                            <select class="form-control input-amphur" id="input-amphur" name="amphur">
                                <option value="<?= $user['amphur_id']; ?>">
                                    <?= view_cell('\App\Models\LocationModel::amphurName', ['id' => $user['amphur_id']]) ?>
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="input-province">
                            <strong><U>ตำบล</U></strong><small class="text-brown"> *</small>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                            </div>
                            <select class="form-control input-district" id="input-district" name="district">
                                <option value="<?= $user['district_id']; ?>">
                                    <?= view_cell('\App\Models\LocationModel::districtName', ['id' => $user['district_id']]) ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <label for="input-mobile">
                            <strong><U>เบอร์โทรศัพท์</U></strong><small class="text-brown"> *</small>
                        </label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                            </div>
                            <input type="text" class="form-control input-mobile" id="input-mobile" name="mobile" value="<?= $user['mobile']; ?>">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <fieldset disabled>
                            <label for="input-education">
                                <strong><U>การศึกษา</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-graduate"></i></i></span>
                                </div>
                                <select class="form-control input-education" id="input-education" name="education">

                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($education as $row) : ?>
                                        <option <?php if ($user['education_id'] == $row->education_id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->education_id ?>"><?= $row->education_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <fieldset disabled>
                            <label for="input-degree">
                                <strong><U>วุฒิการศึกษา</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                </div>
                                <select class="form-control input-degree" id="input-degree" name="degree">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($degree as $row) : ?>
                                        <option <?php if ($user['degree_id'] == $row->degree_id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->degree_id ?>"><?= $row->degree_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <fieldset disabled>
                            <label for="input-branch">
                                <strong><U>สาขา</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" class="form-control input-branch" id="input-branch" name="branch" value="<?= $user['branch']; ?>">
                            </div>
                        </fieldset>
                    </div>
                </div>
                <fieldset disabled>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <label for="input-positionNo">
                                <strong><U>เลขที่ตำแหน่ง</U></strong>
                            </label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" class="form-control input-positionNo" id="input-positionNo" name="positionNo" value="<?= $user['position_number']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <label for="input-startDate">
                                <strong><U>วันเริ่มสัญญา</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control input-startDate" id="input-startDate" name="startDate" value="<?= $user['start_date']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <label for="input-stopDate">
                                <strong><U>วันสิ้นสุดสัญญา</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control input-stopDate" id="input-stopDate" name="stopDate" value="<?= $user['stop_date'] != '0000-00-00' ? $user['stop_date'] : '' ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-accountNo">
                                <strong><U>เลขที่บัญชี</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                </div>
                                <input type="text" class="form-control input-accountNo" id="input-accountNo" name="accountNo" value="<?= $user['account_number']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <label for="input-salary">
                                <strong><U>เงินเดือน</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                                </div>
                                <input type="text" class="form-control input-salary" id="input-salary" name="salary" value="<?= $user['salary']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label for="input-category">
                                <strong><U>ประเภทบุคลากร</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-shield"></i></span>
                                </div>
                                <select class="form-control input-category" id="input-category" name="category">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($category as $row) : ?>
                                        <option <?php if ($user['category_id'] == $row->category_id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->category_id ?>"><?= $row->category_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label for="input-position">
                                <strong><U>ตำแหน่ง</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-shield"></i></i></span>
                                </div>
                                <select class="form-control input-position" id="input-position" name="position">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($position as $row) : ?>
                                        <option <?php if ($user['position_id'] == $row->position_id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->position_id ?>"><?= $row->position_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <label for="input-level">
                                <strong><U>ระดับ</U></strong> (ข้าราชการ)
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-shield"></i></i></span>
                                </div>
                                <select class="form-control input-level" id="input-level" name="level">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($level as $row) : ?>
                                        <option <?php if ($user['level_id'] == $row->id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->id ?>"><?= $row->level_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="input-department">
                                <strong><U>กลุ่ม/แผนก</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-network-wired"></i></span>
                                </div>
                                <select class="form-control input-department" id="input-department" name="department">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($department as $row) : ?>
                                        <option <?php if ($user['department_id'] == $row->department_id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->department_id ?>"><?= $row->department_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="input-section">
                                <strong><U>งาน/ฝ่าย</U></strong>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-network-wired"></i></span>
                                </div>
                                <select class="form-control input-section" id="input-section" name="section">
                                    <option value="">-- กรุณาเลือก --</option>
                                    <?php foreach ($section as $row) : ?>
                                        <option <?php if ($user['section_id'] == $row->section_id) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $row->section_id ?>"><?= $row->section_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </fieldset>

                <input type="hidden" class="form-control input-hospcode" id="hospcode" name="hospcode" value="<?= $user['hospcode']; ?>">

                <div class="mt-5 border-t-1 brc-secondary-l2 py-35 mx-n25">
                    <div class="text-center">
                        <button type="button" id="user-edit-submit" class="btn btn-info border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="far fa-save text-120 mr-1"></i>
                            บันทึกข้อมูล
                        </button>
                        <button type="reset" class="btn btn-secondary border-2 brc-black-tp10 radius-round px-3 mb-1">
                            <i class="fas fa-redo-alt text-120 mr-1"></i>
                            ล้างข้อมูล
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

<?php
echo view('hr/modal/alert');
?>

<?= $this->endSection() ?>