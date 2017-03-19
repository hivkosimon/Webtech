<?php
/**
 * Created by PhpStorm.
 * User: MatejRábek
 * Date: 1.3.2017
 * Time: 15:39
 */
require 'dbconnect.php';
require 'functions.php';




if(isset($_POST['row'])&& isset($_POST['col'])&& isset($_POST['year'])&& isset($_POST['month'])&& isset($_POST['idnepr'])){
    $dbh = connect_to_db(); // function created in dbconnect, remember?
    $people = fetchPracovnik($dbh);



    $row = intval($_POST['row']);
    $col = intval($_POST['col']);
    $rok = intval($_POST['year']);
    $mesiac = intval($_POST['month']);
    $idnepritomnost = intval($_POST['idnepr']);

    $datum = $rok.$mesiac.$col;





    $idpracovnika = $people[($row-2)]->getId();




    $sql = "INSERT INTO dochadzka (datum, id_pracovnik, id_nepritomnost) VALUES (".$datum.", ".$idpracovnika.", ".$idnepritomnost.")";

    return $dbh->exec($sql);
}

?>
