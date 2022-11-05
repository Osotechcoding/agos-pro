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
	          <span class="text-center">DASHBOARD</span>
	        </li>


	        <li class="nav-item">
	          <a href="#" class="nav-link nav-toggle">
	            <i class="fa fa-bed"></i>
	            <span class="title">Booking</span>
	            <span class="arrow"></span>
	          </a>
	          <ul class="sub-menu">
	            <!-- <li class="nav-item">
	              <a href="walkin-booking" class="nav-link ">
	                <span class="title">New Booking</span>
	              </a>
	            </li> -->
	            <li class="nav-item">
	              <a href="view-booking-list" class="nav-link ">
	                <span class="title">View Booking</span>
	              </a>
	            </li>

	          </ul>
	        </li>
	        <li class="nav-item">
	          <a href="#" class="nav-link nav-toggle">
	            <i class="fa fa-bed"></i>
	            <span class="title">Rooms</span>
	            <span class="arrow"></span>
	          </a>
	          <ul class="sub-menu">
	            <!-- <li class="nav-item">
	              <a href="add-room" class="nav-link ">
	                <span class="title">Add Room</span>
	              </a>
	            </li> -->
	            <li class="nav-item">
	              <a href="rooms" class="nav-link ">
	                <span class="title">View Rooms</span>
	              </a>
	            </li>
	          </ul>
	        </li>
	        <li class="nav-item">
	          <a href="#" class="nav-link nav-toggle">
	            <i class="material-icons">group</i>
	            <span class="title">Staff</span>
	            <span class="arrow"></span>
	          </a>
	          <ul class="sub-menu">
	            <li class="nav-item">
	              <a href="create-manager" class="nav-link ">
	                <span class="title">Add Staff</span>
	              </a>
	            </li>
	            <li class="nav-item">
	              <a href="view-manager" class="nav-link ">
	                <span class="title">View Staff</span>
	              </a>
	            </li>

	          </ul>
	        </li>
	        <li class="nav-item">
	          <a href="#" class="nav-link nav-toggle">
	            <i class="material-icons">group</i>
	            <span class="title">Customers</span>
	            <span class="arrow"></span>
	          </a>
	          <ul class="sub-menu">
	            <li class="nav-item">
	              <a href="add-customer" class="nav-link ">
	                <span class="title">New Customer</span>
	              </a>
	            </li>
	            <li class="nav-item">
	              <a href="view-customer" class="nav-link ">
	                <span class="title">View Customers</span>
	              </a>
	            </li>

	          </ul>
	        </li>
	        <li class="nav-item">
	          <a href="#" class="nav-link nav-toggle">
	            <i class="fa fa-credit-card"></i>
	            <span class="title">Wallet</span>
	            <span class="arrow"></span>
	          </a>
	          <ul class="sub-menu">
	            <li class="nav-item">
	              <a href="generate" class="nav-link ">
	                <span class="title">Generate Token</span>
	              </a>
	            </li>
	          </ul>
	        </li>

	        <!-- <li class="nav-item">
	          <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-line-chart"></i>
	            <span class="title">Reports</span>
	            <span class="arrow"></span>
	          </a>
	          <ul class="sub-menu">

	            <li class="nav-item">
	              <a href="sales_report" class="nav-link "><span class="title"> Sales</span>
	              </a>
	            </li>
	            <li class="nav-item">
	              <a href="invoice" class="nav-link "><span class="title">Activity Logs</span>
	              </a>
	            </li>

	          </ul>
	        </li> -->

	      </ul>
	    </div>
	  </div>
	</div>