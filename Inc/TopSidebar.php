	<div class="sidebar-container">
	  <div class="sidemenu-container navbar-collapse collapse fixed-menu">
	    <div id="remove-scroll">
	      <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true"
	        data-slide-speed="200">
	        <li class="sidebar-toggler-wrapper hide">
	          <div class="sidebar-toggler">
	            <span></span>
	          </div>
	        </li>
	        <li class="sidebar-user-panel">
	          <div class="user-panel">
	            <div class="row">
	              <div class="sidebar-userpic">
	                <img src="assets/img/user-image.jpg" class="img-responsive" alt="">
	              </div>
	            </div>
	            <div class="profile-usertitle">
	              <div class="sidebar-userpic-name"> <?php echo ucfirst($admin_data->fullname); ?> </div>
	              <div class="profile-usertitle-job"> <?php echo ucfirst($admin_data->role_type); ?> </div>
	            </div>
	            <div class="sidebar-userpic-btn">

	              <a class="tooltips" onclick="return confirm('Do you really want to Sign Out?');"
	                href="logout?action=destroy_admin_session" data-placement="top" data-original-title="Logout">
	                <i class="material-icons">input</i>
	              </a>
	            </div>
	          </div>
	        </li>
	        <li class="menu-heading">
	          <a href="./" class="nav-link ">
	            <span class="text-center">DASHBOARD</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="view-booking-list" class="nav-link ">
	            <i class="fa fa-bed"></i>
	            <span class="title">View Booking</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="rooms" class="nav-link ">
	            <i class="fa fa-bed"></i>
	            <span class="title">View Rooms</span>
	          </a>
	        </li>

	        <li class="nav-item">
	          <a href="view-manager" class="nav-link ">
	            <i class="material-icons">group</i>
	            <span class="title">View Staff</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="view-customer" class="nav-link ">
	            <i class="material-icons">group</i>
	            <span class="title">View Customers</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="generate" class="nav-link ">
	            <i class="fa fa-credit-card" aria-hidden="true"></i>
	            <span class="title">Generate Token</span>
	          </a>
	        </li>

	      </ul>
	    </div>
	  </div>
	</div>