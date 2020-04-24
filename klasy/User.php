<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Lenovo
 */
class User {
    protected $imie;
    protected $nazwisko;
    protected $email;
    protected $haslo;
    protected $login;
    protected $date;
    
    public function __construct($imie ,$nazwisko ,$email ,$haslo ,$login) {
        $this->imie=$imie;
        $this->nazwisko=$nazwisko;
        $this->email=$email;
        $this->haslo=password_hash($haslo ,PASSWORD_DEFAULT );
        $this->login=$login;
        $this->date=(new DateTime('NOW'))->format('Y-m-d');
    }
    
    public function show()
    { 
        echo ''.$this->imie.'</br>';
        echo ''.$this->nazwisko.'</br>';
        echo ''.$this->email.'</br>';
        echo ''.$this->haslo.'</br>';
        echo ''.$this->login.'</br>';
    }
    
    public function dodaj()
    {
        $polaczenie=new mysqli("localhost", "root", "", "kolko_i_krzyzyk");
        
        if($polaczenie->connect_errno!=0)
        {
            
            echo "Error: ".$polaczenie->connect_errno. "Opis ".$polaczenie->connect_error;
        } else {
            
            $sql="INSERT INTO gracze (ID_gracz, imie ,nazwisko ,email ,haslo ,login ,data) VALUES (NULL, '$this->imie', '$this->nazwisko' ,'$this->email' ,'$this->haslo' ,'$this->login' ,'$this->date')";
            
            if($rezultat=@$polaczenie->query($sql)) //jesli zapytanie sie wykonalo
            {
                header("Location: index.php");
                //$rezultat->free();
            }else{
                echo '<p>Błąd rejestracji, uzytkownik juz istnieje bądź login jest zajęty </p>';
            }
        }
        $polaczenie->close();
    }
}