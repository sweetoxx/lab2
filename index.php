<?php
    include "connection.php";
    include "functions.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forum page</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <h1><center>My first forum! :-)</center></h1>
    <div class='box'>
    


    <?php
    
    global $page_count;
    echo " <br><form method='POST' action='".setComment()."'>
        <input type ='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <a>Your Nickname:</a><br><textarea name='message_title'></textarea><br><br>
        <a>Message:</a><br><textarea name='message_text'></textarea><br><br>
        <button type='submit' name='commentSubmit'>Post</button>
    </form><br>";
    getComments($page_count);
    ?>
    
    </div>
    
    </body>
</html>