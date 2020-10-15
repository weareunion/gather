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
                    <i class="fe-calendar font-size-lg opacity-60 mr-2"></i>
                    My Events
<!--                    <span class="nav-indicator"></span>-->
                    <span class="ml-auto font-size-xs text-muted">2</span>
                </a>
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="fe-message-square font-size-base opacity-60 mr-2"></i>
                    Messages
                    <span class="nav-indicator"></span>
                    <span class="ml-auto font-size-xs text-muted">1</span>
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="fe-heart font-size-base opacity-60 mr-2"></i>
                    Saved
                </a>
            </li>
            <li class="dropdown-divider mt-2 mb-2"></li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="fe-user font-size-base opacity-60 mr-2"></i>
                    Account
                </a>
            </li>
            <li class="dropdown-divider mt-2 mb-2"></li>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <i class="fe-log-out font-size-base opacity-60 mr-2"></i>
                    Sign out
                </a>
            </li>
            <li class="m-2 p-0 mt-3">
                <div class="card shadow-none p-1 ml-2 mr-2 mt-2 btn btn-translucent-warning border-0 text-center" onclick="window.open('/manage/select')">
                    <p class="m-0 p-2 ">Host Dashboard</p>
                </div>
            </li>
        </ul>
    </div>
</div>