<?php

require '../vendor/autoload.php';

function dd($var)
{
    die(var_dump($var));
}

// Load Framework
$app = new Core\Framework();
