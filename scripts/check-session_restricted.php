<?php
require_once './scripts/session-handler.php';
session_name("2Org-Cows");
session_start();
$user_role = $_SESSION["role"];
if(isset($_SESSION["ip"])) {
    if($_SESSION["id"] != session_id() ||
        $_SERVER["REMOTE_ADDR"] != $_SESSION["ip"] || 
	$_SERVER["HTTP_USER_AGENT"] != $_SESSION["user_agent"] ||
	!isset($_SESSION["userid"])) {
	session_destroy();
	$val1 = "Session terminated due to security concerns. Please check your internet connection";
	header("Location: .?val1=$val1");
	exit();
	}
} elseif(!isset($_SESSION["ip"])) {
    if($_SESSION["id"] != session_id() || 
	$_SERVER["HTTP_USER_AGENT"] != $_SESSION["user_agent"] || 
	!isset($_SESSION["userid"])) {
            session_destroy();
            $val1 = "Session terminated due to security concerns. Please check your internet connection";
            header("Location: .?val1=$val1");
            exit();
            }
}
if($user_role < 2) {
    $val2 = "You are not allowed to access this page";
    header("Location: ./home?val2=$val2");
    exit();
}
if($user_role > 4) {
    $val3 = "User error";
    session_destroy();
    header("Location: .?val3=$val3");
    exit();
}
$_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
?>
