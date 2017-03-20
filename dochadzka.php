<?php

class  dochadzka
{
    protected $id, $den, $mesiac, $rok, $id_pracovnik, $id_nepritomnost;

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
    public function getDen()
    {
        return $this->den;
    }

    /**
     * @param mixed $den
     */
    public function setDen($den)
    {
        $this->den = $den;
    }

    /**
     * @return mixed
     */
    public function getMesiac()
    {
        return $this->mesiac;
    }

    /**
     * @param mixed $mesiac
     */
    public function setMesiac($mesiac)
    {
        $this->mesiac = $mesiac;
    }

    /**
     * @return mixed
     */
    public function getRok()
    {
        return $this->rok;
    }

    /**
     * @param mixed $rok
     */
    public function setRok($rok)
    {
        $this->rok = $rok;
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