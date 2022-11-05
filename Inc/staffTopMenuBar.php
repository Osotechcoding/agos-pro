<div class="top-menu">
  <ul class="nav navbar-nav pull-right">
    <!-- start manage user dropdown -->
    <li class="dropdown dropdown-user">
      <a href="javascript:;" class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
        data-close-others="true">
        <img alt="" class="img-circle " src="assets/img/user-image.jpg" />
        <span class="username username-hide-on-mobile"> <?php echo ucwords($staff_data->username) ?> </span>
        <i class="fa fa-angle-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-default animated jello">
        <li>
          <a href="staff-profile">
            <i class="icon-user"></i> Profile Settings</a>
        </li>
        <li class="divider"> </li>
        <li>
          <a href="logout?action=staff-logout"
            onclick="return confirm('Are you sure you want to Sign Out of your Account?');">
            <i class="icon-logout"></i> Log Out </a>
        </li>
      </ul>
    </li>
    <!-- end manage user dropdown -->

  </ul>
</div>