<?php
require 'pracovnik.php';
require  'dochadzka.php';
function fetchPracovnik( $conn )
{
    $request = $conn->prepare(" SELECT id, meno, priezvisko FROM pracovnici order by priezvisko");
    $request->setFetchMode(PDO::FETCH_CLASS, "pracovnik");
    return $request->execute() ? $request->fetchAll() : false;
}


function fetchDochadzka( $conn )
{
    $request = $conn->prepare(" SELECT  dochadzka.id, dochadzka.den, dochadzka.mesiac, dochadzka.rok, dochadzka.id_pracovnik, dochadzka.id_nepritomnost, pracovnici.id, pracovnici.meno, pracovnici.priezvisko, nepritomnosti.id, nepritomnosti.typ_nepritomnosti FROM dochadzka INNER JOIN  pracovnici ON pracovnici.id = dochadzka.id_pracovnik INNER JOIN  nepritomnosti ON nepritomnosti.id = dochadzka.id_pracovnik ");
    $request->setFetchMode(PDO::FETCH_CLASS, "dochadzka");
    return $request->execute() ? $request->fetchAll() : false;
}
