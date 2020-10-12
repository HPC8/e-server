<div class="bgc-white radius-1">
    <table class="table table-striped-default table-bordered table-borderless ">
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ปีงบประมาณ
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $product['product_year']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อแผนงาน
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= view_cell('\App\Models\ProjectModel::planName', ['id' => $product['plan_id']]);?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ชื่อผลผลิต
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= $product['product_name']; ?>
            </td>
        </tr>
        <tr>
            <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                ผู้บันทึกข้อมูล
            </td>
            <td class="text-90 text-secondary-d2 text-left" width="80%">
                <?= view_cell('\App\Models\UserModel::getUsername', ['data' => $product['created_code']]);
                echo '<small class="text-90"> #วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $product['created']]) . '</small>'; ?>
            </td>
        </tr>
        <?php
        if ($product['modified'] != '') { ?>
            <tr>
                <td class="text-90 text-600 text-secondary-d2 text-right" width="20%">
                    ผู้แก้ไขข้อมูล
                </td>
                <td class="text-90 text-secondary-d2 text-left" width="80%">
                    <?= view_cell('\App\Models\UserModel::getUsername', ['data' => $product['modified_code']]);
                    echo '<small class="text-90"> #วันที่ ' . view_cell('\App\Libraries\Thaidate::dateFulltime', ['date' => $product['modified']]) . '</small>'; ?>
                </td>
            </tr>
        <?php
        }
        ?>

    </table>
</div>