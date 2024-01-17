<!-- main menu header-->
<div class="main-menu-header">
    <input type="text" placeholder="Search" class="menu-search form-control round">
</div>
<!-- / main menu header-->
<div class="main-menu-content">
    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
        <li class="nav-item <?php if ($active_page == 'dashboard') echo 'active'; ?>">
            <a href="<?php echo site_url('admin/dashboard'); ?>"><i class="icon-home3"></i><span data-i18n="nav.navbars.main" class="menu-title">Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a href="#"><i class="icon-video"></i><span data-i18n="nav.navbars.main" class="menu-title">Video Tools</span></a>
            <ul class="menu-content">
                <li class="<?php if ($active_page == 'ls-category') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/ls-category'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Video Categories</a>
                </li>

                <li class="<?php if ($active_page == 'new-category' || $active_page == 'edit-category') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/new-category'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Create New Category</a>
                </li>

                <li class="<?php if ($active_page == 'ls-videos') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/ls-videos'); ?>"  data-i18n="nav.navbars.nav_light" class="menu-item">Video List</a>
                </li>

                <li class="<?php if ($active_page == 'video-upload') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/video-upload'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Upload Video</a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#"><i class="icon-cube"></i><span data-i18n="nav.navbars.main" class="menu-title">Ads / Products</span></a>
            <ul class="menu-content">
                <li class="<?php if ($active_page == 'ls-products') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/ls-products'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Ads/Product List</a>
                </li>

                <li class="<?php if ($active_page == 'new-product') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/new-product'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Add New Advert</a>
                </li>

                <li class="<?php if ($active_page == 'product-orders') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/product-orders'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Pending Orders</a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="#"><i class="icon-star"></i><span data-i18n="nav.navbars.main" class="menu-title">Memberships</span></a>
            <ul class="menu-content">
                <li class="<?php if ($active_page == 'ls-subscribers') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/ls-subscribers'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Subscribers</a>
                </li>

                <li class="<?php if ($active_page == 'ls-subscription-plans') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/ls-subscription-plan'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Subscription Plans</a>
                </li>

                <li class="<?php if ($active_page == 'new-subscription-plan') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/new-subscription-plan'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">New Subscription Plan</a>
                </li>
            </ul>
        </li>


        <li class="nav-item">
            <a href="#"><i class="icon-person"></i><span data-i18n="nav.navbars.main" class="menu-title">My Account</span></a>
            <ul class="menu-content">
                <li class="<?php if ($active_page == 'change-password') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/change-password'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Change Password</a>
                </li>

                <li class="<?php if ($active_page == 'logout') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/logout'); ?>" data-i18n="nav.navbars.nav_light" class="menu-item">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</div>