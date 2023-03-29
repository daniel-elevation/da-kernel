<?php

class dbClass
{
    private array $dbConfigArray = array(
    );

    public function __construct($db_config_array){
        require_once 'class-pdohelper.php';
        require_once 'class-pdowrapper.php';

        $this->setDbConfigArray($db_config_array);
        var_dump($this->getDbConfigArray());
        $this->db = new PdoWrapper($this->dbConfigArray);
    }

    /**
     * @return array
     */
    public function getDbConfigArray()
    {
        return $this->dbConfigArray;
    }

    /**
     * @param array $dbConfigArray
     */
    public function setDbConfigArray($dbConfigArray)
    {
        $this->dbConfigArray = $dbConfigArray;
    }


}