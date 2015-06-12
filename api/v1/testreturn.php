<?

// test 

function array2XML($arr,$root) { 
$xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><{$root}></{$root}>"); 
echo $xml;
$f = create_function('$f,$c,$a',' 
        foreach($a as $v) { 
            if(isset($v["@text"])) { 
                $ch = $c->addChild($v["@tag"],$v["@text"]); 
            } else { 
                $ch = $c->addChild($v["@tag"]); 
                if(isset($v["@items"])) { 
                    $f($f,$ch,$v["@items"]); 
                } 
            } 
            if(isset($v["@attr"])) { 
                foreach($v["@attr"] as $attr => $val) { 
                    $ch->addAttribute($attr,$val); 
                } 
            } 
        }'); 
$f($f,$xml,$arr); 
return $xml->asXML(); 
} 

echo array2XML('test','test');

?>
