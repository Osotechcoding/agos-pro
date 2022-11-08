<?php
require_once "Mailer.php";
class Pin
{
  protected $_Pins_code;
  protected $query;
  protected $response;
  private PDO $dbh;
  private $table = "wallet_pins_tbl";
  protected $Core;
  protected $stmt;
  protected $Alert;
  public function __construct($dbh, $Core, $Alert)
  {
    $this->dbh = $dbh;
    $this->Core = $Core;
    $this->Alert = $Alert;
  }
  public function generateTokenPins($data)
  {
    $q = $this->Core->sanitise_string($data['no_of_token']);
    $p = $this->Core->sanitise_string($data['price']);
    //check for empty form values 
    if ($this->Core->isEmptyStr($q) || $this->Core->isEmptyStr($p)) {
      // show error
      $this->response = $this->Alert->alertMessage("WARNING:", "Invalid Submission, Pls try again!", "danger");
    } elseif ($q > 200) {
      $this->response = $this->Alert->alertMessage("WARNING:", "You Cannot generate more than 200 Wallet Token at once!", "danger");
    } else {
      $this->_Pins_code = 12;
      //set pin codes 
      $nums     = "893701245632156";
      $nums2    = "567980123489543";
      $nums3    = "978562390141696";
      $nums4    = '723910856412345';
      $nums5    = '723910856412013';
      $created_at = date('Y-m-d');
      $countInserted = 0;
      for ($i = 1; $i <= $q; $i++) {
        // let reshuffle 
        @$pn = str_shuffle(substr($nums, mt_rand(0, (strlen($nums) - $this->_Pins_code)), $this->_Pins_code));

        // check if pin already exists in db
        $this->query = "SELECT COUNT(*) AS cnt FROM `{$this->table}` WHERE token=?";
        $this->stmt = $this->dbh->prepare($this->query);
        $this->stmt->execute(array($pn));
        $fetch_objX = $this->stmt->fetch();
        $count_check1 = $fetch_objX->cnt;
        if ($count_check1 >= 1) {
          // do a kind of reshuffle again
          @$pn = str_shuffle(substr($nums2, mt_rand(0, (strlen($nums2) - $this->_Pins_code)), $this->_Pins_code));
          //check for the second time
          $this->query = "SELECT COUNT(*) AS cnt FROM `{$this->table}` WHERE token=?";
          $this->stmt = $this->dbh->prepare($this->query);
          $this->stmt->execute(array($pn));
          $fetch_objX2 = $this->stmt->fetch();
          $count_check2 = $fetch_objX2->cnt;
          if ($count_check2 >= 1) {
            // do a kind of reshuffle again
            @$pn = str_shuffle(substr($nums3, mt_rand(0, (strlen($nums3) - $this->_Pins_code)), $this->_Pins_code));

            //check for the third time
            $this->query = "SELECT COUNT(*) AS cnt FROM `{$this->table}` WHERE token=?";
            $this->stmt = $this->dbh->prepare($this->query);
            $this->stmt->execute(array($pn));
            $fetch_objX3 = $this->stmt->fetch();
            $count_check3 = $fetch_objX3->cnt;
            if ($count_check3 >= 1) {
              // do a kind of reshuffle again
              @$pn = str_shuffle(substr($nums4, mt_rand(0, (strlen($nums4) - $this->_Pins_code)), $this->_Pins_code));
              //check for the fourth time
              $this->query = "SELECT COUNT(*) AS cnt FROM `{$this->table}` WHERE token=?";
              $this->stmt = $this->dbh->prepare($this->query);
              $this->stmt->execute(array($pn));
              $fetch_objX4 = $this->stmt->fetch();
              $count_check4 = $fetch_objX4->cnt;
              if ($count_check4 >= 1) {
                // reshuffle for the last time
                @$pn = str_shuffle(substr($nums5, mt_rand(0, (strlen($nums5) - $this->_Pins_code)), $this->_Pins_code));
              }
            }
          }
        }
        //insert into table
        $status = 0;
        $this->query = "INSERT INTO `{$this->table}` (token,amount,`status`,created_at) VALUES(?,?,?,?)";
        $this->stmt = $this->dbh->prepare($this->query);
        $this->stmt->execute(array($pn, $p, $status, $created_at));
        $rowCount = $this->stmt->rowCount();
        $countInserted = $countInserted + $rowCount;
      }
      if ($this->stmt != NULL) {
        $this->response = $this->Alert->alertMessage("SUCCESS:", "You have Successfully Generated <b>" . $countInserted . " Wallet Top Up Tokens", "success") . $this->Core->pageReload();
      } else {
        $this->response = $this->Alert->alertMessage("ERROR", "Fatal Error Occured! ", "danger");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function getAllWalletToken()
  {

    $this->query = "SELECT * FROM `{$this->table}` ORDER BY id DESC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
    }
  }

  public function removeUsedWalletTokenPin($data)
  {
    try {
      $pinId = $this->Core->sanitise_string($data['wallet_token_id']);
      $this->dbh->beginTransaction();
      $this->stmt = $this->dbh->prepare("DELETE FROM `{$this->table}` WHERE id=? LIMIT 1");
      if ($this->stmt->execute([$pinId])) {
        $this->dbh->commit();
        $this->response = $this->Alert->flashMessage("AGOS Says", "Token Deleted Successfully!", "success", "top-right") . $this->Core->pageReload();
      }
    } catch (PDOException $e) {
      $this->dbh->rollback();
      $this->response = $this->Alert->flashMessage("AGOS Says", "Something went wrong!: " . $e->getMessage(), "error", "top-right");
    }
    return $this->response;
    $this->dbh = null;
  }

  //

  public function deleteMyWalletRechargeHistory($data)
  {
    try {
      $wid = $this->Core->sanitise_string($data['rhid']);
      $this->dbh->beginTransaction();
      $this->stmt = $this->dbh->prepare("DELETE FROM `recharge_history` WHERE id=? LIMIT 1");
      if ($this->stmt->execute([$wid])) {
        $this->dbh->commit();
        $this->response = $this->Alert->flashMessage("SUCCESS", "Data Deleted Successfully!", "success", "top-right") . $this->Core->pageReload();
      }
    } catch (PDOException $e) {
      $this->dbh->rollback();
      $this->response = $this->Alert->flashMessage("AGOS Says", "Something went wrong!: " . $e->getMessage(), "error", "top-right");
    }
    return $this->response;
    $this->dbh = null;
  }

  //count wallet Token
  public function countAllWalletTokensPins()
  {
    $this->query = "SELECT count(id) as cnt FROM `{$this->table}` WHERE `status`='0'";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $data_count = $this->stmt->fetch();
      $this->response = $data_count->cnt;
      return $this->response;
      $this->dbh = null;
    }
  }
  public function getTokenByPin($token_pin)
  {
    $sql = "SELECT * FROM `{$this->table}` WHERE `token`=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$token_pin]);
    if ($this->stmt->rowCount() == '1') {
      $this->response = $this->stmt->fetch();
      return $this->response;
      $this->dbh = null;
    }
  }
  public function getAllRechargeHistoryByCustomerId($cid)
  {
    $sql = "SELECT * FROM `recharge_history` WHERE `customer_id`=? ORDER BY id DESC LIMIT 50";
    $this->stmt = $this->dbh->prepare($sql);
    $this->response = $this->stmt->execute([$cid]);
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
      return $this->response;
      $this->dbh = null;
    }
  }

