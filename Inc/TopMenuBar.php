<div class="top-menu">
  <ul class="nav navbar-nav pull-right">
    <!-- start notification dropdown -->
    <!-- <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
      <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
        data-close-others="true">
        <i class="fa fa-bell-o"></i>
        <span class="badge headerBadgeColor1"> 6 </span>
      </a>
      <ul class="dropdown-menu animated swing">
        <li class="external">
          <h3><span class="bold">Notifications</span></h3>
          <span class="notification-label purple-bgcolor">New 6</span>
        </li>
        <li>
          <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
            <li>
              <a href="javascript:;">
                <span class="time">just now</span>
                <span class="details">
                  <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-check"></i></span>
                  Congratulations!. </span>
              </a>
            </li>
          </ul>
          <div class="dropdown-menu-footer">
            <a href="javascript:void(0)"> All notifications </a>
          </div>
        </li>
      </ul>
    </li> -->
    <!-- end notification dropdown -->
    <!-- start message dropdown -->
    <!-- <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
      <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
        data-close-others="true">
        <i class="fa fa-envelope-o"></i>
        <span class="badge headerBadgeColor2"> 2 </span>
      </a>
      <ul class="dropdown-menu animated slideInDown">
        <li class="external">
          <h3><span class="bold">Messages</span></h3>
          <span class="notification-label cyan-bgcolor">New 2</span>
        </li>
        <li>
          <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
            <li>
              <a href="#">
                <span class="photo">
                  <img src="assets/img/user-image.jpg" class="img-circle" alt="">
                </span>
                <span class="subject">
                  <span class="from"> Sarah Smith </span>
                  <span class="time">Just Now </span>
                </span>
                <span class="message"> Jatin I found you on LinkedIn... </span>
              </a>
            </li>

          </ul>
          <div class="dropdown-menu-footer">
            <a href="#"> All Messages </a>
          </div>
        </li>
      </ul>
    </li> -->
    <!-- end message dropdown -->
    <!-- start manage user dropdown -->
    <li class="dropdown dropdown-user">
      <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
        data-close-others="true">
        <img alt="" class="img-circle" width="40" height="60"
          src="image/<?php echo $app_data->logo == NULL || $app_data->logo == "" ? 'agos-logo.jpg' : $app_data->logo; ?>" />
        <span class="username username-hide-on-mobile"> <?php echo ucfirst($admin_data->username); ?> </span>
        <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-default animated jello">
        <li>
          <a href="profile">
            <i class="icon-user"></i> Profile </a>
        </li>

        <li class="divider"> </li>
        <li>
          <a onclick="return confirm('Do you really want to Sign Out?');" href="logout?action=destroy_admin_session">
            <i class="icon-logout"></i> Log Out </a>
        </li>
      </ul>
    </li>
    <!-- end manage user dropdown -->
  </ul>
</div>