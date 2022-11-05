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
	              <div class="sidebar-userpic-name"> <?php echo ucwords($staff_data->fullname) ?> </div>
	              <div class="profile-usertitle-job"> <?php echo ucfirst($staff_data->role_type); ?> </div>
	            </div>
	            <div class="sidebar-userpic-btn">
	              <a class="tooltips" onclick="return confirm('Do you really want to Sign Out of your Account?');"
	                href="logout?action=staff-logout" data-placement="top" data-original-title="Logout">
	                <i class="material-icons">input</i>
	              </a>
	            </div>
	          </div>
	        </li>
	        <li class="menu-heading">
	          <span class="text-center">DASHBOARD</span>
	        </li>
	        <li class="nav-item">
	          <a href="make-booking" class="nav-link ">
	            <span class="title"><i class="fa fa-bed"></i> Make Booking</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="bookings" class="nav-link ">
	            <span class="title"><i class="fa fa-line-chart"></i>View Bookings</span>
	          </a>
	        </li>
	        <li class="nav-item ml-2">
	          <a href="create-room" class="nav-link ">
	            <span class="title"><i class="fa fa-credit-card"></i> Add Room</span>
	          </a>
	        </li>
	        <li class="nav-item ml-2">
	          <a href="view-token" class="nav-link ">
	            <span class="title"><i class="fa fa-credit-card"></i> Tokens</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="staff-profile" class="nav-link ">
	            <span class="title"> <i class="fa fa-cogs"></i> Profile</span>
	          </a>
	        </li>

	      </ul>
	    </div>
	  </div>
	</div>