  public function topUpCustomerWallet($data)
  {
    $amount = $this->Core->sanitise_string($data['token_amount']);
    $email = $this->Core->sanitise_string($data['customer_email']);
    $cid = $this->Core->sanitise_string($data['customer_id']);

    if ($this->Core->isEmptyStr($amount) || $this->Core->isEmptyStr($email) || $this->Core->isEmptyStr($cid)) {
      $this->response = $this->Alert->flashMessage("WARNING:", "Invalid Submission!", "error", "top-right");
    } else {
      $balance = (float) $amount;
      $created_at = date("Y-m-d");
      $recharge_at = date("Y-m-d H:i:s");
      $customer_data = $this->Core->getSingleData("customers", "id", $cid);
      try {
        $this->dbh->beginTransaction();
        $sql = "UPDATE `wallet_tbl` SET `balance`=balance+$balance WHERE `customer_id`=? LIMIT 1";
        $this->stmt = $this->dbh->prepare($sql);
        if ($this->stmt->execute([$cid])) {
          //create wallet recharge history
          $query = "INSERT INTO `recharge_history` (customer_id,amount,recharge_at,created_at) VALUES (?,?,?,?);";
          $this->stmt = $this->dbh->prepare($query);
          if ($this->stmt->execute([$cid, $balance, $recharge_at, $created_at])) {
            if (sendTopUpWalletNotificationToCustomer($customer_data->fullname, $customer_data->email, $amount, $recharge_at)) {
              $this->dbh->commit();
              $this->response = $this->Alert->flashMessage("SUCCESS:", "Recharge Successful, Notification mail was sent to $email!", "success", "top-right") . $this->Core->pageReload();
            }
          }
        }
      } catch (PDOException $e) {
        $this->dbh->rollback();
        $this->response = $this->Alert->flashMessage("NOTICE:", "Something went wrong!: " . $e->getMessage(), "error", "top-right");
      }
    }
    return $this->response;
    $this->dbh = null;
  }

