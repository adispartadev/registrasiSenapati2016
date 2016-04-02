<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div style="width: 100%; background: #FFF; border-radius: 10px;" >
                <img src="<?php echo BASE_URL ?>/resources/logo.png" class="img-circle" alt="User Image" style="width: 100%" />
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo BASE_URL ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>

            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Peserta</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="umum"><a href="<?php echo BASE_URL.'/registrasi/umum'; ?>"> Registrasi Umum</a></li>
                    <li class="pelajar"><a href="<?php echo BASE_URL.'/registrasi/pelajar'; ?>"> Registrasi Pelajar</a></li>
                    <?php if(LOGIN){ ?>
                    <li class="umum"><a href="<?php echo BASE_URL.'/lihatdata/pesertaumum'; ?>"> Lihat Umum</a></li>
                    <li class="pelajar"><a href="<?php echo BASE_URL.'/lihatdata/pesertapelajar'; ?>"> Lihat Pelajar</a></li>
                    <?php } ?>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Pemakalah</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="pemakalah"><a href="<?php echo BASE_URL.'/registrasi/pemakalah'; ?>"> Registrasi Pemakalah</a></li>
                    <?php if(LOGIN){ ?>
                    <li class="pelajar"><a href="<?php echo BASE_URL.'/lihatdata/pemakalah'; ?>"> Lihat Pemakalah</a></li>
                    <?php } ?>
                </ul>
            </li>

        </ul>
    </section>
</aside>