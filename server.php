<?php

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






    $idpracovnika = $people[($row-2)]->getId();




    $sql = "INSERT INTO dochadzka (den, mesiac, rok, id_pracovnik, id_nepritomnost) VALUES (".$col.", ".$mesiac.", ".$rok.", ".$idpracovnika.", ".$idnepritomnost.")";

    return $dbh->exec($sql);
}

?>
