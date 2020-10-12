<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>


<div class="row">
    <div class="col-12 col-md-4">
        <div class="card bcard">
            <div class="card-body">
                <span class="d-none position-tl mt-2 pt-3px">
                    <span class="text-white bgc-blue-d1 ml-2 radius-b-1 py-2 px-2">
                        <i class="fa fa-star"></i>
                    </span>
                </span>

                <div class="d-flex flex-column py-3 px-lg-3 justify-content-center align-items-center">

                    <div class="pos-rel radius-2 overflow-hidden">
                        <?php
                        if ($user['avatar'] == "") { ?>
                            <img alt="Profile image" src="uploads/avatar/default.png" style="max-width:180px;width:100%" />
                        <?php
                        } else { ?>
                            <img alt="Profile image" src="uploads/avatar/<?= $user['avatar']; ?>" style="max-width:180px;width:100%" />
                        <?php
                        }
                        ?>

                    </div>
                    <div class="text-center mt-3">
                        <img data-toggle="modal" data-target="#icon" src="uploads/signature/<?= $user['hospcode'] . ".gif"; ?>" style="max-height:50px;height:100%" />
                    </div>
                    <div class="text-center mt-1">
                        <h5 class="text-120 text-dark-m3">
                            <?= $user['titlename'] . $user['firstname'] . ' ' . $user['lastname']; ?>
                        </h5>
                    </div>

                    <a href="users/edit" class="btn btn-block btn-primary"><i class="fas fa-user-edit"> </i>
                        <span class="bigger-110">แก้ไขข้อมูล</span> </a>

                    <a href="#" data-getcode="<?= $user['hospcode']; ?>" data-toggle="modal" data-target="#passwd-user" class="btn btn-block btn-success passwd-user-details"><i class="fas fa-lock"> </i>
                        <span class="bigger-110">เปลี่ยนรหัสผ่าน</span> </a>

                    <hr class="mb-1 pt-1" />
                    <hr class="brc-default-l2 w-100 mb-2" />
                    <div class="mt-n4 bgc-white-tp2 px-3 py-1 text-secondary-d3 text-90">
                        Connect with Social Media</div>



                    <div class="card-body pt-2">
                        <a href='https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=<?= $line['client_id']; ?>&redirect_uri=<?= $line['redirect_uri']; ?>&state=ci&scope=profile%20openid&nonce=_ls978_&max_age=0' class="btn btn-bgc-white btn-lighter-success btn-h-success btn-a-success btn-lg px-25 mx-1">
                            <i class="fab fa-line text-190"></i>
                        </a>
                        <a href='#' class="btn btn-bgc-white btn-lighter-primary btn-h-primary btn-a-primary btn-lg px-25 mx-1">
                            <i class="fab fa-facebook text-190"></i>
                        </a>
                        <a href='#' class="btn btn-bgc-white btn-lighter-danger btn-h-danger btn-a-danger btn-lg px-25 mx-1">
                            <i class="fab fa-google-plus text-190"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-8 mt-3 mt-md-0">
        <div class="card bcard h-100">
            <div class="card-body p-0">
                <div class="sticky-nav">
                    <div class="position-tr w-100 border-t-4 brc-blue-m2 radius-2 d-md-none"></div>

                    <ul id="profile-tabs" class="nav nav-tabs-scroll is-scrollable nav-tabs nav-tabs-simple p-1px pl-25 bgc-white border-b-1 brc-dark-l3" role="tablist">
                        <li class="nav-item mr-2 mr-lg-3">
                            <a class="d-style nav-link active px-2 py-35 brc-green-tp1" data-toggle="tab" href="#profile-tab-overview" role="tab" aria-controls="profile-tab-overview" aria-selected="true">
                                <span class="d-n-active text-dark-l1">1. ข้อมูลทั่วไป</span>
                                <span class="d-active text-dark-m3">1. ข้อมูลทั่วไป</span>
                            </a>
                        </li>

                        <li class="nav-item mr-2 mr-lg-3">
                            <a class="d-style nav-link px-2 py-35 brc-green-tp1" data-toggle="tab" href="#profile-tab-activity" role="tab" aria-controls="profile-tab-activity" aria-selected="false">
                                <span class="d-n-active text-dark-l1">2. ข้อมูลการศึกษา</span>
                                <span class="d-active text-dark-m3">2. ข้อมูลการศึกษา</span>
                            </a>
                        </li>

                        <li class="nav-item mr-2 mr-lg-3">
                            <a class="d-style nav-link px-2 py-35 brc-green-tp1" data-toggle="tab" href="#profile-tab-timeline" role="tab" aria-controls="profile-tab-timeline" aria-selected="false">
                                <span class="d-n-active text-dark-l1">3. ข้อมูลครอบครัว</span>
                                <span class="d-active text-dark-m3">3. ข้อมูลครอบครัว</span>
                            </a>
                        </li>

                        <li class="nav-item mr-2 mr-lg-3">
                            <a class="d-style nav-link px-2 py-35 brc-green-tp1" data-toggle="tab" href="#profile-tab-edit" role="tab" aria-controls="profile-tab-edit" aria-selected="false">
                                <span class="d-n-active text-dark-l1">4. ประวัติการฝึกอบรม</span>
                                <span class="d-active text-dark-m3">4. ประวัติการฝึกอบรม</span>
                            </a>
                        </li>
                        <li class="nav-item mr-2 mr-lg-3">
                            <a class="d-style nav-link px-2 py-35 brc-green-tp1" data-toggle="tab" href="#profile-tab-note" role="tab" aria-controls="profile-tab-note" aria-selected="false">
                                <span class="d-n-active text-dark-l1"><i class="fas fa-database"> </i> Note</span>
                                <span class="d-active text-dark-m3"><i class="fas fa-database"> </i> Note</span>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.sticky-nav-md -->


                <div class="tab-content px-0 tab-sliding flex-grow-1 border-0">

                    <!-- overview tab -->
                    <div class="tab-pane active show px-1 px-md-2 px-lg-4" id="profile-tab-overview">

                        <div class="row mt-3">
                            <div class="col-12 px-4 mb-3">

                                <h4 class="text-dark-m3 text-140">
                                    <i class="fa fa-info text-blue mr-1 w-2"></i>
                                    ข้อมูลทั่วไป
                                </h4>

                                <hr class="w-100 mx-auto mb-0 brc-default-l2" />

                                <div class="bgc-white radius-1">
                                    <table class="table table table-striped-default table-borderless">
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                รหัสประจำตัว
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['hospcode']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ชื่อ-สกุล
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['titlename'] . $user['firstname'] . ' ' . $user['lastname']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ชื่อ-สกุล (English)
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['lastname_eng'] . ' ' . $user['firstname_eng']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                เพศ
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['sex_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                สถานภาพ
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['marital_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                เกิดวันที่
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= view_cell('\App\Libraries\Thaidate::dateFullmonth', ['date' => $user['birthday']]) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                อายุ
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= view_cell('\App\Libraries\Thaidate::birthday', ['date' => $user['birthday']]) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                กรุ๊ปเลือด
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['blood']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                เลขบัตรประชาชน
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['cid']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ที่อยู่
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['address'] . " ต." . $user['district_name'] . " อ." . $user['amphur_name'] . " จ." . $user['province_name'] . " " . $user['zipcode']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                อีเมล์
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['email']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                เบอร์โทรศัพท์
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['mobile']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                การศึกษา
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['education_name'] . " " . $user['degree_name'] . " สาขา " . $user['branch']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ประเภทบุคลากร
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['category_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ตำแหน่ง
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['position_name'] . " " . $user['level_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                งาน
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['section_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                กลุ่ม
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['department_name']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                วันเริ่มสัญญา
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= view_cell('\App\Libraries\Thaidate::dateFullmonth', ['date' => $user['start_date']]) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                วันสิ้นสุดสัญญา
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= view_cell('\App\Libraries\Thaidate::dateFullmonth', ['date' => $user['stop_date']]) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                สถานะการปฏิบัติงาน
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?= $user['status'] == '1' ? 'กำลังปฏิบัติงาน' : 'จำหน่ายแล้ว' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ผู้บันทึกข้อมูล
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?php
                                                echo view_cell('\App\Models\UserModel::getUsername', ['date' => $user['add_by']]);
                                                echo '<small class="text-90"> : วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $user['add_date']]) . '</small>';
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-90 text-secondary-d2 text-right" width="25%">
                                                ปรับข้อมูลล่าสุด
                                            </td>
                                            <td class="text-90 text-600 text-secondary-d2 text-left" width="75%">
                                                <?php if ($user['edit_by'] != '') {
                                                    echo view_cell('\App\Models\UserModel::getUsername', ['date' => $user['edit_by']]);
                                                    echo '<small class="text-90"> : วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $user['edit_date']]) . '</small>';
                                                } else {
                                                    echo view_cell('\App\Models\UserModel::getUsername', ['date' => $user['add_by']]);
                                                    echo '<small class="text-90"> : วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $user['add_date']]) . '</small>';
                                                } ?>

                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>


                    <!-- activity tab -->
                    <div class="tab-pane px-1 px-md-2 px-lg-3" id="profile-tab-activity">
                        <div class="alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115">
                            <i class="fas fa-info mr-2 mb-1 text-110 text-blue-d1 align-middle"></i>
                            ข้อมูลอยู่ระหว่างการพัฒนาระบบ
                        </div>
                    </div>

                    <!-- timeline tab -->
                    <div class="tab-pane px-1 px-md-2 px-lg-3" id="profile-tab-timeline">
                        <div class="alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115">
                            <i class="fas fa-info mr-2 mb-1 text-110 text-blue-d1 align-middle"></i>
                            ข้อมูลอยู่ระหว่างการพัฒนาระบบ
                        </div>

                    </div>

                    <!-- profile edit tab -->
                    <div class="tab-pane px-1 px-md-2 px-lg-4" id="profile-tab-edit">
                        <div class="alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115">
                            <i class="fas fa-info mr-2 mb-1 text-110 text-blue-d1 align-middle"></i>
                            ข้อมูลอยู่ระหว่างการพัฒนาระบบ
                        </div>
                    </div>
                    <!-- profile edit tab -->
                    <div class="tab-pane px-1 px-md-2 px-lg-4" id="profile-tab-note">
                        <div class="alert bgc-secondary-l3 text-dark-m1 border-none border-l-4 brc-blue radius-0 py-3 text-115">
                            <?= $user['note']; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (session('msg') == '1') { { ?>
        <a id="alerts-auto" data-toggle="modal" data-target="#alerts-modal"></a>
    <?php }
} elseif (session('msg') == '0') { ?>
    <a id="success-auto" data-toggle="modal" data-target="#success-modal"></a>
<?php }
?>

<?php
echo view('users/modal/alert');
echo view('users/modal/passwd');
?>

<?= $this->endSection() ?>