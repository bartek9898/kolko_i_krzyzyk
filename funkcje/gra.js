
var wcisniete=0;
var wcisniete1=0;
var wyb=0;

klasa='zdjecia2';



function wybierz()
{
        document.getElementById("rozgrywka").innerHTML='<div id="wybor"><h2>Wybierz plansze</h2>'+
                '<button name="3" onclick="plansza(3)">3x3</button>'+
            '<button name="4" onclick="plansza(4)">4x4</button>'+
            '<button name="5" onclick="plansza(5)">5x5</button>'+'</div>';
        
}
    
function plansza(ile)
{
    id=0;
        i=0;
        j=0;
        t='<div id="plansza'+ile+'">';
        for(i=0;i<ile;i++)
        {
            
            for(j=0;j<ile;j++)
            {
                id=(i*ile)+j;
                
                t=t+'<div id="'+id+'" name="'+id+'" class="'+klasa+'" onclick="zmien('+id+','+ile+')">[ ]</div>';
                if(j===(ile-1))
                {
                    
                    t=t+'<div style="clear:both;"></div>';
                }
                
                
            }
        }
        t=t+'</div>';
        
        document.getElementById("rozgrywka").innerHTML=t;
}

function zmien(id,naj)
{
        
        znak='';
        komunikat='';
        if(wyb%2===0)
        {
            znak='[X]';
            
            document.getElementById(id).outerHTML='<div id="'+id+'" name="'+id+'" class="'+klasa+'">[X]</div>';
            wyb=wyb+1;
            document.getElementById("essa").innerHTML="kolej gracza 2 (O)";
            wcisniete=wcisniete+1;
            if(wcisniete>=3)
            {
                sprawdz(naj,znak);
                
            }else{
                
            }
        
        }else if(wyb%2!==0)
        {
            znak='[O]';
            
            document.getElementById(id).outerHTML='<div id="'+id+'" name="'+id+'" class="'+klasa+'">[O]</div>';
            wyb=wyb+1;
            document.getElementById("essa").innerHTML="kolej gracza 1 (X)";
            wcisniete1=wcisniete1+1;
            if(wcisniete1>=3)
            {
               sprawdz(naj,znak); 
            }else{
                
            }
        
        }
        
}


function sprawdz(naj,znak)
{
    if(sprawdz_kolumny(naj,znak)===0)
    {
        if(sprawdz_wiersze(naj,znak)===0)
        {
            if(sprawdz_przekatne(naj,znak)===0)
            {
                if(sprawdz_przekatne1(naj,znak)===0)
                {
                    if(sprawdz_przekatne2(naj,znak)===0)
                    {
                        if(sprawdz_przekatne3(naj,znak)===0 && wyb===naj*naj)
                        {
                            document.getElementById("essa").innerHTML="nie ma wygranej";
                        }
                    }
                }
            }
        }
    }
    
}

function sprawdz_wiersze(naj,znak)
{
    for(i=0;i<naj;i++)
    {
        for(j=0;(j+2)<naj;j++)
        {
            if(document.getElementById((i*naj)+j).innerHTML===znak && document.getElementById((i*naj)+j+1).innerHTML===znak && document.getElementById((i*naj)+j+2).innerHTML===znak)
            {
                var t=1;
                if(znak==='[X]')
                {
                    
                    t="WYGRAŁ GRACZ NUMER 1<br />";
                }
                else{
                    
                    t="WYGRAŁ GRACZ NUMER 2<br />";
                }
                
                
                t=t+'<form method="post" action="tabela.php"><input type="submit" value="ZAPISZ WYNIK GRY" name="'+znak+'"></input></form>';
                t=t+'<input id="opinia_button" type="button" value="podziel się opinią" onclick="opinie()">';
                        
                document.getElementById("essa").innerHTML=t;
            }
            
        }
    }
    if(t===1)
    {
        return t;
    }else return 0;
    
} 

function sprawdz_kolumny(naj,znak)
{
    for(j=0;j<=naj-1;j++)
    {
        for(i=0;(i+2)<naj;i++)
        {
            if(document.getElementById((i*naj)+j).innerHTML===znak && document.getElementById(((i+1)*naj)+j).innerHTML===znak && document.getElementById(((i+2)*naj)+j).innerHTML===znak)
            {
                var t=1;
                if(znak==='[X]')
                {
                    
                    t="WYGRAŁ GRACZ NUMER 1<br />";
                }
                else{
                    
                    t="WYGRAŁ GRACZ NUMER 2<br />";
                }
                
                
                t=t+'<form method="post" action="tabela.php"><input type="submit" value="ZAPISZ WYNIK GRY" name="'+znak+'"></input></form>';
                t=t+'<input id="opinia_button" type="button" value="podziel się opinią" onclick="opinie()">';
                        
                document.getElementById("essa").innerHTML=t;
            }
            
        }
    }
    if(t===1)
    {
        return t;
    }else return 0;
}


