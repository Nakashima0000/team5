<?php
    class DAO{
        private  function  dbConnect(){
            $dsn = 'mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1418122-asobiba;charset=utf8';
            $user = 'LAA1418122';
            $password = 'asobiba';
            $pdo = new PDO($dsn, $user, $password);
            return $pdo;
        }

        /*private  function  dbConnect(){
            $dsn = 'mysql:host=localhost;dbname=asobanto;charset=utf8';
            $user = 'root';
            $password = '';
            $pdo = new PDO($dsn, $user, $password);
            return $pdo;
        }*/

        //Shohinを全て配列として返すメソッド
        //商品一覧用
        public function getSpotsAll(){
            $pdo= $this->dbConnect();
            $sql= "SELECT spots.spots_id AS 'spots_id' , spots.name AS 'name' , spots.adress AS 'adress' , spots.time AS 'time' , spots.detail AS 'detail' ,
                        images.image AS 'image' ,
                        coodinates.latitude AS 'latitude' , coodinates.longitude AS 'longitude',
                        conditions.generation AS 'generation', conditions.fee AS 'fee', conditions.people AS 'people', conditions.date AS 'date', conditions.outdoor AS 'outdoor', conditions.indoor AS 'indoor'
                        FROM spots 
                        INNER JOIN images 
                        ON spots.spots_id = images.spots_id 
                        INNER JOIN coodinates 
                        ON images.spots_id = coodinates.spots_id
                        INNER JOIN conditions
                        ON coodinates.spots_id = conditions.spots_id
                        WHERE spots.spots_id = 1 OR spots.spots_id = 2 OR spots.spots_id = 3
                        GROUP BY spots.spots_id;";
            $ps= $pdo->prepare($sql);
            $ps->execute();
            $searchArray = $ps->fetchAll();
            return $searchArray;
        }

        public function searchSpot($generation,$fee,$people,$date,$outdoor,$indoor) {
            $pdo= $this->dbConnect();
            $sql= "SELECT spots.spots_id AS 'spots_id' , spots.name AS 'name' , spots.adress AS 'adress' , spots.time AS 'time' , spots.detail AS 'detail' ,
                        images.image AS 'image' ,
                        coodinates.latitude AS 'latitude' , coodinates.longitude AS 'longitude',
                        conditions.generation AS 'generation', conditions.fee AS 'fee', conditions.people AS 'people', conditions.date AS 'date', conditions.outdoor AS 'outdoor', conditions.indoor AS 'indoor'
                        FROM spots 
                        INNER JOIN images 
                        ON spots.spots_id = images.spots_id 
                        INNER JOIN coodinates 
                        ON images.spots_id = coodinates.spots_id
                        INNER JOIN conditions
                        ON coodinates.spots_id = conditions.spots_id
                        WHERE conditions.generation = ? AND conditions.fee = ? AND conditions.people = ? AND conditions.date = ? AND conditions.outdoor = ? AND conditions.indoor = ?
                        GROUP BY spots.spots_id;";
            $ps= $pdo->prepare($sql);
            $ps->bindValue(1, $generation, PDO::PARAM_STR);
            $ps->bindValue(2, $fee, PDO::PARAM_STR);
            $ps->bindValue(3, $people, PDO::PARAM_STR);
            $ps->bindValue(4, $date, PDO::PARAM_INT);
            $ps->bindValue(5, $outdoor, PDO::PARAM_INT);
            $ps->bindValue(6, $indoor, PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();
            return $searchArray;
        }
    }
?>