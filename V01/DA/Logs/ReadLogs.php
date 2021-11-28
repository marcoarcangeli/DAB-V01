<?php 

use DA\Logs\LogManager as LM;

try{
  $ContentTitle = 'Logs';

  $Content = '
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Logs</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                      <select id="Logs" name="Logs">
                  '; 
                  $Content .= ' "<option value=""></option>"';
                  foreach (array_reverse(glob('../Logs/*.Log')) as $Fn) {
                    $p = pathinfo($Fn);
                    //$Fn = $p['Fn'];
                    $Fn = pathinfo($Fn,PATHINFO_BASENAME);
                    $PathFn = pathinfo($Fn,PATHINFO_DIRNAME)."/".$Fn;
                    $Content .= ' "<option value="' . $PathFn . '">'.$Fn.'</option>"';
                  }
  $Content .= '
                </select> 		
                      <!-- /.box-body -->
                      <div class="box-footer" style="height:100% !important">
                        <iframe id="viewFrame" src="" width="100%" height="500px" style="border:0" allowfullscreen>>
                        </iframe>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>
              
              ';

  $javaScript="
  <script type='text/javascript'>
    $(document).ready(function () {
      $('#Logs').change(function () {
        var selectedLog = $('#Logs option:selected').text();
        //alert('selected - ' + selectedLog);
        $('#viewFrame').attr('src', selectedLog);

    });
  });
</script>";

if(isset($_SESSION["UsrMsg"])){
  $javaScript .= "
      <script type='text/javascript'>
        $(document).ready(function() {
          $('#UsrMsgModal').modal('show');
        });
      </script>
  ";
  $UsrMsg=$_SESSION["UsrMsg"];
  $_SESSION["UsrMsg"]=NULL;
}


} catch (Exception $e) {
  LM::LogMessage("ERROR", $e);
  return false;
}

?>
