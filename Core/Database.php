<?php

    class Database{

        public $connection;
        public $query;

        function __construct($config,$user ='root',$password = ''){

            $dsn = 'mysql:'.http_build_query($config,'',';');
            $this->connection = new PDO($dsn,$user,$password,[
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        
        public function query($query,$par=[]){
            
            $this->query = $this->connection->prepare($query);
            $this->query->execute($par);
            return $this;
        }

        public function fetch(){
            return $this->query->fetch();
        }

        public function fetchAll(){
            return $this->query->fetchAll();
        }

        public function fetchorFail(){
            $result = $this->query->fetch();
            if(!$result){
                return false;
            }
            else{
                return $result;
            }
        }
    }
?>