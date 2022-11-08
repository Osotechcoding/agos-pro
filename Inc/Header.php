 <div class="page-header navbar navbar-fixed-top">
   <div class="page-header-inner ">
     <!-- logo start -->
     <div class="page-logo">
       <a href="./">
         <img alt="" class="logo-default img-fluid" width="100" height="50"
           src="image/<?php echo $app_data->logo == NULL || $app_data->logo == "" ? 'agos-logo.jpg' : $app_data->logo; ?>">
         <span class="logo-default"></span> </a>
     </div>
     <!-- logo end -->
     <ul class="nav navbar-nav navbar-left in">
       <li><a href="javascript:void(0);" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
     </ul>
     <form class="search-form-opened" action="#" method="GET">
       <div class="input-group">
         <input type="text" class="form-control" placeholder="Search..." name="query">
         <span class="input-group-btn search-btn">
           <a href="javascript:;" class="btn submit">
             <i class="icon-magnifier"></i>
           </a>
         </span>
       </div>
     </form>
     <!-- start mobile menu -->
     <a href="javascript:;" class="menu-toggler responsive-toggler" data-bs-toggle="collapse"
       data-bs-target=".navbar-collapse">
       <span></span>
     </a>
     <!-- end mobile menu -->
     <!-- start header menu -->
     <?php include_once "Inc/TopMenuBar.php"; ?>

   </div>
 </div>