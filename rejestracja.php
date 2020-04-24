<?php
    session_start();
    
    if((isset($_SESSION['zalogowany'])) &&($_SESSION['zalogowany']==true))
    {
        header('Location: gra1.php');  //jesli ktos jest zalogowany to idz do gra.php
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
        <link rel="stylesheet" href="css/plansza.css">
        <link rel="stylesheet" href="css/rejestracja.css">
        <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="container">
        <?php
            require_once 'klasy/User.php';
            require_once 'klasy/Formularz_rejestracji.php';

            $e=new Formularz_rejestracji();
            
            if(filter_input(INPUT_POST, "rejestruj", FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
                $user=$e->filtruj();
                if($user === NULL)
                {
                    echo "<p>Niepoprawne dane rejestracji.</p>";
                }                
                else{
                    echo "<p>Poprawne dane rejestracji:</p>";
                    //$user->show();
                    
                    $user->dodaj();
                    
                }
            }

            
            
        ?>

        </div>
    </body>
</html>

