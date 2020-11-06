<!doctype html>
<html lang="en" style="--scrollbar-width:17px; --moz-scrollbar-thin:17px; font-size: 0.925rem;">

<head>
    <?= view('layout/header'); ?>

</head>

<body>
    <div class="body-container">
        <?= view('layout/navbar'); ?>
        <div class="main-container">

            <?= view('layout/sidebar'); ?>

            <div role="main" class="main-content">
                <div class="page-content">

                    <?= $this->renderSection('content') ?>

                </div>

                <?= view('layout/footer'); ?>

            </div>
            
        </div>

    </div>

    <?= view('layout/script'); ?>

</body>

</html>