function sprawdz_przekatne(naj,znak)
{
    for(j=2;j<naj;j++)
    {
        k=j;
        for(i=0;((i+2)*naj)+k-2<=(j*naj);i++)
        {
            if(document.getElementById((i*naj)+k).innerHTML===znak && document.getElementById(((i+1)*naj)+k-1).innerHTML===znak && document.getElementById(((i+2)*naj)+k-2).innerHTML===znak)
            {
                var t=1;
                if(znak==='[X]')
                {
                    
                    t="WYGRAŁ GRACZ NUMER 1<br />";
                }
                else{
                    
                    t="WYGRAŁ GRACZ NUMER 2<br />";
                }
                
            
                t=t+'<form method="post" action="tabela.php"><input type="submit" value="ZAPISZ WYNIK GRY" name="'+znak+'"></input></form>';
                t=t+'<input id="opinia_button" type="button" value="podziel się opinią" onclick="opinie()">';
                        
                document.getElementById("essa").innerHTML=t;
            }
            k--;
        }
    }
    if(t===1)
    {
        return t;
    }else return 0;
}

function sprawdz_przekatne1(naj,znak)
{

    for(i=1;i<=naj-3;i++)
    {
        k=i;
        for(j=naj-1;j-2>=i;j--)
        {
            if(document.getElementById((k*naj)+j).innerHTML===znak && document.getElementById(((k+1)*naj)+j-1).innerHTML===znak && document.getElementById(((k+2)*naj)+j-2).innerHTML===znak)
            {
                var t=1;
                if(znak==='[X]')
                {
                    
                    t="WYGRAŁ GRACZ NUMER 1<br />";
                }
                else{
                    
                    t="WYGRAŁ GRACZ NUMER 2<br />";
                }
                
            
                t=t+'<form method="post" action="tabela.php"><input type="submit" value="ZAPISZ WYNIK GRY" name="'+znak+'"></input></form>';
                t=t+'<input id="opinia_button" type="button" value="podziel się opinią" onclick="opinie()">';
                        
                document.getElementById("essa").innerHTML=t;
            }
            k++;
        }
    }
    if(t===1)
    {
        return t;
    }else return 0;
}

function sprawdz_przekatne2(naj,znak)
{
    for(j=naj-3;j>=0;j--)
    {
        k=j;
        for(i=0;k+2<=naj-1;i++)
        {
            if(document.getElementById((i*naj)+k).innerHTML===znak && document.getElementById(((i+1)*naj)+k+1).innerHTML===znak && document.getElementById(((i+2)*naj)+k+2).innerHTML===znak)
            {
                var t=1;
                if(znak==='[X]')
                {
                    
                    t="WYGRAŁ GRACZ NUMER 1<br />";
                }
                else{
                    
                    t="WYGRAŁ GRACZ NUMER 2<br />";
                }
                
            
                t=t+'<form method="post" action="tabela.php"><input type="submit" value="ZAPISZ WYNIK GRY" name="'+znak+'"></input></form>';
                t=t+'<input id="opinia_button" type="button" value="podziel się opinią" onclick="opinie()">';
                        
                document.getElementById("essa").innerHTML=t;
            }
            k++;
        }
    }
    if(t===1)
    {
        return t;
    }else return 0;
}

function sprawdz_przekatne3(naj,znak)
{
    for(i=1;i<=naj-3;i++)
    {
        k=i;
        for(j=0;k+2<=naj-1;j++)
        {
            if(document.getElementById((k*naj)+j).innerHTML===znak && document.getElementById(((k+1)*naj)+j+1).innerHTML===znak && document.getElementById(((k+2)*naj)+j+2).innerHTML===znak)
            {
                var t=1;
                if(znak==='[X]')
                {
                    
                    t="WYGRAŁ GRACZ NUMER 1<br />";
                }
                else{
                    
                    t="WYGRAŁ GRACZ NUMER 2<br />";
                }
                t=t+'<form method="post" action="tabela.php"><input type="submit" value="ZAPISZ WYNIK GRY" name="'+znak+'"></input></form>';
                t=t+'<input id="opinia_button" type="button" value="podziel się opinią" onclick="opinie()">';
                
                        
                document.getElementById("essa").innerHTML=t;
                
            }
            k++;
        }
    }
    if(t===1)
    {
        return t;
    }else return 0;
}

function opinie()
{
    window.location.href='opinie.php';
}

function graj_dalej()
{
    window.location.href='gra1.php';
};

