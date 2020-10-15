<header class="navbar navbar-expand-lg navbar-light animate__animated animate__fadeIn ">
    <div class="container px-0 px-xl-3 mt-3">
        <a class="navbar-brand order-lg-1 mr-0 pr-lg-2 mr-lg-4" href="#">
            <img class="d-none d-lg-block mt-3"  width="50" src="/src/media/images/slately_logo_large_untexted.png" alt="Slately"/>
            <img class="d-lg-none mt-3 ml-3" width="28" src="/src/media/images/slately_logo_large_untexted.png" alt="Slately"/>
        </a>
        <div class="d-flex align-items-center order-lg-3">
            <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbarCollapse3">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-secondary  mr-1 d-none d-lg-block" type="button">Host your Venue</button>
            <!--            <div class="navbar-tool d-none d-sm-flex"><a class="navbar-tool-icon-box" href="#"><i class="fe-maximize"></i> </a> Your Pass</div>-->
            <div class="border-left mr-3 ml-3" style="height: 30px;"></div>
            <div class="navbar-tool dropdown">
                <a class="navbar-tool-icon-box" href="#">
                    <img class="navbar-tool-icon-box-img" src="../../src/media/images/default_profile.png" alt="Avatar"/>
                </a>
                <a class="navbar-tool-label dropdown-toggle" href="#"><small><?php echo (\Union\API\security\Auth::logged_in() ? "Hello," : "Hey There!") ?></small> <?php if (\Union\API\security\Auth::logged_in()) {
                        echo \Union\API\accounts\Account::get_first_name(\Union\API\security\Auth::logged_in());
                    }else{
                        echo "<span onclick='window.location = \"/login\"'>Login or Signup</span>";
                    }?></a>
                <ul class="dropdown-menu dropdown-menu-right <?php if (!\Union\API\security\Auth::logged_in()) echo "d-none";?>" style="width: 15rem;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-shopping-bag font-size-base opacity-60 mr-2"></i>
                            Orders
                            <span class="nav-indicator"></span>
                            <span class="ml-auto font-size-xs text-muted">2</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-dollar-sign font-size-base opacity-60 mr-2"></i>
                            Sales
                            <span class="ml-auto font-size-xs text-muted">$735.00</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-message-square font-size-base opacity-60 mr-2"></i>
                            Messages
                            <span class="nav-indicator"></span>
                            <span class="ml-auto font-size-xs text-muted">1</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-users font-size-base opacity-60 mr-2"></i>
                            Followers
                            <span class="ml-auto font-size-xs text-muted">146</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-star font-size-base opacity-60 mr-2"></i>
                            Reviews
                            <span class="ml-auto font-size-xs text-muted">15</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-heart font-size-base opacity-60 mr-2"></i>
                            Favorites
                            <span class="ml-auto font-size-xs text-muted">6</span>
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="fe-log-out font-size-base opacity-60 mr-2"></i>
                            Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
