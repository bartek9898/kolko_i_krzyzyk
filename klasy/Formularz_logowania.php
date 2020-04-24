<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formularz_logowania
 *
 * @author Lenovo
 */
class Formularz_logowania {
    public function __construct() {
        ?>


    <header>
        <h1 id="h1_log">Witaj w grze kółko i krzyżyk!</h1>
        <h2 id="h2_log">Zaloguj się do gry</h2><br/>
        
    </header>

    <main>
       <div id="formlog">
                <form method="post" action="#">

                    <label id="login1">Login1:</label> 
                    <input class="in" type="text" name="login1"/><br/><br/>
                    <label id="haslo1">Haslo1:</label> 
                    <input class="in" type="password" name="haslo1"/><br/><br/>
                    <label id="login2">Login2:</label> 
                    <input class="in" type="text" name="login2"/><br/><br/>
                    <label id="haslo2">Haslo2:</label> 
                    <input class="in" type="password" name="haslo2"/><br/><br/>
                    <input class="but" type="submit" value="Login" name="Login"/>
                    <input class="but" type="button" value="Zarejestruj się" onclick="window.location.href='rejestracja.php' ">
                </form>

        <!-- <a href="rejestracja.php">Zarejestruj sie</a></<br /> -->
       </div>

    </main>
 
        <?php
    }
    
    public function filtruj()
    {
        //filtruj login i haslo
        //echo '<div>jestem</div>';
        $args=[
          'login1' => [ 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[a-zA-Z1-9]{2,25}(\D|\W)+$/']
                ], 
          'haslo1' => [ 'filter' => FILTER_VALIDATE_REGEXP,
              'options' => [ 'regexp' => '/^[0-9A-Za-ząęłńśćźżó]{2,25}(\D|\W)+$/' ] 
              ],
          'login2' => [ 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[a-zA-Z1-9]{2,25}(\D|\W)+$/']
                ], 
          'haslo2' => [ 'filter' => FILTER_VALIDATE_REGEXP,
              'options' => [ 'regexp' => '/^[0-9A-Za-ząęłńśćźżó]{2,25}(\D|\W)+$/' ] 
              ],
        ];
        
        $dane=filter_input_array(INPUT_POST,$args);
        $errors="";
        foreach($dane as $value => $val)
        {
            if($val===NULL || $val===false)
            {
                $errors=$errors." ".$value;
                
            }
        }
        
        if($dane['login1']===$dane['login2'])
        {
            $errors=$errors." dwa razy pisany ten sam gracz";
        }
        
        if($errors === ""){
            return 1;
        }else{
            echo "<p>Błędne dane:$errors</p>";
            return 0;
        }
    }
    
    public function loguj()
    {
        $login1=$_POST['login1'];
        $haslo1=$_POST['haslo1'];
        $login2=$_POST['login2'];
        $haslo2=$_POST['haslo2'];
        
        
        $polaczenie=new mysqli("localhost","root","","kolko_i_krzyzyk");
            if($polaczenie->connect_errno!=0)
            {
                echo "Bład połączenia: ".$polaczenie->connect_errno." Opis: ".$polaczenie->connect_error;
            }else{
                
                $sql="SELECT * FROM gracze WHERE login='$login1'";
                
                if($rezultat=@$polaczenie->query($sql)) //jesli zapytanie sie wykonalo
                {
                    $ilu_userow=$rezultat->num_rows; //pobranie liczby rekordow
                    if($ilu_userow==1)
                    {
                        $wiersz=$rezultat->fetch_assoc(); //tablica asocjacyna przechowujaca kolumny z rekordu bazy
                        if(password_verify($haslo1,$wiersz['haslo']))
                        {
                            $_SESSION['zalogowany']=true;
            
                            //$wiersz=$rezultat->fetch_assoc(); //tablica asocjacyna przechowujaca kolumny z rekordu bazy
                            $_SESSION['ID_gracz1']=$wiersz['ID_gracz'];
                            $_SESSION['Imie1']=$wiersz['imie'];
                            $_SESSION['Nazwisko1']=$wiersz['nazwisko'];
                            $_SESSION['Email1']=$wiersz['email'];
                            $_SESSION['Haslo1']=$wiersz['haslo'];
                            $_SESSION['login1']=$wiersz['login'];
                            $_SESSION['data1']=$wiersz['data'];
            
                            unset($_SESSION['blad']); //zniszcz zmienna blad
            
                            $rezultat->free(); 
                        }else{
                            $r=$wiersz['haslo'];
                            echo $r.''.$haslo1.'<br />';
                        }
                    }else{
        
                        echo '<p>gracza1 nie ma w bazie</p>';
                        
                    }
                } 
                
                //////////////////////////////////////////////////////////////
                
                $sql="SELECT * FROM gracze WHERE login='$login2'";
                
                if($rezultat=@$polaczenie->query($sql)) //jesli zapytanie sie wykonalo
                {
                    $ilu_userow=$rezultat->num_rows; //pobranie liczby rekordow
                    if($ilu_userow==1)
                    {
                        $wiersz=$rezultat->fetch_assoc(); //tablica asocjacyna przechowujaca kolumny z rekordu bazy
                        if(password_verify($haslo2,$wiersz['haslo']))
                        {
                            $_SESSION['zalogowany']=true;
            
                            //$wiersz=$rezultat->fetch_assoc(); //tablica asocjacyna przechowujaca kolumny z rekordu bazy
                            $_SESSION['ID_gracz2']=$wiersz['ID_gracz'];
                            $_SESSION['Imie2']=$wiersz['imie'];
                            $_SESSION['Nazwisko2']=$wiersz['nazwisko'];
                            $_SESSION['Email2']=$wiersz['email'];
                            $_SESSION['Haslo2']=$wiersz['haslo'];
                            $_SESSION['login2']=$wiersz['login'];
                            $_SESSION['data2']=$wiersz['data'];
            
                            unset($_SESSION['blad']); //zniszcz zmienna blad
            
                            $rezultat->free(); 
                        }else{
                            $r=$wiersz['haslo'];
                            echo $r.''.$haslo2.'<br />';
                        }
                    }else{
        
                        echo '<p>gracza2 nie ma w bazie</p>';
                        
                    }
                }
                
                $polaczenie->close();
            }
            header("Location: gra1.php");
    }
    
}