  public function topUpMyWalletByTokenCard($data)
  {
    $token_card = $this->Core->sanitise_string($data['token_pin']);
    $email = $this->Core->sanitise_string($data['email']);
    $cid = $this->Core->sanitise_string($data['cust_id']);
    //check for null values
    if ($this->Core->isEmptyStr($token_card)) {
      $this->response = $this->Alert->alertMessage("WARNING:", "Enter Recharge Token to continue!", "danger");
    } else if (strlen($token_card) <> 12) {
      $this->response = $this->Alert->alertMessage("DO NOT PLAY SMART:", "Invalid Token provided!", "danger");
    } else if (!$this->Core->userDataExisted($this->table, "token", $token_card)) {
      $this->response = $this->Alert->alertMessage("DO NOT PLAY SMART:", "This token does not exist!", "danger");
    } else {
      $token_details = $this->getTokenByPin($token_card);
      //check the status of the token pin
      if ($token_details->status == '1') {
        $this->response = $this->Alert->alertMessage("DO NOT PLAY SMART:", "This Token has been Used!", "danger");
      } else {
        $token_amount = (int)$token_details->amount;
        $customer_data = $this->Core->getSingleData("customers", "id", $cid);
        $created_at = date("Y-m-d");
        $recharge_at = date("Y-m-d H:i:s");
        try {
          $this->dbh->beginTransaction();
          $sql = "UPDATE `wallet_tbl` SET `balance`=balance+$token_amount WHERE `customer_id`=? LIMIT 1";
          $this->stmt = $this->dbh->prepare($sql);
          if ($this->stmt->execute([$cid])) {
            //create wallet recharge history
            $query = "INSERT INTO `recharge_history` (customer_id,amount,recharge_at,created_at) VALUES (?,?,?,?);";
            $this->stmt = $this->dbh->prepare($query);
            if ($this->stmt->execute([$cid, $token_amount, $recharge_at, $created_at])) {
              $sql = "UPDATE `wallet_pins_tbl` SET `status`='1' WHERE `token`=? LIMIT 1";
              $this->stmt = $this->dbh->prepare($sql);
              if ($this->stmt->execute([$token_card])) {
                if (sendTopUpWalletNotificationToCustomer($customer_data->fullname, $customer_data->email, $token_amount, $recharge_at)) {
                  $this->dbh->commit();
                  $this->response = $this->Alert->alertMessage("SUCCESS:", "Recharge Successful, Notification mail was sent to $email!", "success") . $this->Core->pageReload();
                }
              }
            }
          }
        } catch (PDOException $e) {
          $this->dbh->rollback();
          $this->response = $this->Alert->flashMessage("NOTICE:", "Something went wrong!: " . $e->getMessage(), "error", "top-right");
        }
      }
    }
    return $this->response;
    $this->dbh = null;
  }
}