<?php
        // put your code here
            session_start(); //otwarcie sesji
        if(!isset($_SESSION['zalogowany']))
        {
            header('Location: index.php'); //jesli nie ma zalogowanego to idz do index.php
            exit();
        }
        
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=true">
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
<script src="funkcje/gra.js"></script>
<link rel="stylesheet" href="css/opinie.css">

<div id="container">
    
    <nav>
        <button id="wroc" onclick='window.location.href="gra1.php"'>Wróć do gry</button>
    </nav>
    
    <header>
            <h2>Dołącz do miliona zadowolonych użytkowników!</h2>
    </header>
    
    <section>
    
        <div id="dodawanie">


             <form method="post" action="#">
                 <input type="text" name="nick" placeholder="wpisz nick"/>
                <br /><br />
                <textarea name="opinia" placeholder="wpisz opinie"></textarea>



                <div style="clear: both;"></div>
                <br />
                <input type="submit" name="dodaj" value="Dodaj opinie" />
             </form>

        </div>
        
    </section>
    
    <section>

        <?php
        
            $polaczenie=new mysqli("localhost","root","","kolko_i_krzyzyk");
                                    if($polaczenie->connect_errno!=0)
                                    {
                                        echo "Error: ".$polacznie->connect_errno." "."Opis: ".$polaczenie->connect_error;
                                    }else{

                                        $sql="SELECT * FROM opinie WHERE 1=1";
                                        if($rezultat=@$polaczenie->query($sql))
                                        {
                                            if($rezultat->num_rows>0)
                                            {
                                                echo '<h3>Opinie o nas:</h3><div style="overflow-y: scroll; height:395px;" id="zbior_opini"><table><tbody>';
                                               while($r=mysqli_fetch_assoc($rezultat))
                                                {
                                                    $nick=$r['nick'];
                                                    $tresc=$r['tresc'];
                                                    
                                                    $tresc_podziel=explode(" ",$tresc);
                                                   
                                                    $tresc_wyswietl='';
                                                    $j=1;
                                                    //for($i=0;$i<count($tresc_podziel);$i++)
                                                    /*{
                                                     
                                                        if(strlen($tresc_wyswietl)>(70*($j+1)))
                                                        {
                                                            $tresc_wyswietl.="<br />";
                                                            $j+=1;
                                                        }else{
                                                            $tresc_wyswietl.=' ';
                                                          
                                                        }
                                                        
                                                        $tresc_wyswietl.=$tresc_podziel[$i];
                                                        
                                                    }*/
                                                    echo "<tr><td><h3>".$nick."</h3></td>"."<td>".$tresc."</td></tr>";
                                                    
                                                }
                                            }
                                        echo '</tbody></table></div>';
                                        $rezultat->free(); 

                                        }else{
                                            echo '<p style="margin-left: 200px;"><mark>cos nie tak</mark></p>';
                                        } 
                                    }
                                $polaczenie->close();
                                
                                
                                
        if(isset($_POST['dodaj']))
        {
            $polaczenie=new mysqli("localhost","root","","kolko_i_krzyzyk");
            if(!(isset($_POST['nick']) && isset($_POST['opinia'])))
            {
                echo 'niepełne dane';
            }else{
                if(  $_POST['nick']===$_SESSION['login1']  || $_POST['nick']===$_SESSION['login2'] )
                {
                    $polaczenie=new mysqli("localhost","root","","kolko_i_krzyzyk");
                    if($polaczenie->connect_errno!=0)
                    {
                        echo "<p style="."color: red;".">Error: ".$polacznie->connect_errno." "."Opis: ".$polaczenie->connect_error."</p>";
                    }else{
                        
                        $opinia=$_POST['opinia'];
                        $data=(new DateTime('NOW'))->format('Y-m-d');
                        if($_POST['nick']===$_SESSION['login1'])
                        {
                            $id=$_SESSION['ID_gracz1'];
                            
                        }else{
                            
                            $id=$_SESSION['ID_gracz2'];
                        }
                        $nick=$_POST['nick'];
                        
                        $opinia=htmlentities($opinia,ENT_QUOTES, "UTF-8");
                        
                        $sql="INSERT INTO opinie (ID_opinia,ID_gracz,tresc,data,nick) VALUES (NULL,'$id','$opinia','$data','$nick')";
                        
                        if($rezultat=@$polaczenie->query(sprintf("INSERT INTO opinie (ID_opinia ,ID_gracz ,tresc ,data,nick) VALUES (NULL ,'$id' ,'%s' ,'$data','$nick')",mysqli_real_escape_string($polaczenie,$opinia))))
                        {
                            //$rezultat->free(); 
                            echo '<p style="color: green;">opinia zostala dodana <br /><a href="gra1.php">Powróć do gry</a></p>';
                            
                        }else{
                            echo '<p style="color: red;">cos nie tak</p>';
                        }
                        
                        
                    }
                    $polaczenie->close();
                }else{
                    echo '<p style="color: red;">ten uzytkownk nie jest zalogowany w tej sesji</p>';
                }
            }
        }
        
        ?>
        
    </section>
    
</div>




        
        
        
        