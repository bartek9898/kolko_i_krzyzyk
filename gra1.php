<?php
        // put your code here
            session_start(); //otwarcie sesji
        if(!isset($_SESSION['zalogowany']))
        {
            header('Location: index.php'); //jesli nie ma zalogowanego to idz do index.php
            exit();
        }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=true">
        <script src="funkcje/gra.js"></script>
        <link rel="stylesheet" href="css/gra.css">
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>
    <body onload="wybierz()">
        
            <div id="container">

                <div id="user">
                    <?php
                        echo '<header>'
                    . ''
                                . '<h3 id="info">Rozgrywka pomiędzy graczami: '.$_SESSION['login1']." oraz ".$_SESSION['login2']."</h3>"
                                . ""
                                . "</header>";


                       ?>
                    <nav>
                        
                        <input id="wyloguj" type="button" value="Wyloguj się" onclick="window.location.href='wyloguj.php'">
                        
                    </nav>

                        <?php
                    ?>

                </div>
                
                <main>
                    
                    <div id="rozgrywka">

                    </div>
                    <div id="essa">
                        Kolej gracza 1 (X)
                    </div>
                    
                </main>
                
            </div>
        
    </body>
</html>

