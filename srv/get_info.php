<?php
require "MyPdo.class.php";
$conf = require "config.php";

//验证参数
if(!isset($_GET["code"]) || empty($_GET["code"]))
	echo json_encode(back(1,"参数有误"));

$num = encrypt($_GET["code"],'D',$conf["key"]);
$pdo = new MyPdo();
$arr = $pdo->getPathByNum($num);
if( $arr["status"] == 0){
	$res = [
		"url"     => "/".$conf["recordPath"]."/".$arr["message"]["url"].".mp3",
		"message" => "",
		"remark"  => $arr["message"]["remark"],
		"status"  => 0,
	];
	echo json_encode($res);
}else{
	echo json_encode(back(1,$arr["msg"]));
}
