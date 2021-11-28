<?php
namespace DA\HtmlComponents;

session_start();

$BFD=$_SESSION["BaseFolderDyn"];

use DA\Logs\LogManager as LM;

/**
 * User ID
 */
$LoggedIn=$_SESSION["LoggedIn"];
$IdUsr=$_SESSION["IdUsr"];
$UsrNam=$_SESSION["UsrNam"];
$FirstNam=$_SESSION["FirstNam"];
$Nam=$_SESSION["Nam"];
$EMail=$_SESSION["EMail"];

$UsrNam=$Nam." ".$FirstNam;
$UsrLogo=substr($Nam,0,1).substr($FirstNam,0,1);

try {
  include_once('DA/Common/Common.php');
  include_once('DA/HtmlComponents/IHtmlComponent.php');
  include_once('DA/HtmlComponents/IHtmlJsComponent.php');
  include_once('DA/HtmlComponents/SidebarMenu.php');
  include_once('DA/HtmlComponents/MainCntxMenu.php');
  include_once('DA/HtmlComponents/RightNavbarLinks.php');
  include_once('DA/Logs/LogManager.php');

  if ($_SESSION["GETNavigation"] == 'true') {
    include_once('MasterNavParamsGET.php');
  } else {
    include_once('MasterNavParamsPOST.php');
  }

  $ContentClass = $_SESSION["ContentClass"];

/*CHeck Value */
// echo $_POST["ContentParams2matrix"];
// echo $_SESSION["SuccessMsg"];
// echo $_SESSION["FailMsg"];
// echo $ContentClass;

  include_once($ContentClass . '.php');

  $CustomJs = '';
  $CustomContent = '';
  $o = new $ContentClass();
  // $o = new content();
  $CustomContent = $o->html("OK");
  $CustomJs = $o->js("OK");

  // throw new exception("Exception Test");

} catch (Exception $e) {
  $Msg='<script type="text/javascript">alert("'.$_SESSION["UsrMsg"].'","INFO");</script>';
  echo  $Msg;
  LM::LogMessage("ERROR", $e);
  return false;
}

?>

<!DOCTYPE html>
<!--
DA - Data Analysis
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>DA | Home</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="dist/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="dist/css/select.dataTables.min.css"> -->

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="dist/css/css.css"> -->
    <!-- da css -->
    <link rel="stylesheet" href="dist/css/da.css">
</head>

<body class="hold-transition sidebar-mini">
    <div id="contentInfoDiv" style="display: none;">
        <form id="contentInfo" name="contentInfo" method="POST">
            <input id="ContainerParams" type="hidden" name="ContainerParams" value="">
            <input id="ContentClass" type="hidden" name="ContentClass" value="">
            <input id="ContentHeaderParams" type="hidden" name="ContentHeaderParams" value="">
            <input id="ContentHeaders1matrix" type="hidden" name="ContentHeaders1matrix" value="">
            <input id="ContentClass2matrix" type="hidden" name="ContentClass2matrix" value="">
            <input id="ContentHeaders2matrix" type="hidden" name="ContentHeaders2matrix" value="">
            <input id="ContentParams2matrix" type="hidden" name="ContentParams2matrix" value="">
        </form>
    </div>
    <div class="wrapper">
        <!-- Modals section-->
        <section class="content">
            <div class="modal fade" id="modal-primary">
                <div class="modal-dialog">
                    <div class="modal-content bg-primary">
                        <div class="modal-header">
                            <h6 class="modal-title" id="UsrMsgTitlePrime">Primary Modal</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div id="UsrMsgPrime" name="UsrMsgPrime" class="overflow-auto"></div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-xl">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="UsrMsgTitleXl">Extra Large Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body h-75">
                            <div id="UsrMsgXl" name="UsrMsgXl" class="overflow-auto small"></div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-wait">
                <div class="modal-dialog">
                    <div class="modal-content bg-secondary">
                        <div class="modal-header">
                            <h4 class="modal-title" id="UsrMsgTitleWait">Wait ...</h4>
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button> -->
                        </div>
                        <div class="modal-body">
                            <div id="UsrMsgWait" name="UsrMsgWait" class="overflow-auto small"></div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <!-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
    </div>
    <!-- /.modal -->
    <div id="modal-spin" class="modal fade da-bd-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <!-- <div class="modal-dialog modal-sm"> -->
        <!-- <div class="modal-content" style="width: 48px"> -->
        <!-- <span class="fa fa-spinner fa-spin fa-3x"></span> -->
        <br><br><br>Executing ...<br><br><br>
        <!-- </div> -->
        <!-- </div> -->
    </div>

    </section>
    <!-- /.modal section -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <?php $o = new MainCntxMenu();
        echo $o->html('OK'); ?>
        </ul>
        <!-- /.Left navbar links -->

        <!-- Right navbar links -->
        <?php $o = new RightNavbarLinks(); 
      echo $o->html('OK'); ?>
        <!-- /.Right navbar links -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-navy elevation-4">
        <!-- Brand Logo -->
        <a href="Master.php" class="brand-link">
            <img src="dist/img/DAB_Logo.png" alt="DAB Logo" class="brand-image img-circle elevation-3"
                style="opacity: .9">
            <span class="brand-text font-weight-light">Data Analysis Board</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) $UsrLogo-->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <a href="#" class="font-weight-bold img-circle elevation-2"
                        alt="User Initials"><?php echo $UsrLogo; ?></a>
                    <!-- <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image"> -->
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $UsrNam; ?></a>
                </div>
            </div>

            <!-- inserito -->
            <!-- fine inserito -->
            <!-- Sidebar Menu -->
            <?php $o = new SidebarMenu();
        echo $o->html('OK'); ?>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="contentWrapper">
        <!-- Content Header (Page header) -->
        <!-- <div class="content-header"> -->
        <!-- <div class="container-fluid"> -->
        <!--  ?php// $o = new contentHeader();
          //echo $o->html('OK'); ? -->
        <!-- </div>/.container-fluid -->
        <!-- </div> -->
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <?php echo $CustomContent; ?>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Built on &copy;<a href="https://adminlte.io">AdminLTE.io</a></strong>
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- JavaScript Includes -->
    <script src="dist/assets/js/jquery.knob.js"></script>
    <!-- jQuery File Upload Dependencies -->
    <script src="dist/assets/js/jquery.ui.widget.js"></script>
    <script src="dist/assets/js/jquery.iframe-transport.js"></script>
    <script src="dist/assets/js/jquery.fileupload.js"></script>

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- <script src="dist/js/dataTables.select.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!--DA App JS -->
    <script src="dist/js/da.js"></script>
    <script src="dist/js/da.navigation.js"></script>

    <?php $o = new MainCntxMenu();
  echo $o->js('OK'); ?>

    <?php $o = new SidebarMenu();
  echo $o->js('OK'); ?>

    <?php $o = new RightNavbarLinks();
  echo $o->js('OK'); ?>

    <?php echo $CustomJs; ?>

</body>

</html>