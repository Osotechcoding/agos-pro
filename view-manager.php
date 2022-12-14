<?php
require_once "Helper/helper.php";
?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php
  include_once "Inc/MetaTag.php"; ?>
  <title> Staff List</title>
  <!-- icons -->
  <?php include_once("Inc/DatatableHeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/Header.php" ?>
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/TopSidebar.php"; ?>
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title"><span class="fa fa-users fa-1x"></span> All Staff</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="#">Staff</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">All Staff</li>
              </ol>
            </div>
          </div>
          <ul class="nav nav-pills nav-pills-rose">
            <li class="nav-item tab-all"><a class="nav-link active show" href="#tab1" data-bs-toggle="tab">List
                View</a></li>
            <li class="nav-item tab-all"><a class="nav-link" href="#tab2" data-bs-toggle="tab">Grid View</a>
            </li>
          </ul>
          <div class="tab-content tab-space">
            <div class="tab-pane active show" id="tab1">
              <div class="row">
                <div class="col-md-12">
                  <div class="card-box">

                    <div class="card-body">
                      <div class="btn-group m-2">
                        <a href="create-manager" id="addRow" class="btn btn-info">
                          Add New Staff <i class="fa fa-plus"></i>
                        </a>
                      </div>
                      <div class="table-scrollable">
                        <table class="table table-hover table-checkable order-column full-width text-center"
                          id="example4">
                          <thead>
                            <tr>
                              <th class="center">S/N</th>
                              <th class="center"> FullName </th>
                              <th class="center"> Role </th>
                              <th class="center"> Phone </th>
                              <th class="center"> Email </th>
                              <th class="center"> Job Status </th>
                              <th class="center">Reg Date</th>
                              <th class="center"> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $allStaff = $Manager->getAllStaff();
                            if ($allStaff) {
                              $cnt = 0;
                              foreach ($allStaff as $staff) {
                                $cnt++;
                            ?>
                            <tr class="odd gradeX">
                              <td class="center"><?php echo $cnt; ?></td>
                              <td class="center"><?php echo $staff->fullname; ?></td>
                              <td class="center"><?php echo $staff->role_type; ?><br /> <span
                                  class="badge badge-<?php echo $staff->gender == 'Male' ? 'primary' : 'info' ?> badge-pill badge-md"><?php echo $staff->gender; ?></span>
                              </td>
                              <td class="center"><?php echo $staff->phone; ?></td>
                              <td class="center"><?php echo $staff->email; ?></td>
                              <td class="center"><?php echo $staff->status == '1' ? '<span
                                  class="label label-success label-sm">Active</span>' : '<span
                                  class="label label-danger label-sm">Suspended</span>'; ?>
                              </td>
                              <td class="center"><span
                                  class="badge badge-info badge-pill badge-md"><?php echo $staff->created_at; ?></span>
                              </td>
                              <td class="center">
                                <?php if ($staff->status == '0') { ?>
                                <button type="button" data-id="<?php echo $staff->id; ?>" data-action="Unsuspend"
                                  class="btn btn-circle btn-secondary btn-sm unsuspend_btn osotech_action_<?php echo $staff->id; ?>">Unsuspend</button>
                                <?php
                                    } else { ?>

                                <button type="button" data-id="<?php echo $staff->id; ?>" data-action="Suspend"
                                  class="btn btn-circle deepPink-bgcolor btn-sm suspend_btn osotech_action_<?php echo $staff->id; ?>">Suspend</button>
                                <?php
                                    } ?>
                              </td>
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
            <div class="tab-pane" id="tab2">
              <div class="row">
                <?php $allStaff = $Manager->getAllStaff();

                if ($allStaff) {
                  $cnt = 0;
                  foreach ($allStaff as $staff) {
                    $cnt++;
                ?>
                <div class="col-md-4">
                  <div class="card">
                    <div class="m-b-20">
                      <div class="doctor-profile">
                        <div class="profile-header bg-b-<?php echo $staff->gender == "Male" ? 'purple' : 'pink'; ?>">
                          <div class="user-name"><u><?php echo $staff->fullname; ?></u></div>
                          <div class="name-center"><?php echo strtoupper($staff->role_type); ?></div>
                        </div>
                        <img src="assets/img/user-image.jpg" class="user-img" alt="">
                        <p>
                          <?php echo $staff->email; ?>
                        </p>
                        <p>
                          <?php echo $staff->address; ?> || <?php echo $staff->state_of_origin; ?>
                        </p>
                        <div>
                          <p>
                            <i class="fa fa-phone"></i><a href="tel:<?php echo $staff->phone; ?>">
                              <?php echo $staff->phone; ?></a>
                          </p>
                          <p> Staff Since:
                            <i class="fa fa-calendar"></i>
                            <?php echo date("D M jS, Y", strtotime($staff->created_at)); ?>
                          </p>
                        </div>
                        <div class="profile-userbuttons">
                          <?php if ($staff->status == '0') { ?>
                          <button type="button" data-id="<?php echo $staff->id; ?>" data-action="Unsuspend"
                            class="btn btn-circle btn-secondary btn-sm unsuspend_btn osotech_action_<?php echo $staff->id; ?>">Unsuspend</button>
                          <?php
                              } else { ?>

                          <button type="button" data-id="<?php echo $staff->id; ?>" data-action="Suspend"
                            class="btn btn-circle deepPink-bgcolor btn-sm suspend_btn osotech_action_<?php echo $staff->id; ?>">Suspend</button>
                          <?php
                              } ?>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                  }
                }
                ?>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once "Inc/Footer.php"; ?>
  </div>
  <?php include_once "Inc/DatatableFooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    let unsuspend_btn = $(".unsuspend_btn");
    suspendAction(unsuspend_btn);
    let suspend_btn = $(".suspend_btn");
    suspendAction(suspend_btn);
  })

  function suspendAction(btn) {
    btn.on("click", function() {
      let staff_id = $(this).data("id");
      let action = $(this).data("action");

      if (confirm(`Are you sure, You want to ${action} this Staff?`)) {
        $(".osotech_action_" + staff_id).html("Loading...").attr("disabled", true);
        //send request
        $.post("App/Controller/Actions", {
          action: action,
          staffId: staff_id
        }, (response) => {
          $(".osotech_action_" + staff_id).html(action).attr("disabled", false);
          setTimeout(() => {
            console.log(response);
            $("#server-response").html(response);
          }, 500);
        });
      } else {
        return false;
      }

    });
  }
  </script>
</body>

</html>