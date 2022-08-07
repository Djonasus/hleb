<?php

namespace App\Controllers;

class GetRequest extends \MainController
{

    public function index() {

        //На всякий случай, я создал базу запросов, с возможностью её дополнять. В будущем, можно её вывести в какой-нибудь конфиг-файл.

        $functionBase = array(
            "testMe" => function($id, $par) { //тестовая функция для проверки
              return ('{"jsonrpc":"2.0","result": "'.$par.'","id": "'.$id.'"}');

            },"getTime" => function($id,$par) { //наша функция
              if ($par == "0") { //если нам нужно текущее время
                  $result = date('Y-m-d H:i:s', time());
                  return ('{"jsonrpc":"2.0","result": "'.$result.'","id": "'.$id.'"}');
              } else if($par == "1") { //это для времени Unix
                  return ('{"jsonrpc":"2.0","result": "'.microtime().'","id": "'.$id.'"}');
              }
            }
            
        );

        if (isset($_POST) && $_SERVER["CONTENT_TYPE"] == 'application/json') { //Банальная проверка шапки запроса
            $req = json_decode(file_get_contents('php://input'), true);
            if (isset($functionBase[$req['method']])) {
                return $functionBase[$req['method']]($req['id'],$req['params']);
            } else{
                return ('{"jsonrpc":"2.0","error": {"code": -32600, "message": "Invalid Request"},"id": null}');
            }
        } else {
            return ('{"jsonrpc":"2.0","error": {"code": -32600, "message": "Invalid Request"},"id": null}');
        }
    }
}
