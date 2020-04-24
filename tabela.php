<?php
        // put your code here
            session_start(); //otwarcie sesji
        if(!(isset($_POST['X']) || isset($_POST['O'])))
        {
            header('Location: index.php'); //jesli nie ma zalogowanego to idz do index.php
            exit();
        }else{
            if(isset($_POST['X']))
            {
                $loginw=$_SESSION['login1'];
                $loginp=$_SESSION['login2'];
                $id=$_SESSION['ID_gracz1'];
            }else{
                $loginw=$_SESSION['login2'];
                $loginp=$_SESSION['login1'];
                $id=$_SESSION['ID_gracz2'];
            }
        }
        
        $data=(new DateTime('NOW'))->format('Y-m-d');
        
        $polaczenie=new mysqli("localhost","root","","kolko_i_krzyzyk");
        
        if($polaczenie->connect_errno!=0)
        {
            echo 'Error: '.$polaczenie->connect_errno.' Opis: '.$polaczenie->connect_error.'';
        }else{
            $sql="INSERT INTO wyniki (ID_wynik , ID_gracz, przegrany, wygrany ,data) VALUES (NULL ,'$id' ,'$loginp','$loginw' ,'$data')";           
            if(!$rezultat=@$polaczenie->query($sql)) //jesli zapytanie sie nie wykonalo
            {
                echo 'błąd';
            }
        }
        
?>


