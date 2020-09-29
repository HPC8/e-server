<div class="bgc-white radius-1">
    <table class="table table-striped-default table-bordered table-borderless ">
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ปีงบประมาณ
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $plan['plan_year']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อแผนงาน
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $plan['plan_name']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ผู้บันทึกข้อมูล
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?php echo view_cell('\App\Models\UserModel::getUsername', ['data' => $plan['created_code']]);
                echo '<small class="text-90"> #วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $plan['created']]) . '</small>'; ?>
            </td>
        </tr>
        <?php
        if ($plan['modified'] != '') { ?>
            <tr>
                <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                    ผู้แก้ไขข้อมูล
                </td>
                <td class="text-90 text-secondary-d2 text-left" width="80%">
                    <?php echo view_cell('\App\Models\UserModel::getUsername', ['data' => $plan['modified_code']]);
                    echo '<small class="text-90"> #วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $plan['modified']]) . '</small>'; ?>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
</div>