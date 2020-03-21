<?php

namespace App\Entity;

use DateTime;

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

        $dataArray = explode($this->delimiter, $data);
        if (sizeof($dataArray) != 4)
            return null;

        if (($dataArray[2] = strtotime($dataArray[2])) === false)
            return null;

        $dataArray[2] = new \DateTime(date("d-m-Y",$dataArray[2]));

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
            return array("achieved" => false, "reason" => "Invalid passed parameters");

        $result = ["achieved" => true];

        // comparing persons' firstName
        $result["firstName"] = $this->comparePersonProperty($this->personOne->getFirstName(), 
                                              $this->personTwo->getFirstName());

        // comparing persons' lastName
        $result["lastName"] = $this->comparePersonProperty($this->personOne->getLastName(), 
                                              $this->personTwo->getLastName());

        // comparing persons' birthDate
        if ($this->personOne->getBirthDate() == $this->personTwo->getBirthDate())
            $result["birthDate"] = array("output"   => true);
        else
            $result["birthDate"] = array("output"   => false);

        // comparing persons' birthPlace
        $result["birthPlace"] = $this->comparePersonProperty($this->personOne->getBirthPlace(), 
                                              $this->personTwo->getBirthPlace());

        // echo (int) $result["firstName"]["output"];
        $globalPercentage = Parameters::$weights["firstName"] * (int) $result["firstName"]["output"] + 
                            Parameters::$weights["lastName"] * (int) $result["lastName"]["output"] + 
                            Parameters::$weights["birthDate"] * (int) $result["birthDate"]["output"] + 
                            Parameters::$weights["birthPlace"] * (int) $result["birthPlace"]["output"];
        $globalPercentage /= 10;

        $output = (($globalPercentage > Parameters::$globalThreshold) ? true : false);
        $result["globalOutput"] = array("percentage" =>   $globalPercentage,
                                        "output"    =>  $output);

        return $result;
    }

    /**
     * @param String
     * @param String
     * 
     * @return array
     */
    public function comparePersonProperty($stringOne, $stringTwo){

        // the following could be change in the future
        $stringOneArray = explode(" ", $stringOne);
        $stringTwoArray = explode(" ", $stringTwo);

        $globalPercentage = 0;
        
        foreach ($stringOneArray as $itemOne) {
            
            $tmpString = $stringTwoArray[0];
            $tmpPercentage = 100;
            foreach ($stringTwoArray as $itemTwo) {
                $percentage = $this->compareString($itemOne, $itemTwo);
                if ($percentage < $tmpPercentage){
                    $tmpPercentage = $percentage;
                    $tmpString = $itemTwo;
                }
            }
        }

        $globalPercentage = $tmpPercentage;
        $output = (($globalPercentage <= Parameters::$stringPropertyThreshold) ? true : false);
        return array("pourcentage" => $globalPercentage,
                     "output"       =>  $output);
    }

    /**
     * @param String
     * @param String
     * 
     * @return array
     */
    public function compareString($itemOne, $itemTwo){

        $itemOneArray = str_split($itemOne);
        $itemTwoArray = str_split($itemTwo);
        $length1 = sizeof($itemOneArray);
        $length2 = sizeof($itemTwoArray);
        $i = 0;
        $diff = 0;
        foreach ($itemOneArray as $char) {

            if ($i >= $length2){
                $diff += ($length1-$length2);
                break;
            }

            if ($char != $itemTwoArray[$i])
                $diff++;

            $i++;

            if ($i == $length1 && $length2 > $length1){
                $diff += ($length2-$length1);
            }
        }
        $longest = (($length2 > $length1) ? $length2 : $length1);

        $percentage = ($diff / $longest);

        return $percentage;
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

    /**
     * @param Person
     * 
     * @return self
     */
    public function setPersonOne(Person $person){
        $this->personOne = $person;

        return $this;
    }

    /**
     * @return Person
     */
    public function getPersonOne(){
        return $this->personOne;
    }

    /**
     * @param Person
     * 
     * @return self
     */
    public function setPersonTwo(Person $person){
        $this->personTwo = $person;

        return $this;
    }

    /**
     * @return Person
     */
    public function getPersonTwo(){
        return $this->personTwo;
    }

}
