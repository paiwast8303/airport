<?php 

$db = mysqli_connect("localhost", "root", "", "airport");

function clear($chek)
{
    global $db;
    $cheks=mysqli_real_escape_string($db, trim(htmlspecialchars(strip_tags($chek))));

    return $cheks;

}


?>