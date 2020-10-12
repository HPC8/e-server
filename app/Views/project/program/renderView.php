<div class="bgc-white radius-1">
    <table class="table table-striped-default table-bordered table-borderless ">
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ปีงบประมาณ
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $program['program_year']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อแผนงาน
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?php
                $productId = view_cell('\App\Models\ProjectModel::activityId', ['id' => $program['activity_id']]);
                $planId = view_cell('\App\Models\ProjectModel::productId', ['id' => $productId]);
                echo view_cell('\App\Models\ProjectModel::planName', ['id' => $planId]);
                ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อผลผลิต
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?php $productId = view_cell('\App\Models\ProjectModel::activityId', ['id' => $program['activity_id']]);
                echo view_cell('\App\Models\ProjectModel::productName', ['id' => $productId]);
                ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อกิจกรรม
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= view_cell('\App\Models\ProjectModel::activityName', ['id' => $program['activity_id']]); ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อโครงการ
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $program['program_name']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                งบประมาณ
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $program['program_money']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ผู้บันทึกข้อมูล
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= view_cell('\App\Models\UserModel::getUsername', ['data' => $program['created_code']]);
                echo '<small class="text-90"> #วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $program['created']]) . '</small>'; ?>
            </td>
        </tr>
        <?php
        if ($program['modified'] != '') { ?>
            <tr>
                <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                    ผู้แก้ไขข้อมูล
                </td>
                <td class="text-90 text-secondary-d2 text-left" width="80%">
                    <?= view_cell('\App\Models\UserModel::getUsername', ['data' => $program['modified_code']]);
                    echo '<small class="text-90"> #วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $program['modified']]) . '</small>'; ?>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
</div>