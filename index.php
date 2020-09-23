<?php

use App\Model\User as Us;

require_once('vendor/autoload.php');

$user = new Us();

echo $user->nome;
echo "<br>";
echo $user->sobrenome;

