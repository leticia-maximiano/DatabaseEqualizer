<?php
require_once "./ScriptList.php";

header("Accept: application/json");
header("Content-Type: application/json");

$request = json_decode(file_get_contents('php://input'), true);

switch($request['route']) {
  case "ScriptList":
    $scriptList= new ScriptList();

    echo json_encode($scriptList->getScriptList());
    break;
}
