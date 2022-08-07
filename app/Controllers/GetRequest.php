<?php

namespace App\Controllers;

class GetRequest extends \MainController
{

      public function index() {

        function errorMsg() {
          die ('{"jsonrpc":"2.0","error": {"code": -32600, "message": "Invalid Request"},"id": null}'); //Инкапсулируем функцию ошибки
        }

        if (isset($_POST) && $_SERVER["CONTENT_TYPE"] == 'application/json') { //Банальная проверка шапки запроса
          $req = json_decode(file_get_contents('php://input'), true);
          $method = $req["method"];
          $par = $req["params"];

          //Собираем наш ответ.

          $json = array(
            "jsonrpc" => "2.0",
            "id" => $req["id"]
          );

          if ($method == "testMe") { //тестовая функция
            $json["result"] = $par;
          } else if ($method == "getTime") { //наша функция на вывод времени
            if ($par == "0") { //текущее время
              $json["result"] = date('Y-m-d H:i:s', time());
            } else if ($par == "1") { //Unix
              $json["result"] = microtime();
            }
          } else {
            errorMsg();
          }

          $sjson = json_encode($json);
          return $sjson;

        } else {
          errorMsg();
        }
    }
}
