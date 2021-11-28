<?php

  // POST Navigation
  if (isset($_POST["ContentClass"])) {
    if (trim($_POST["ContentClass"]) != '') {
      $_SESSION["ContentClass"] = trim($_POST["ContentClass"]);
    }
  }

  if (isset($_POST["ContentHeaderParams"])) {
    if (trim($_POST["ContentHeaderParams"]) != '') {
      $_SESSION["ContentHeaderParams"] = explode($_SESSION["StringParamsSep"], trim($_POST["ContentHeaderParams"]));
    }
  }

  if (isset($_POST["ContentHeaders1matrix"])) {
    if (trim($_POST["ContentHeaders1matrix"]) != '') {
      $_SESSION["ContentHeaders1matrix"] = json_decode($_POST["ContentHeaders1matrix"], true);
    }
  }

  if (isset($_POST["ContentClass2matrix"])) {
    if (trim($_POST["ContentClass2matrix"]) != '') {
      $_SESSION["ContentClass2matrix"] = json_decode($_POST["ContentClass2matrix"], true);
    }
  }

  if (isset($_POST["ContentHeaders2matrix"])) {
    if (trim($_POST["ContentHeaders2matrix"]) != '') {
      $_SESSION["ContentHeaders2matrix"] = json_decode($_POST["ContentHeaders2matrix"], true);
    }
  }
  
  if (isset($_POST["ContentParams2matrix"])) {
    if (trim($_POST["ContentParams2matrix"]) != '') {
      $_SESSION["ContentParams2matrix"] = json_decode($_POST["ContentParams2matrix"], true);
    }
  }

?>

