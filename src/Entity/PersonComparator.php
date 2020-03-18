<?php

namespace App\Entity;

class PersonComparator
{
    private $delimiter;

    /**
     * @var Person|null Person1
     */
    private $personOne;

    /**
     * @var Person|null Person2
     */
    private $personTwo;

    /**
     * @param $delimiter
     * @param $personOneData
     * @param $personTwoData
     */
    public function __construct($personOneData = null, $personTwoData = null, $delimiter = "|")
    {
        $this->delimiter = $delimiter;

        // setting object personOne's property
        $this->personOne = $this->buildPerson($personOneData);

        // setting object personTwo's property
        $this->personTwo = $this->buildPerson($personTwoData);
    }

    /**
     * @param String|null
     * 
     * @return Person|null
     */
    private function buildPerson($data){

        if ($data == null)
            return null;

        dd($data);
        $dataArray = explode($this->delimiter, $data);
        if (sizeof($dataArray) != 4)
            return null;

        return new Person($dataArray[0], 
                            $dataArray[1],
                            $dataArray[2],
                            $dataArray[3]);  

    }

    /**
     * @param string|null 
     * 
     * @return array
     */
    public function compare(){

        if ($this->personOne == null || $this->personTwo == null)
            return array("success" => false, "reason" => "Invalid passed parameters");
        return [];
    }

    /**
     * @return String
     */
    public function getDelimiter(){
        return $this->delimiter;
    }

    /**
     * @param String
     * 
     * @return self
     */
    public function setDelimiter($delimiter){
        $this->delimiter = $delimiter;

        return $this;
    }


}
