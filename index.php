<?php 

    if(isset($_GET['source'])) die(highlight_file(__file__, true));
    //by Kaeru
    $text = isset($_POST['text'])?trim(stripslashes($_POST['text'])):'';
    if(!$text && isset($_POST['text'])) $text = 'You\'re supposed to enter text!';
    $function = isset($_POST['troll'])?$_POST['troll']:'';
    $color = '000';
    
    $trolls = array(
        'aradia' => 'Aradia Megido',
        'tavros' => 'Tavros Nitram',
        'sollux' => 'Sollux Captor',
        'karkat' => 'Karkat Vantas',
        'nepeta' => 'Nepeta Leijon',
        'kanaya' => 'Kanaya Maryam',
        'terezi' => 'Terezi Pypore',
        'vriska' => 'Vriska Serket',
        'equius' => 'Equius Zahhak',
        'gamzee' => 'Gamzee Makara',
        'eridan' => 'Eridan Ampora',
        'feferi' => 'Feferi Peixes'
    );
    
    $select = '<select id="troll" name="troll">';
    foreach($trolls as $n => $troll)
    {
        $select .= '<option value="'.$n.'"'.($n==$function?' selected="selected"':'').'>'.$troll.'</option>';
    }
    $select .= '</select>';
    
    function aradia($text)
    {
        global $color;
        $color = 'A10000';
        
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('%([A-Za-z])\'([A-Za-z])%', '$1$2', $text);
        $text = str_replace('o', '0', $text);
        return $text;
    }
    
    function tavros($text)
    {
        global $color;
        $color = 'A15000';
        
        $text = mb_strtoupper($text, 'UTF-8');
        $text = preg_replace('%[\.!?]%', ',', $text);
        $text = preg_replace('%(, ?)([A-Z])%e', '"$1".mb_strtolower("$2", "UTF-8")', $text);
        $text = preg_replace('%^([A-Z])%se', 'mb_strtolower("$1", "UTF-8")', $text);
        $text = preg_replace('%([^,])$%', '$1,', $text);
        
        return $text;
    }
    
    function sollux($text)
    {
        global $color;
        $color = 'A1A100';
        
        $text = mb_strtolower($text, 'UTF-8');
        $text = str_replace(array('s', 'i'), array('2', 'ii'), $text);
        $text = preg_replace('%\b(too?)\b%', 'two', $text);
        $text = preg_replace('%([^\.!?\)\(])$%', '$1.', $text);
        
        return $text;
    }
    
    function karkat($text)
    {
        global $color;
        $color = '626262';
        
        $text = mb_strtoupper($text, 'UTF-8');
        $text = preg_replace('%([^\.!?\)\(])$%', '$1.', $text);
        
        return $text;
    }
    
    function nepeta($text)
    {
        global $color;
        $color = '416600';

        $text = mb_strtolower($text, 'UTF-8');
        
        $text = str_replace(
            array('ee', 'kat', 'per', 'fer', 'for', 'frus', 'ppo', 'pau', 'po', 'clo', 'clau'),
            array('33', 'cat', 'purr', 'fur', 'fur', 'furs', 'paw', 'paw', 'paw', 'claw', 'claw'), 
            $text
        );
        $text = preg_replace('%r{3,}%', 'rr', $text);
        $text = preg_replace('%([A-Za-z])\'([A-Za-z])%', '$1$2', $text);
        
        $text = ':33 < '.$text;
        
        return $text;
    }
    
    function kanaya($text)
    {
        global $color;
        $color = '008141';

        $text = ucwords(mb_strtolower($text));
        $text = preg_replace('%([A-Za-z])\'([A-Za-z])%', '$1$2', $text);
        $text = preg_replace('%[,\.!?]%', '', $text);
        
        return $text;
    }
    
    function terezi($text)
    {
        global $color;
        $color = '008282';

        $text = mb_strtoupper($text);
        $text = preg_replace('%([A-Za-z])\'([A-Za-z])%', '$1$2', $text);
        $text = str_replace(array('A', 'I', 'E'), array('4', '1', '3'), $text);
        
        return $text;
    }
    
    function equius($text)
    {
        global $color;
        $color = '000056';

        if(substr($text, -3) != '...') // remove ending periods (but not ellipsis)
        {
            $text = preg_replace('%\.$%', '', $text); 
        }
        
        $text = str_ireplace(array('lew', 'loo', 'ool', 'x', 'ct', 'cs', 'cross'), array('100', '100', '001', '%', '%', '%', '%'), $text);
        $text = 'D --> '.$text;
        
        return $text;
    }
    
    function gamzee($text)
    {
        global $color;
        $color = '2B0057';
        $result = '';
        $i = 0;

        $text = mb_strtolower($text, 'UTF-8');
        foreach(str_split($text) as $char)
        {
            if(preg_match('%[a-z]%', $char))
                $result .= ++$i%2?mb_strtoupper($char, 'UTF-8'):$char;
            else    
                $result .= $char;
        }
        
        return $result;
    }
    
    function eridan($text)
    {
        global $color;
        $color = '6A006A';

        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('%[\.;!?]%', '', $text);
        $text = str_replace(array('w', 'v'), array('ww', 'vv'), $text);
        $text = preg_replace('%([A-Za-z])\'([A-Za-z])%', '$1$2', $text);
        $text = preg_replace('%ing\b%', 'in', $text);
        
        return $text;
    }
    
    function vriska($text)
    {
        global $color;
        $color = '004183';

        $text = str_ireplace('b', '8', $text);
        $text = preg_replace('%\b([A-Za-z]*?)(ate|ait|eight|aight)([A-Za-z]*?)\b%', '${1}8$3', $text); // replace 'ate' sound with 8
        $text = preg_replace('%^([a-z])%e', 'mb_strtoupper("$1")', $text); // uppercase first
        $text = preg_replace('%([^\.!?\)\(])$%', '$1.', $text); // period at the end of sentences if there aren't any other punctuation marks already
        $text = preg_replace('%([\.!?]) ?([a-z])%e', '"$1 ".mb_strtoupper("$2", "UTF-8")', $text); // uppercase after each '.', '!' or '?'
        $text = preg_replace('%([\.!?])$%e', 'eight("$1")', $text); // eightify ending punctuation marks
        $text = preg_replace('%([aeiou])%e', 'eight("$1")', $text); // eightify vowels
        
        return $text;
    }
    
    function eight($char)
    {
        $r = $char;
        if(mt_rand(0, (preg_match('%[aeiou]%', $char))?20:10) == 0)
        {
            for($i = 0; $i < 7; ++$i)
            {
                $r .= $char;
            }
        }
        return $r;
    }
    
    function feferi($text)
    {
        global $color;
        $color = '77003C';

        $text = ucfirst($text);
        $text = preg_replace('%([\.?!] ?)([a-z])%e', '"$1".mb_strtoupper("$2", "UTF-8")', $text);
        $text = str_ireplace('h', ')(', $text);
        $text = preg_replace('%E%e', 'trident()', $text);
        $text = preg_replace('%([^\.!?\)\(])$%', '$1.', $text);
        
        return $text;
    }
    
    function trident()
    {
        $r = '';
        for($i = 0; $i < mt_rand(1, 3); ++$i) $r .= '-';
        return $r.'E';
    }
    
    if(isset($trolls[$function]))
    {
        if(function_exists($function))
        {
            $text = preg_replace('% {2,}%', ' ', $text); // we don't want more than one space between words
            $lines = explode(PHP_EOL, $text);
            if(sizeof($lines)>1)
            {
                $result = '';
                foreach($lines as $l)
                {
                    $result .= ($result?PHP_EOL:'').$function(trim($l));
                }
            }
            else
            {
                $result = $function($text);
            }
            
            $result = nl2br(htmlentities($result, ENT_QUOTES, 'UTF-8'));
        }
        else
            $result = 'In progress. Sorry! ;-;';
            
        $result = '<br /><div class="head"><h2>RESULT</h2></div><div id="result"><div id="box">'.$result.'</div></div>';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
    <title>TROLLIFIER</title> 
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
    <meta name="Author" content="Kaeru" /> 
    <style type="text/css"> 
        body{font-size: 12px; color: #000; background: #C6C6C6; font-family: courier, monospace; padding: 20px;}
        h2,h1{margin:0;padding:0}
        div#main{background:#F6F6F6;}
        div.head{background:#000;padding:4px;color:#F6F6F6;}
        div#result{font-weight: bold; min-height: 260px; padding: 4px; border: #A6A6A6 1px dotted; background: #F6F6F6 url('img/<?=$function?>.png') no-repeat 4px 50%;color:#<?=$color?>;padding-left: 250px;}
        div#box{border: 1px dashed gray; padding: 6px; min-height: 260px; margin: 4px;}
        div#foot{border-top: #000 4px solid; background: #fff; line-height: 17px; height: 17px; font-size: .9em; font-weight: bold; padding: 2px; margin-top: 20px;}
    </style> 
</head> 
<body onload="document.getElementById('text').focus();">
    <div class="head"><h1>TROLLIFIER</h1></div>
    <div id="main">
    <form action="?" method="post">
        <table>
        <tr>
            <td><label for="text">Text:</label></td>
            <td><textarea name="text" id="text" cols="12" rows="3"><?=$text?></textarea></td>
        </tr><tr>
            <td><label for="troll">Troll:</label></td>
            <td><?=$select?></td>
        </tr><tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Trollify!" /></td>
        </tr>
        </table>
    </form>
    </div>
<?=$result?>
    <div id="foot">
        <div style="float: left;">By <a href="../../">Kaeru</a>~ | Characters from: <a href="http://www.mspaintadventures.com/?s=6">Homestuck</a></div>
        <div style="float: right;">
            <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="img/css.png" alt="Valid CSS!" /></a>
            <a href="http://validator.w3.org/check?uri=referer"><img src="img/xhtml10.png" alt="Valid XHTML 1.0 Strict" /></a>
        </div>
        <div style="clear: both;"></div>
    </div>
</body>
</html>
