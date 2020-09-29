<!doctype html>
<html lang="en" style="--scrollbar-width:17px; --moz-scrollbar-thin:17px; font-size: 0.925rem;">

<head>
    <?php
    echo view('layout/header');
    ?>

</head>

<body>
    <div class="body-container">
        <?php
        echo view('layout/navbar');
        ?>
        <div class="main-container">

            <?php
            echo view('layout/sidebar');
            ?>

            <div role="main" class="main-content">
                <div class="page-content">

                    <?= $this->renderSection('content') ?>

                </div>

                <?php
                echo view('layout/footer');
                ?>


            </div>

            <?php
            echo view('layout/settings');
            ?>
        </div>

    </div>

    <?php
    echo view('layout/script');
    ?>

</body>

</html>