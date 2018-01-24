<?php

require_once 'regex.php';

$regex = new \App\RegexTool();
$regex->setFixMode('U');
$re = $regex->isEmail('yyusd_ddd@139.com');
show($re,'true');

function show($var = null, $is_dump = false)
{
    $fun = $is_dump ? 'var_dump' : 'print_r';
    if (empty($var)) {
        echo 'null';
    } elseif (is_array($var) || is_object($var)) {
        echo "<pre>";
        $fun($var);
        echo "<pre>";
    } else {
        $fun($var);
    }
}
