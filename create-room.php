<?php require_once "Helper/staffHelper.php"; ?>
<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
  <?php include_once "Inc/MetaTag.php"; ?>
  <title>Add Room</title>
  <!-- icons -->
  <?php include_once("Inc/HeaderScript.php"); ?>
</head>
<!-- END HEAD -->

<body
  class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
  <div class="page-wrapper">
    <!-- start header -->
    <?php include_once "Inc/staffHeader.php" ?>
    <!-- end header -->
    <!-- start page container -->
    <div class="page-container">
      <!-- start sidebar menu -->
      <?php include_once "Inc/staffSidebar.php"; ?>
      <!-- start page content -->
      <div class="page-content-wrapper">
        <div class="page-content">
          <div class="page-bar">
            <div class="page-title-breadcrumb">
              <div class=" pull-left">
                <div class="page-title">Add New Room</div>
              </div>
              <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="./">Home</a>&nbsp;<i
                    class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="javascript:void(0);">Room</a>&nbsp;<i class="fa fa-angle-right"></i>
                </li>
                <li class="active">Add Room</li>
              </ol>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="card card-box">
                <div class="card-head">
                  <div class="btn-group m-2">
                    <a href="view-rooms" id="addRow" class="btn btn-primary btn-circle">
                      View Rooms <i class="fa fa-eye"></i>
                    </a>
                  </div>
                  <header class="text-center m-4">
                    <h2>Create New Room</h2>
                  </header>
                  <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                    data-upgraded=",MaterialButton">
                    <i class="material-icons">more_vert</i>
                  </button>
                  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    data-mdl-for="panel-button">
                    <li class="mdl-menu__item"><a href="rooms"><i class="fa fa-eye"> </i> View all Rooms</a>
                    </li>
                    <li class="mdl-menu__item"><a href=""><i class="fa fa-line-chart"> </i> Room History</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body" id="bar-parent">
                  <form id="newRoomCreationForm" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Room Name
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="text" name="room_name" data-required="1" placeholder="e.g room 101"
                            class="form-control input-height" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Room Description
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <textarea name="description" placeholder="write description here..."
                            class="form-control"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Price Per Night
                        </label>
                        <div class="col-md-6">
                          <div class="input-group">

                            <input type="number" class="form-control input-height" autocomplete="off"
                              name="price_per_night" placeholder="Price per Night">
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">Room Type
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select form-control custom-select input-height" name="room_type">
                            <optgroup label="Occupancy">
                              <option value="Single Room">Single Room</option>
                              <option value="Tripple Room">Tripple Room</option>
                              <option value="Double Double Room">Double Double Room</option>
                              <option value="Quadruple Room">Quadruple Room</option>
                            </optgroup>
                            <optgroup label="Bed">
                              <option value="King Room">King Room</option>
                              <option value="Queen Room">Queen Room</option>
                              <option value="Twin Room">Twin Room</option>

                            </optgroup>
                            <optgroup label="Design & Layout">
                              <option value="Presidential Room">Presidential Room</option>
                              <option value="Standard Room">Standard Room</option>
                              <option value="Deluxe Room">Deluxe Room</option>
                              <option value="Superior Room">Superior Room</option>
                              <option value="Executive Suite">Executive Suite</option>
                              <option value="Master Suite">Master Suite</option>
                              <option value="Junior Suite">Junior Suite</option>
                              <option value="Penthouse Suite">Penthouse Suite</option>
                              <option value="Villa Suite">Villa Suite</option>
                            </optgroup>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="control-label col-md-3">AC Type
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <select class="form-select form-control custom-select input-height" name="ac_type">
                            <option value="">Choose...</option>
                            <option value="NON-AC">NON Air Conditioner</option>
                            <option value="AC">Air Conditioner</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Facility.
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <textarea name="facility" placeholder="Wifi, Pool, TV" class="form-control"></textarea>
                          <span class="text-danger">Facility shuld be separated by comma</span>
                        </div>

                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3"> Image_1.
                          <span class="required"> * </span>
                        </label>
                        <div class="col-md-6">
                          <input type="file" onchange="previewFile(this)" autocomplete="off"
                            class="form-control form-control-lg" name="image1" id="driverImage">
                          <span class="text-danger">Image type must be jpg</span>
                          <div class="col-md-12">
                            <div class="form-group">
                              <img id="previewImg" width="100" height="100" src="image/placeholder.png"
                                alt="Placeholder" style="border: 2px solid darkblue;border-radius:10px;">
                              <p>Your File Size: <span id="ImageSize"></span></p>
                            </div>
                          </div>
                        </div>

                      </div>

                      <input type="hidden" name="action" value="add_new_room_">
                      <input type="hidden" name="agos_tokens" value="2289484748448">
                      <div class="form-actions">
                        <div class="row">
                          <div class="offset-md-3 col-md-9">
                            <button type="submit"
                              class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary btn-lg btn-block _loadingBtn__">Submit</button>

                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- start footer -->
    <?php include_once "Inc/Footer.php"; ?>
    <!-- end footer -->
  </div>
  <?php include_once "Inc/FooterScript.php"; ?>
  <script>
  $(document).ready(function() {
    $("#newRoomCreationForm").on("submit", function(event) {
      event.preventDefault();
      $.ajax({
        url: "App/Controller//Actions",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend() {
          $("._loadingBtn__").html(
            'Loading...').attr("disabled",
            true);
        },
        success: function(data) {
          setTimeout(() => {
            $("._loadingBtn__").html('Submit').attr("disabled", false);
            // $("#video_form")[0].reset();
            $("#server-response").html(data);
            //alert(data);
          }, 1500);
        }

      });
    })
  })

  function previewFile(input) {
    var file = $("#driverImage").get(0).files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#previewImg").attr("src", reader.result);
        //$("#imagename").html(file.name);
        $("#ImageSize").html((file.size / 1024).toFixed(2) + "KB");
      }
      reader.readAsDataURL(file);
    }
  }
  </script>
</body>

</html>