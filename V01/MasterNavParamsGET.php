<?php

  // GET Navigation
  if (isset($_GET["ContentClass"])) {
    if (trim($_GET["ContentClass"]) != '') {
      $_SESSION["ContentClass"] = trim($_GET["ContentClass"]);
    }
  }

  if (isset($_GET["ContentHeaderParams"])) {
    if (trim($_GET["ContentHeaderParams"]) != '') {
      $_SESSION["ContentHeaderParams"] = explode($_SESSION["StringParamsSep"], trim($_GET["ContentHeaderParams"]));
    }
  }

  if (isset($_GET["ContentClass2"])) {
    if (trim($_GET["ContentClass2"]) != '') {
      $_SESSION["ContentClass2"] = explode($_SESSION["StringParamsSep"], trim($_GET["ContentClass2"]));
    }
  }

  if (isset($_GET["ContentHeaderParams2"])) {
    if (trim($_GET["ContentHeaderParams2"]) != '') {
      $_SESSION["ContentHeaderParams2"] = explode($_SESSION["StringParamsSep"], trim($_GET["ContentHeaderParams2"]));
    }
  }

?>

