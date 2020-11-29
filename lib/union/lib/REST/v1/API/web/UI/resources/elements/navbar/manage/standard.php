<?php

// Menu Items
$menu = '
<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"data-toggle="dropdown">Cards</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item disabled" onclick="SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS" >Dashboard</a></li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="'.SLATELY_WEBSTACK_HREF_DIR_MANAGE_VENUES_CARDS_GIFTCARDS.'" tabindex="-1" aria-disabled="true">Gift Cards</a>
                        <li><a class="dropdown-item disabled" >Event Cards</a></li>
                        <li><a class="dropdown-item disabled" >Access Cards</a></li>
                     
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"data-toggle="dropdown">Tools</a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="'.SLATELY_WEBSTACK_HREF_DIR_MANAGE_TOOLS_COUNTER.'" tabindex="-1" aria-disabled="true">Capacity Counter</a>
                    </ul>
                </li>
';

?>

<header class="navbar navbar-expand-lg navbar-light bg-light navbar-box-shadow fixed-top">
    <div class="container-fluid ">

<!--        The Logo-->
        <?php include __DIR__ . "/internal/left_logo_small.php"; ?>

<!--        Desktop Menu -->
        <div class="collapse navbar-collapse order-lg-2" id="navbarCollapse1">
            <ul class="navbar-nav mr-auto">
<!--                Cards Dropdown-->
                <?php echo $menu ?>
            </ul>
        </div>

        <div class="d-flex align-items-center order-lg-3">
            <?php include __DIR__ . "/../internal/right_profile_module.php"; ?>
        </div>
    </div>

    <div class="cs-offcanvas-collapse order-lg-2 d-lg-none" id="offcanvasMenu">
        <div class="cs-offcanvas-cap navbar-box-shadow">
            <h5 class="mt-1 mb-0">Menu</h5>
            <button class="close lead" type="button" data-toggle="offcanvas" data-offcanvas-id="offcanvasMenu"><span aria-hidden="true">×</span></button>
        </div>
        <div class="cs-offcanvas-body d-lg-none" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px -16px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;"><div class="simplebar-content" style="padding: 0px 16px;">
                                <ul class="navbar-nav">
                                    <?php echo $menu ?>

                                </ul>
                            </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 214px;"></div></div>
        </div>
    </div>

</header>
<!-- Navbar featuring off-canvas menu on mobile devices (change to .container-fluid for full width navbar) -->

