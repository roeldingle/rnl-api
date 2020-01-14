<?php
echo "tester";
/*
straightarrow-tech.com:2082	straigy4	P@ssw0rd12345
git pull https://github.com/roeldingle/rnl-api.git master
*/

$f = fsockopen('smtp host', 25) ;
if ($f !== false) {
    $res = fread($f, 1024) ;
    if (strlen($res) > 0 && strpos($res, '220') === 0) {
        echo "Success!" ;
    }
    else {
        echo "Error: " . $res ;
    }
}
fclose($f) ;

