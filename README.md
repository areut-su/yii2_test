

Bank
------------

Необходимо реализовать сервис с следующим функционалом с использованием фреймворка Yii2.

В базе данных должна быть таблица currency c колонками:

    id — первичный ключ
    name — название валюты
    rate — курс валюты к рублю

Должна быть консольная команда для обновления данных в таблице currency. Данные по курсам валют можно взять здесь: http://www.cbr.ru/scripts/XML_daily.asp

Реализовать 2 REST API метода:

    GET bank/currencies — должен возвращать список курсов валют с возможностью пагинации
    GET bamk/currency/<id> — должен возвращать курс валюты для переданного id
    GET bank/currency/INR— пример

API должно быть закрыто bearer-авторизацией.


INSTALLATION
------------

git clone https://github.com/areut-su/yii2-traits.git test
cd  test
git submodule init
git submodule update