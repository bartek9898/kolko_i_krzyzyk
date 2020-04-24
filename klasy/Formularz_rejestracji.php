<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Formularz
 *
 * @author Lenovo
 */

require_once 'User.php';

class Formularz_rejestracji {
    protected $user;
    public function __construct() {
        
        ?>

    <header>
        <h2>Jeśli nie masz konta ,zarejestruj się</h2>
    </header>
    
    <main>
                <div id="formrej">
                            <form method="post" action="#">
                                <label id="imie">Imie:</label> 
                                <input class="in" type="text" name="imie"/><br/><br/>
                                <label id="nazwisko">Nazwisko:</label> 
                                <input class="in" type="text" name="nazwisko"/><br/><br/>
                                <label id="email">email:</label> 
                                <input class="in" type="text" name="email"/><br/><br/>
                                <label id="haslo">haslo:</label> 
                                <input class="in" type="password" name="haslo"/><br/><br/>
                                <label id="haslo1">powtorz haslo:</label> 
                                <input class="in" type="password" name="powtorz"/><br/><br/>
                                <label id="login">podaj login:</label> <input class="in" type="text" name="login" /><br/><br/>
                                <input class="buto" type="submit" value="rejestruj" name="rejestruj" /><br/>
                            </form>
                </div>
    </main>
        <?php
    }
    
    public function filtruj()
    {
        $args = [
          'imie' => [ 'filter' => FILTER_VALIDATE_REGEXP,
              'options' => ['regexp' => '/^[A-Z]{1}[a-z]{2,25}$/']    
          ],
           'nazwisko' => [ 'filter' => FILTER_VALIDATE_REGEXP,
              'options' => ['regexp' => '/^[A-Z]{1}[a-z]{2,25}$/']
          ],
            'email' => FILTER_VALIDATE_EMAIL,
            'haslo' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó]{2,25}(\D|\W)+$/']
                ],
            'powtorz' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó]{2,25}(\D|\W)+$/']
                ],
            'login' => [ 'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[a-zA-Z1-9]{2,25}(\D|\W)+$/']
                ]
        ];
        
        $dane=filter_input_array(INPUT_POST,$args);
        
        //$haslo_hash=password_hash($haslo1,PASSWORD_DEFAULT);
        
        $errors="";
        foreach ($dane as $key => $val) {
                        if ($val === false or $val === NULL) {
                            $errors .= $key . " ";
                        }
                    }
        if($errors === ""){
            
            $this->user=new User($dane['imie'], $dane['nazwisko'], 
                    $dane['email'],$dane['haslo'],$dane['login']);
            
        }else{
            echo "<p>Błędne dane:$errors</p>";
            $this->user=NULL;
        }
        return $this->user;
    }
}
