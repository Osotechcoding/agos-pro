 <div class="row">
   <div class="col-md-12 col-sm-12">
     <div class="card  card-box">
       <div class="card-head">
         <header class="mt-3 mb-3">My Booking History</header>
         <div class="tools">
           <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
           <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
           <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
         </div>
       </div>
       <div class="card-body ">
         <div class="table-wrap">
           <div class="table-responsive">
             <table class="table display product-overview mb-30" id="support_table5">
               <thead>
                 <tr>
                   <th>No</th>
                   <th>Room & Type</th>
                   <th>Check-In Date</th>
                   <th>Check-Out Date</th>
                   <th>Status</th>
                   <th>Total Biil</th>
                 </tr>
               </thead>
               <tbody>
                 <?php

                  $recentBookings = $Room->getAllMyBookingHistoryById($loggerId);
                  if ($recentBookings) {
                    $cnt = 0;
                    foreach ($recentBookings as $recent) {
                      $customer_data = $Customer->getCustomerById($recent->customer_id);
                      $room_data = $Room->getRoomById($recent->room_id);
                      $cnt++;
                  ?>
                 <tr>
                   <td><?php echo $cnt; ?></td>
                   <td><?php echo ucwords($room_data->room_name) ?>
                     <br /><span class="label label-sm label-dark"><?php echo ucwords($room_data->room_type) ?></span>
                   </td>
                   <td><?php echo date("D jS M, Y", strtotime($recent->checkIn)); ?></td>
                   <td><?php echo date("D jS M, Y", strtotime($recent->checkOut)); ?></td>
                   <td>
                     <?php
                          if ($recent->is_approved == "0") {
                            echo '<span class="label label-sm label-warning">Pending</span>';
                          } elseif ($recent->is_approved == "1") {
                            echo '<span class="label label-sm label-success">Approved</span>';
                          } else {
                            echo '<span class="label label-sm label-danger">Rejected</span>';
                          }
                          ?>
                   </td>
                   <td><?php echo number_format($recent->total_bill, 2); ?> </td>
                 </tr>
                 <?php
                    }
                  }

                  ?>

               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>