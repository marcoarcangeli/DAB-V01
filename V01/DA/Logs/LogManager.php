<?php

namespace DA\Logs;

class LogManager
{
    // public $Msg; 
    // public $Datetime; // ex. [2021-05-24 23:57:07]
    // public $Type; // ERROR, WARN, INFO

    // public function __construct(string $param = "OK")
    // {
    //     // $this->msg="";
    //     // $this->datetime="";
    //     // $this->type="ERROR";
    // }

    public static function LogMessage($Type="ERROR",$Msg=NULL)
    {
        // model: ERROR [2021-05-24 23:08:56] Error: You have an error in your SQL syntax; 
        try {
            if($_SESSION["LoggedIn"]){
                $Datetime="[".date('Y-m-d G:i:s')."]";
                if($Type=="ERROR"){
                    $_SESSION["UsrMsg"] = $UsrMsg = $Type." ". $Datetime.": "."Exception ".$Msg->getCode()." Msg: ".$Msg->getMessage()." in ".$Msg->getFile()." on line ".$Msg->getLine()."\n";
                    $_SESSION["UsrMsg"] = $UsrMsg .= "        Stack Trace: ".$Msg->getTraceAsString ();
                    // throw new exception("Exception ".$e->getCode()." Msg: ".$e->getMessage()." in ".$e->getFile()." on line ".$e->getLine());
                }else{
                    $_SESSION["UsrMsg"] = $UsrMsg = $Type." ". $Datetime.": ".$Msg;
                }
                error_log($UsrMsg."\n", 3, $_SESSION["LogAbsPath"] . date("Y-m-d") . "-" . $_SESSION["IdUsr"] . ".Log");
            }else{
                error_Log($Msg."\nExternal.Exception.User not logged in.\n", 3, $_SESSION["LogAbsPath"] . "Common.Log");
            }
            return true;
        } catch (Exception $e) {
            $Datetime="[".gmdate('Y-m-d h:i:s')."]";
            $_SESSION["UsrMsg"] = $UsrMsg = $Type." ". $Datetime.": "."Exception ".$Msg->getCode()." Msg: ".$Msg->getMessage()." in ".$Msg->getFile()." on line ".$Msg->getLine()."\n";
            error_Log($UsrMsg, 3, $_SESSION["LogAbsPath"] . "Common.Log");
            return false;
        }
    }

}
