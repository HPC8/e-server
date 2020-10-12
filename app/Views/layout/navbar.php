<nav class="navbar navbar-expand-lg navbar-fixed navbar-teal">
    <div class="navbar-inner">

        <div class="navbar-intro justify-content-xl-between">

            <button type="button" class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none" data-toggle-mobile="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="bars"></span>
            </button><!-- mobile sidebar toggler button -->

            <a class="navbar-brand text-white" href="#">
            <i class="fas fa-layer-group"></i>
                <span>E-Service</span>
                <span>App</span>
            </a><!-- .navbar-brand -->

            <button type="button" class="btn btn-burger mr-2 d-none d-xl-flex" data-toggle="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                <span class="bars"></span>
            </button><!-- sidebar toggler button -->

        </div><!-- .navbar-intro -->


        <div class="navbar-content">
            <?php
            if (isset($breadcrumb) &&  !is_null($breadcrumb)) {
            ?>
                <div class="navbar-content d-none d-xl-flex">
                    <ol class="breadcrumb pl-2 ml-3">
                        <?php
                        foreach ($breadcrumb as $key => $value) {
                            if ($value != '') {
                        ?>
                                <li class="breadcrumb-item active"> <a href="<?= $value; ?>"><?= $key; ?></a>
                                </li>
                            <?php } else { ?>
                                <li class="breadcrumb-item active"><?= $key; ?></li>
                        <?php }
                        }
                        ?>
                    </ol>
                </div>
            <?php
            }
            ?>

        </div>


        <!-- mobile #navbarMenu toggler button -->
        <button class="navbar-toggler ml-1 mr-2 px-1" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navbar menu">
            <span class="pos-rel">
                <?php
                if ($user['avatar'] == "") { ?>
                    <img class="border-2 brc-white-tp1 radius-round" width="36" src="uploads/avatar/default.png" alt="User avatar">
                    <img id="id-navbar-user-image" class="d-none d-lg-inline-block radius-5 border-2 brc-white-tp1 mr-2 w-6" src="uploads/avatar/default.png" style="max-width:35px;width:100%">
                <?php
                } else { ?>
                    <img class="border-2 brc-white-tp1 radius-round" width="36" src="uploads/avatar/<?= $user['avatar']; ?>" alt="User avatar">
                <?php
                }
                ?>

            </span>
        </button>


        <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">

            <div class="navbar-nav">
                <ul class="nav border-0 has-active-border">

                    <li class="nav-item dropdown dropdown-mega">
                        <a class="nav-link dropdown-toggle pl-lg-3 pr-lg-4" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell text-110 icon-animated-bell mr-lg-2"></i>

                            <span class="d-inline-block d-lg-none ml-2">Notifications</span><!-- show only on mobile -->
                            <span id="id-navbar-badge1" class="badge badge-sm bgc-warning radius-round text-85 border-1 brc-white-tp3">3</span>

                            <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                            <div class="dropdown-caret brc-white"></div>
                        </a>
                        <div class="dropdown-menu dropdown-sm dropdown-animated p-0 bg-white brc-primary-m3 border-b-2 shadow">
                            <ul class="nav nav-tabs nav-tabs-simple w-100 nav-justified dropdown-clickable border-b-1 brc-secondary-l2" role="tablist">
                                <li class="nav-item">
                                    <a class="d-style px-0 mx-0 py-3 nav-link active text-600 brc-blue-m1 text-dark-tp5 bgc-h-blue-l4" data-toggle="tab" href="#navbar-notif-tab-1" role="tab">
                                        <span class="d-active text-blue-d1 text-105">Notifications</span>
                                        <span class="d-n-active">Notifications</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-style px-0 mx-0 py-3 nav-link text-600 brc-purple-m1 text-dark-tp5 bgc-h-purple-l4" data-toggle="tab" href="#navbar-notif-tab-2" role="tab">
                                        <span class="d-active text-purple-d1 text-105">Messages</span>
                                        <span class="d-n-active">Messages</span>
                                    </a>
                                </li>
                            </ul><!-- .nav-tabs -->


                            <div class="tab-content tab-sliding p-0">

                                <div class="tab-pane mh-none show active px-md-1 pt-1" id="navbar-notif-tab-1" role="tabpanel">

                                    <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                        <i class="fab fa-twitter bgc-blue-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                        <span class="text-muted">Followers</span>
                                        <span class="float-right badge badge-danger radius-round text-80">- 4</span>
                                    </a>
                                    <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                        <i class="fa fa-comment bgc-pink-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                        <span class="text-muted">New Comments</span>
                                        <span class="float-right badge badge-info radius-round text-80">+12</span>
                                    </a>
                                    <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                        <i class="fa fa-shopping-cart bgc-success-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                        <span class="text-muted">New Orders</span>
                                        <span class="float-right badge badge-success radius-round text-80">+8</span>
                                    </a>
                                    <a href="#" class="mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                        <i class="far fa-clock bgc-purple-tp1 text-white text-110 mr-15 p-2 radius-1"></i>
                                        <span class="text-muted">Finished processing data!</span>
                                    </a>

                                    <hr class="mt-1 mb-1px brc-secondary-l2" />
                                    <a href="#" class="mb-0 py-3 border-0 list-group-item text-blue-m1 text-uppercase text-center text-85 font-bolder">
                                        See All Notifications
                                        <i class="ml-2 fa fa-arrow-right text-muted"></i>
                                    </a>

                                </div><!-- .tab-pane : notifications -->


                                <div class="tab-pane mh-none pl-md-2" id="navbar-notif-tab-2" role="tabpanel">
                                    <div data-ace-scroll='{"ignore": "mobile", "height": 300, "smooth":true}'>
                                        <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <img alt="Alex's avatar" src="assets/image/avatar/avatar.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                            <div>
                                                <span class="text-primary-m1 font-bolder">Alex:</span>
                                                <span class="text-grey text-90">Ciao sociis natoque penatibus et auctor ...</span>
                                                <br />
                                                <span class="text-grey-m1 text-85">
                                                    <i class="far fa-clock"></i>
                                                    a moment ago
                                                </span>
                                            </div>
                                        </a>
                                        <hr class="my-1px brc-grey-l3" />
                                        <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <img alt="Susan's avatar" src="assets/image/avatar/avatar3.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                            <div>
                                                <span class="text-primary-m1 font-bolder">Susan:</span>
                                                <span class="text-grey text-90">Vestibulum id ligula porta felis euismod ...</span>
                                                <br />
                                                <span class="text-grey-m1 text-85">
                                                    <i class="far fa-clock"></i>
                                                    20 minutes ago
                                                </span>
                                            </div>
                                        </a>
                                        <hr class="my-1px brc-grey-l3" />
                                        <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <img alt="Bob's avatar" src="assets/image/avatar/avatar4.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                            <div>
                                                <span class="text-primary-m1 font-bolder">Bob:</span>
                                                <span class="text-grey text-90">Nullam quis risus eget urna mollis ornare ...</span>
                                                <br />
                                                <span class="text-grey-m1 text-85">
                                                    <i class="far fa-clock"></i>
                                                    3:15 pm
                                                </span>
                                            </div>
                                        </a>
                                        <hr class="my-1px brc-grey-l3" />
                                        <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <img alt="Kate's avatar" src="assets/image/avatar/avatar2.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                            <div>
                                                <span class="text-primary-m1 font-bolder">Kate:</span>
                                                <span class="text-grey text-90">Ciao sociis natoque eget urna mollis ornare ...</span>
                                                <br />
                                                <span class="text-grey-m1 text-85">
                                                    <i class="far fa-clock"></i>
                                                    1:33 pm
                                                </span>
                                            </div>
                                        </a>
                                        <hr class="my-1px brc-grey-l3" />
                                        <a href="#" class="d-flex mb-0 border-0 list-group-item list-group-item-action btn-h-lighter-secondary">
                                            <img alt="Fred's avatar" src="assets/image/avatar/avatar5.png" width="48" class="align-self-start border-2 brc-primary-m3 p-1px mr-2 radius-round" />
                                            <div>
                                                <span class="text-primary-m1 font-bolder">Fred:</span>
                                                <span class="text-grey text-90">Vestibulum id penatibus et auctor ...</span>
                                                <br />
                                                <span class="text-grey-m1 text-85">
                                                    <i class="far fa-clock"></i>
                                                    10:09 am
                                                </span>
                                            </div>
                                        </a>

                                    </div><!-- ace-scroll -->

                                    <hr class="my-1px brc-secondary-l2 border-double" />
                                    <a href="#" class="mb-0 py-3 border-0 list-group-item text-purple-m1 text-uppercase text-center text-85 font-bolder">
                                        See All Messages
                                        <i class="ml-2 fa fa-arrow-right text-muted"></i>
                                    </a>
                                </div><!-- .tab-pane : messages -->

                            </div>
                        </div>
                    </li>

                    <li class="nav-item dd-backdrop dropdown dropdown-mega">
                        <a class="nav-link dropdown-toggle pl-lg-3 pr-lg-4" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-flask text-110 icon-animated-vertical mr-lg-1"></i>

                            <span class="d-inline-block d-lg-none ml-2">Tasks</span><!-- show only on mobile -->
                            <span id="id-navbar-badge2" class="badge badge-sm text-95 text-white">+2</span>

                            <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                            <div class="dropdown-caret brc-warning-l2"></div>
                        </a>
                        <div class="dropdown-menu dropdown-xs dropdown-animated animated-1 p-0 bgc-white brc-warning-l1 shadow">
                            <div class="bgc-orange-l2 py-25 px-4 border-b-1 brc-orange-l2">
                                <span class="text-dark-tp4 text-600 text-90 text-uppercase">
                                    <i class="fa fa-check mr-2px text-warning-d2 text-120"></i>
                                    4 Tasks to complete
                                </span>
                            </div>


                            <div class="px-4 py-2">
                                <div class="text-95">
                                    <span class="text-grey-d1">Software update</span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bgc-info" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                </div>
                            </div>

                            <hr class="my-1 mx-4" />
                            <div class="px-4 py-2">
                                <div class="text-95">
                                    <span class="text-grey-d1">Hardware upgrade</span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bgc-warning" role="progressbar" style="width: 40%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">40%</div>
                                </div>
                            </div>

                            <hr class="my-1 mx-4" />
                            <div class="px-4 py-2">
                                <div class="text-95">
                                    <span class="text-grey-d1">Customer support</span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bgc-danger" role="progressbar" style="width: 30%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">30%</div>
                                </div>
                            </div>

                            <hr class="my-1 mx-4" />
                            <div class="px-4 py-2">
                                <div class="text-95">
                                    <span class="text-grey-d1">Fixing bugs</span>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bgc-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">85%</div>
                                </div>
                            </div>




                            <hr class="my-1px mx-2 brc-info-l2 " />
                            <a href="#" class="d-block bgc-h-primary-l4 py-3 border-0 text-center text-blue-m2">
                                <span class="text-85 text-600 text-uppercase">See All Tasks</span>
                                <i class="ml-2 fa fa-arrow-right text-muted"></i>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown order-first order-lg-last dropdown-hover">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php
                            if ($user['avatar'] == "") { ?>
                                <img id="id-navbar-user-image" class="d-none d-lg-inline-block radius-5 border-2 brc-white-tp1 mr-2 w-6" src="uploads/avatar/default.png" style="max-width:35px;width:100%">
                            <?php
                            } else { ?>
                                <img id="id-navbar-user-image" class="d-none d-lg-inline-block radius-5 border-2 brc-white-tp1 mr-2 w-6" src="uploads/avatar/<?= $user['avatar']; ?>" style="max-width:35px;width:100%">
                            <?php
                            }
                            ?>

                            <span class="d-inline-block d-lg-none d-xl-inline-block">
                                <span class="text-90" id="id-user-welcome"><?php echo $user['titlename'] . $user['firstname'] . ' ' . $user['lastname']; ?></span>
                                <span class="text-70 nav-user-name"><?php echo $user['position_name'] . $user['level_name']; ?></span>
                            </span>

                            <i class="caret fa fa-angle-down d-none d-xl-block"></i>
                            <i class="caret fa fa-angle-left d-block d-lg-none"></i>
                        </a>

                        <div class="dropdown-menu dropdown-caret dropdown-menu-right dropdown-animated brc-primary-m3">
                            <div class="d-none d-lg-block d-xl-none">
                                <div class="dropdown-header">
                                    Welcome, Jason
                                </div>
                                <div class="dropdown-divider"></div>
                            </div>

                            <a class="dropdown-item btn btn-outline-grey btn-h-lighter-primary btn-a-lighter-primary" href="users/profile">
                                <i class="fa fa-user text-primary-m1 text-105 mr-1"></i>
                                Profile
                            </a>

                            <a class="dropdown-item btn btn-outline-grey btn-h-lighter-success btn-a-lighter-success" href="#" data-toggle="modal" data-target="#id-ace-settings-modal">
                                <i class="fa fa-cog text-success-m1 text-105 mr-1"></i>
                                Settings
                            </a>

                            <div class="dropdown-divider brc-primary-l2"></div>

                            <a class="dropdown-item btn btn-outline-grey btn-h-lighter-secondary btn-a-lighter-secondary" href="users/logout">
                                <i class="fa fa-power-off text-warning-d1 text-105 mr-1"></i>
                                Logout
                            </a>
                        </div>
                    </li><!-- .nav-item:last -->

                </ul><!-- .navbar-nav menu -->
            </div><!-- .navbar-nav -->

        </div><!-- .navbar-menu.navbar-collapse -->

    </div>
</nav>