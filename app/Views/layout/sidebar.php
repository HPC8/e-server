<div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-top sidebar-backdrop sidebar-white3 has-open" data-swipe="true" data-dismiss="true">


    <div class="sidebar-inner">

        <div class="flex-grow-1 ace-scroll">

            <div class="sidebar-section my-2">
                <div class="sidebar-section-item fadeable-left">

                    <div class="fadeinable sidebar-shortcuts-mini">
                        <span class="btn btn-success opacity-2"></span>
                        <span class="btn btn-info opacity-2"></span>
                        <span class="btn btn-orange opacity-2"></span>
                        <span class="btn btn-danger opacity-2"></span>
                    </div>

                    <div class="fadeable">
                        <div class="sub-arrow"></div>
                        <div>
                            <button class="btn px-25 py-2 btn-success opacity-2">
                                <i class="fa fa-signal"></i>
                            </button>

                            <button class="btn px-25 py-2 btn-info opacity-2">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn px-25 py-2 btn-orange opacity-2">
                                <i class="fa fa-users"></i>
                            </button>

                            <button class="btn px-25 py-2 btn-danger opacity-2">
                                <i class="fa fa-cogs"></i>
                            </button>
                        </div>
                    </div>

                </div>


                <div class="sidebar-section-item">
                    <i class="fadeinable fa fa-search mr-n1 text-info"></i>

                    <div class="fadeable d-inline-flex align-items-center ml-3 ml-lg-0">
                        <i class="fa fa-search mr-n3 text-info"></i>
                        <input type="text" class="sidebar-search-input pl-4 pr-3 mr-n2" maxlength="60" placeholder="Search ..." aria-label="Search">
                        <a href="#"><i class="fa fa-microphone ml-n1 text-muted"></i></a>
                    </div>
                </div>
            </div>

            <nav aria-label="Main">
                <ul class="nav flex-column mt-2 has-active-border">

                    <li <?php echo $title == 'Dashboard' ? "class='nav-item active open'" : "class='nav-item'" ?>>
                        <a href='dashboard' class="nav-link">
                            <i class="nav-icon fa fa-tachometer-alt nav-icon-round bgc-primary-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>Dashboard</span>
                            </span>
                        </a>
                        <b class="sub-arrow"></b>

                    </li>

                    <li <?php echo $title == 'ระบบบุคลากร' || $title == 'เพิ่มข้อมูลบุคลากร' ? "class='nav-item active open'" : "class='nav-item'" ?>>

                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="nav-icon fas fa-users nav-icon-round bgc-orange-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>ระบบบุคลากร</span>
                            </span>
                            <b class="caret fa fa-angle-left rt-n90"></b>
                        </a>

                        <div class="hideable submenu collapse <?php echo $title == 'ระบบบุคลากร' || $title == 'เพิ่มข้อมูลบุคลากร' ? 'show' : '' ?>">
                            <ul class="submenu-inner">
                                <li class="<?php echo $title  == 'ระบบบุคลากร' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='hr' class="nav-link">
                                        <span class="nav-text">
                                            <span>ข้อมูลบุคลากร</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="<?php echo $title  == 'เพิ่มข้อมูลบุคลากร' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='hr/register' class="nav-link">

                                        <span class="nav-text">
                                            <span>เพิ่มข้อมูลบุคลากร</span>
                                        </span>
                                    </a>
                                </li>


                            </ul>
                        </div>

                        <b class="sub-arrow"></b>

                    </li>

                    <li <?php echo $title == 'แผนงาน' || $title == 'ผลผลิต' || $title == 'กิจกรรม' || $title == 'โครงการ' ? "class='nav-item active open'" : "class='nav-item'" ?>>

                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="nav-icon fas fa-layer-group nav-icon-round bgc-green-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>แผนงานและโครงการ</span>
                            </span>
                            <b class="caret fa fa-angle-left rt-n90"></b>
                        </a>

                        <div class="hideable submenu collapse <?php echo $title == 'แผนงาน' || $title == 'ผลผลิต' || $title == 'กิจกรรม' || $title == 'โครงการ' ? 'show' : '' ?>">
                            <ul class="submenu-inner">
                                <li class="<?php echo $title  == 'แผนงาน' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='project/plan' class="nav-link">
                                        <span class="nav-text">
                                            <span>แผนงาน</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="<?php echo $title  == 'ผลผลิต' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='project/product' class="nav-link">

                                        <span class="nav-text">
                                            <span>ผลผลิต</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="<?php echo $title  == 'กิจกรรม' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='project/activity' class="nav-link">

                                        <span class="nav-text">
                                            <span>กิจกรรม</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="<?php echo $title  == 'โครงการ' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='project/program' class="nav-link">

                                        <span class="nav-text">
                                            <span>โครงการ</span>
                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <b class="sub-arrow"></b>

                    </li>

                    <li <?php echo $title == 'ขออนุมัติไปราชการ' || $title == 'ขออนุมัติจัดประชุม' ? "class='nav-item active open'" : "class='nav-item'" ?>>

                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="nav-icon fas fa-city nav-icon-round bgc-info-tp1"></i>

                            <span class="nav-text fadeable">
                                <span>ไปราชการ - จัดประชุม</span>
                            </span>
                            <b class="caret fa fa-angle-left rt-n90"></b>
                        </a>

                        <div class="hideable submenu collapse <?php echo $title == 'ขออนุมัติไปราชการ' || $title == 'ขออนุมัติจัดประชุม' ? 'show' : '' ?>">
                            <ul class="submenu-inner">
                                <li class="<?php echo $title  == 'ขออนุมัติไปราชการ' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='planning/training' class="nav-link">
                                        <span class="nav-text">
                                            <span>ขออนุมัติไปราชการ</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="<?php echo $title  == 'ขออนุมัติจัดประชุม' ? 'nav-item active' : 'nav-item' ?>">
                                    <a href='planning/meeting' class="nav-link">

                                        <span class="nav-text">
                                            <span>ขออนุมัติจัดประชุม</span>
                                        </span>
                                    </a>
                                </li>


                            </ul>
                        </div>

                        <b class="sub-arrow"></b>

                    </li>



                    <li class="nav-item">

                        <a href="#" class="nav-link dropdown-toggle collapsed">
                            <i class="nav-icon fa fa-table nav-icon-round bgc-purple-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>Tables</span>
                            </span>

                            <b class="caret fa fa-angle-left rt-n90"></b>

                            <!-- or you can use custom icons. first add `d-style` to 'A' -->
                            <!--
                    	 	<b class="caret d-n-collapsed fa fa-minus text-80"></b>
                    	 	<b class="caret d-collapsed fa fa-plus text-80"></b>
                    	 -->
                        </a>

                        <div class="hideable submenu collapse">
                            <ul class="submenu-inner">

                                <li class="nav-item">

                                    <a href="html/tables-basic.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Basic Tables</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/table-datatables.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>DataTables</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/table-bootstrap.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Bootstrap Table</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/table-jqgrid.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>jqGrid</span>
                                        </span>


                                    </a>


                                </li>

                            </ul>
                        </div>

                        <b class="sub-arrow"></b>

                    </li>


                    <li class="nav-item">

                        <a href="#" class="nav-link dropdown-toggle collapsed">
                            <i class="nav-icon fa fa-edit nav-icon-round bgc-red-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>Forms</span>
                            </span>

                            <b class="caret fa fa-angle-left rt-n90"></b>

                            <!-- or you can use custom icons. first add `d-style` to 'A' -->
                            <!--
                    	 	<b class="caret d-n-collapsed fa fa-minus text-80"></b>
                    	 	<b class="caret d-collapsed fa fa-plus text-80"></b>
                    	 -->
                        </a>

                        <div class="hideable submenu collapse">
                            <ul class="submenu-inner">

                                <li class="nav-item">

                                    <a href="html/form-basic.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Basic Elements</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/form-more.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>More Elements</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/form-wizard.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Wizard &amp; Validation</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/form-upload.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>File Upload</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/form-wysiwyg.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Wysiwyg &amp; Markdown</span>
                                        </span>


                                    </a>


                                </li>

                            </ul>
                        </div>

                        <b class="sub-arrow"></b>

                    </li>


                    <li class="nav-item">

                        <a href="html/cards.html" class="nav-link">
                            <i class="nav-icon far fa-window-restore nav-icon-round bgc-info-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>Cards</span>
                            </span>


                        </a>

                        <b class="sub-arrow"></b>

                    </li>


                    <li class="nav-item">

                        <a href="html/calendar.html" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt nav-icon-round bgc-pink-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>Calendar</span>
                                <span class="badge px-1 " title="2 Urgent Events"><i class='fas fa-exclamation-triangle text-140 text-danger-m1'></i></span>
                            </span>


                        </a>

                        <b class="sub-arrow"></b>

                    </li>


                    <li class="nav-item">

                        <a href="html/gallery.html" class="nav-link">
                            <i class="nav-icon far fa-image nav-icon-round bgc-secondary-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>Gallery</span>
                            </span>


                        </a>

                        <b class="sub-arrow"></b>

                    </li>


                    <li class="nav-item">

                        <a href="#" class="nav-link dropdown-toggle collapsed">
                            <i class="nav-icon fa fa-tag nav-icon-round bgc-brown-tp1"></i>
                            <span class="nav-text fadeable">
                                <span>More Pages</span>
                                <span class="badge badge-primary radius-2px text-90 ml-1 mr-2px badge-sm ">5</span>
                            </span>

                            <b class="caret fa fa-angle-left rt-n90"></b>

                            <!-- or you can use custom icons. first add `d-style` to 'A' -->
                            <!--
                    	 	<b class="caret d-n-collapsed fa fa-minus text-80"></b>
                    	 	<b class="caret d-collapsed fa fa-plus text-80"></b>
                    	 -->
                        </a>

                        <div class="hideable submenu collapse">
                            <ul class="submenu-inner">

                                <li class="nav-item">

                                    <a href="html/page-profile.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Profile</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/page-login.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Login</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/page-pricing.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Pricing</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/page-invoice.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Invoice</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/page-error.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Error</span>
                                        </span>


                                    </a>


                                </li>


                                <li class="nav-item">

                                    <a href="html/starter.html" class="nav-link">

                                        <span class="nav-text">
                                            <span>Starter</span>
                                        </span>


                                    </a>


                                </li>

                            </ul>
                        </div>

                        <b class="sub-arrow"></b>

                    </li>

                </ul>
            </nav>

        </div><!-- .sidebar scroll -->




    </div>
</div>