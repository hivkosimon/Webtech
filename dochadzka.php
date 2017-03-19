<?php

class  dochadzka
{
    protected $id, $datum, $id_pracovnik, $id_nepritomnost;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getIdPracovnik()
    {
        return $this->id_pracovnik;
    }

    /**
     * @param mixed $id_pracovnik
     */
    public function setIdPracovnik($id_pracovnik)
    {
        $this->id_pracovnik = $id_pracovnik;
    }

    /**
     * @return mixed
     */
    public function getIdNepritomnost()
    {
        return $this->id_nepritomnost;
    }

    /**
     * @param mixed $id_nepritomnost
     */
    public function setIdNepritomnost($id_nepritomnost)
    {
        $this->id_nepritomnost = $id_nepritomnost;
    }




}