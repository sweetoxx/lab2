**Асташов Иван 3131**
# **Лабораторная работа №2**
---
##### [Репозиторий на github](https://github.com/sweetoxx/lab2)
## Цель работы
Разработать и реализовать клиент-серверную информационную систему, реализующую механизм CRUD
## Задание
Система предназначена для анонимного общения в сети интернет.
Возможности пользователей:
* добавление текстовых заметок в общую ленту
* реагирование на чужие заметки 
## Интерфейс системы
![a](https://github.com/sweetoxx/lab2/blob/main/mainpage.png)
## Сценарии работы
* Пользователь вводит свой никнейм и желаемое сообшение, нажимает кнопку "Post", чтобы отправить заметку на сайт - после загрузки заметка попадает наверх списка, остальные сообщения сдвигаются вниз.
* Если пользователь оставит одно или более окно незаполненным, то на экране появляется сообщение "Оne or more windows are not filled." и комментарий не будет выгружен на сайт.
## Описание API сервера и хореографии
Сервер использует HTTP POST запросы для добавления комментариев в базу данных.
* Отправка сообщения - после проверки  заполненности полей в базу данных отправляется запрос, добавляющий комментарий в базу данных учитывая никнейм, основной текст сообщения а так же дату и время отправки. Если пользователь оставит одно или более окно незаполненным то сообщение не будет оправлено, но пользователю будет выведено сообщение о необходимости заполнить недостающие окна.
* Вывод коментариев на "стену" форума - в базу данных отправляется запрос на вывод коментариев, которые сортируются в обратном порядке, и последние по времени 100 коментариев выводятся на "стену".
* Оценивание заметок - при нажатии на кнопку "Like" на определённом сообщении страница обновляется и счётчик "Likes: N", где N - число лайков, возрастающее на единицу.
## Описание структуры базы данных
Для администрирования сервера MySQL и просмотра содержимого базы данных используется браузерное приложение phpMyAdmin. Используется 5 столбцов:

* "message_id" типа int с автоматическим приращением для выдачи уникальных id каждому сообщению,
* "message_title" типа text для хранения заголовка комментария,
* "message_text" типа text для хранения сообщения комментария,
* "date" типа datetime для хранения даты и времени отправки сообщения на сайт,
* "likes" типа int для хранения числа лайков на этом сообщении.
## Программный код
### Функция вывода коментария на форум
```php
function getComments($page_count) {
    require("connection.php");
    $query = "SELECT * FROM forum ORDER BY message_id DESC LIMIT 100";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {   
        echo "<div class='comment'>
            <div> By <b>Unknown</b> on <i>".$row['date']."</i><br><b>".$row['message_title']."</b></div>
            <div>".$row["message_text"]."</div>
            <div><br>  <form method='POST' action='".likeSubmit($row)."'>  <button type='submit' name='".$row['message_id']."' class='like_button'>Like</button>  Likes: ".$row["likes"]."</form></div>
        </div><br>";
    }
}
```
### Функция реагирования на заметки(лайки)
```php
function likeSubmit($row) {
    require("connection.php");
    if(isset($_POST[$row['message_id']])) {
        $id = $row['message_id'];
        $likes = $row['likes']+1;
        $query = "UPDATE forum SET likes = '$likes' WHERE message_id = '$id'";
        $result = mysqli_query($con, $query);
        header('Location: index.php');
        exit;
    }
}
```
