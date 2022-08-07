# hleb-проект
 
Для тестов лучше всего использовать Postman.

Веб-приложение получает на вход запрос в виде jsonrpc методом post. А на выходе отдает ответ, тоже в jsonrpc.

##Примеры

~~~json
{"jsonrpc":"2.0","method":"getTime","params":"0","id":0}
~~~
Вернёт текущее время.
~~~json
{"jsonrpc":"2.0","method":"getTime","params":"1","id":0}
~~~
Вернёт время Unix.
~~~json
{"jsonrpc":"2.0","method":"testMe","params":"Hello World!","id":0}
~~~
Тестовый эхо-запрос
