<?php

use PHPMailer\PHPMailer\PHPMailer;

class Room
{
  private PDO $dbh;
  private $table = "rooms_tbl";
  protected $Core;
  protected $stmt;
  protected $Alert;
  public function __construct($dbh, $Core, $Alert)
  {
    $this->dbh = $dbh;
    $this->Core = $Core;
    $this->Alert = $Alert;
  }
  public function create(array $data, array $files)
  {
    $name = $this->Core->sanitise_string($data['room_name']);
    $type = $this->Core->sanitise_string($data['room_type']);
    $description = $this->Core->sanitise_string($data['description']);
    $facility = $this->Core->sanitise_string($data['facility']);
    $price = $this->Core->sanitise_string($data['price_per_night']);
    $ac_type = $this->Core->sanitise_string($data['ac_type']);

    $image_name = $files['image1']['name'];
    $image_size  = $files['image1']['size'] / 1024;
    $image_tmp = $files['image1']['tmp_name'];
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_name = time() . "." . $ext;
    $destination = "../../image/" . $image_name;

    if (
      $this->Core->isEmptyStr($name) ||
      $this->Core->isEmptyStr($image_name) ||
      $this->Core->isEmptyStr($type) ||
      $this->Core->isEmptyStr($facility) ||
      $this->Core->isEmptyStr($description) ||
      $this->Core->isEmptyStr($price) ||
      $this->Core->isEmptyStr($ac_type)
    ) {
      $this->response = $this->Alert->flashMessage("AGOS Says", "Invalid submission!", "error", "top-right");
    } else if ($image_size > 1000) {
      $this->response = $this->Alert->flashMessage("AGOS Says", "file size cannot exceed 1MB!", "error", "top-right");
    } else {
      //check if the email is already added
      if ($this->Core->userDataExisted("rooms_tbl", "room_name", $name)) {
        $this->response = $this->Alert->flashMessage("AGOS Says", "$name already created!", "error", "top-right");
      } else {
        //try to insert ths new room into database
        $status = 0;
        $create_at = date("Y-m-d");
        try {
          $this->dbh->beginTransaction();
          $sql = "INSERT INTO `{$this->table}` (room_name,room_type,price,room_desc,facilities,firstImage,acType,is_booked,created_at) VALUES (?,?,?,?,?,?,?,?,?);";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$name, $type, $price, $description, $facility, $image_name, $ac_type, $status, $create_at])) {
            if ($this->Core->move_file_to_folder($image_tmp, $destination)) {
              $this->dbh->commit();
              $this->response = $this->Alert->flashMessage("AGOS Says", "$name created successfully!", "success", "top-right") . $this->Core->pageReload();
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollBack();
          $this->response = $this->Alert->flashMessage("AGOS Says", " Unknown Server Error Occured: " . $e->getMessage(), "error", "top-right");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function getAllRooms()
  {
    $sql = "SELECT * FROM `{$this->table}` ORDER BY id DESC LIMIT 200";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  //
  public function getAllActiveRooms()
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE is_booked='0' ORDER BY id DESC LIMIT 200";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getAllBookingByStatus(int $status)
  {
    $sql = "SELECT * FROM `booking_tbl` WHERE `is_approved`=? ORDER BY created_at DESC LIMIT 200";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$status]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getAllRecentBooking()
  {
    $sql = "SELECT * FROM `booking_tbl` WHERE DATE(`created_at`)>= DATE(CURRENT_DATE()- INTERVAL 3 DAY) ORDER BY created_at DESC LIMIT 5";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getAllMyBookingHistoryById($cid)
  {
    $sql = "SELECT * FROM `booking_tbl` WHERE `customer_id`=? ORDER BY created_at DESC LIMIT 10";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$cid]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getBookingById($bid)
  {
    $sql = "SELECT * FROM `booking_tbl` WHERE `id`=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$bid]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getRoomById($rid)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$rid]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function getAllRoomsInDropDownList()
  {
    $this->response = "";
    $this->stmt = $this->dbh->prepare("SELECT * FROM `{$this->table}` WHERE is_booked ='0' ORDER BY room_name ASC LIMIT 500");
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      while ($row = $this->stmt->fetch()) {
        $this->response .= '<option value="' . $row->id . '">' . $row->room_name . ' &raquo; ' . $row->room_type . ' &raquo; ' . number_format($row->price, 2) . '</option>';
      }
    } else {
      $this->response = false;
    }
    return $this->response;
    $this->dbh = null;
  }

  public function countAllRoomsByStatus($status)
  {
    $sql = "SELECT count(id) as total_room FROM `{$this->table}` WHERE is_booked=?";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$status]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->total_room;
      $this->dbh = null;
    }
  }

  public function countAllRooms()
  {
    $sql = "SELECT count(id) as total_room FROM `{$this->table}`";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->total_room;
      $this->dbh = null;
    }
  }
  public function countPendingBookings($status)
  {
    $sql = "SELECT count(id) as pending FROM `booking_tbl` WHERE `status`=?";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$status]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->pending;
      $this->dbh = null;
    }
  }

  public function getTodaysRevenue()
  {
    $sql = "SELECT sum(total_bill) as revenue FROM `booking_tbl` WHERE `status`=2 AND DATE(created_at) = DATE(CURRENT_DATE())";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->revenue;
      $this->dbh = null;
    }
  }

  public function getCurrentMonthRevenue()
  {
    $sql = "SELECT sum(total_bill) as revenue FROM `booking_tbl` WHERE `status`=2";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->revenue;
      $this->dbh = null;
    }
  }

  public function countInvoiceByCustomerId($cid)
  {
    $sql = "SELECT count(`id`) as total FROM `booking_tbl` WHERE `customer_id`=?";
    $this->stmt = $this->dbh->prepare($sql);
    $this->stmt->execute([$cid]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetch();
      return $this->response->total;
      $this->dbh = null;
    }
  }
}