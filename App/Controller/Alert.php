<?php

// namespace App\Controller;

class Alert
{

  public $reponse;

  public function flashMessage(string $title, string $msg, string $type, string $position)

  {
    $this->response = "<script>
    $.toast({
            heading: '" . $title . "',
            text: '<h5>" . $msg . "</h5>',
            position: '" . $position . "',
            loaderBg:'#ff6849',
            icon: '" . $type . "',
            hideAfter: 7500, 
            stack: 6
          });
    </script>";
    return $this->response;
  }

  public function alertMessage(string $title = "Notice:", string $msg = "",  string $type = "")
  {
    return '<div class="alert alert-' . $type . '">
										<strong>' . $title . '</strong> ' . $msg . '
									</div>';
  }
}