<?php
$file = fopen("characters.txt","r");

while(! feof($file))
{
    $data = fgets($file);
    $character = json_decode($data);
    echo $character->name;
}

fclose($file);
?>