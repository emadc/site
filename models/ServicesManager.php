<?php

class ServicesManager
{

    private $bdd;

    public function __construct()
    {
        $config = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '../db_config.php', true);
        $this->bdd = new PDO("mysql:host=" . $config['sql']['ods']['host'] . "; dbname=" . $config['sql']['ods']['base'] . "; charset=utf8", $config['sql']['ods']['user'], $config['sql']['ods']['pass']);
    }

    /**
     * Returns an array of ServiceObj objects
     *
     * @return ArrayObject ServiceObj
     */
    public function getServices()
    {
        $bdd = $this->bdd;
        $services = new ArrayObject();
        
        /**
         * * accès au model **
         */
        $query = "SELECT * FROM services ";
        
        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            
            $service = new ServiceObj();
            $service->setId($row['id']);
            $service->setTitle($row['title']);
            $service->setText($row['text']);
            $service->setImage($row['image']);
            
            $services[] = $service;
        }
        ;
        
        return $services;
    }
}