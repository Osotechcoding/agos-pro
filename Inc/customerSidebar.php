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
	              <div class="sidebar-userpic-name"> <?php echo ucwords($customer_data->fullname) ?> </div>
	              <div class="profile-usertitle-job"> Customer </div>
	            </div>
	            <div class="sidebar-userpic-btn">
	              <a class="tooltips" onclick="return confirm('Do you really want to Sign Out of your Account?');"
	                href="logout?action=customer-logout" data-placement="top" data-original-title="Logout">
	                <i class="material-icons">input</i>
	              </a>
	            </div>
	          </div>
	        </li>
	        <li class="menu-heading">
	          <span class="text-center">DASHBOARD</span>
	        </li>
	        <li class="nav-item">
	          <a href="booking-arena" class="nav-link ">
	            <span class="title"><i class="fa fa-bed"></i> Make Booking</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="booking-log" class="nav-link ">
	            <span class="title"><i class="fa fa-line-chart"></i> My Bookings</span>
	          </a>
	        </li>
	        <li class="nav-item ml-2">
	          <a href="recharge" class="nav-link ">
	            <span class="title"><i class="fa fa-credit-card"></i> Recharge Wallet</span>
	          </a>
	        </li>
	        <li class="nav-item">
	          <a href="my-profile" class="nav-link ">
	            <span class="title"> <i class="fa fa-cogs"></i> Profile</span>
	          </a>
	        </li>

	      </ul>
	    </div>
	  </div>
	</div>