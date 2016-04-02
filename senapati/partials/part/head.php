<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo BASE_URL ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>P</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SENA</b>PATI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if(LOGIN){ ?>
                <li>
                    <a href="<?php echo BASE_URL; ?>/action/all.php?action=logout">Logout</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>