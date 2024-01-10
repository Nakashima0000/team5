<?php

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=UTF-8');

    require './DAO.php';
    $dao = new DAO();  

    //配列の宣言（無いとエラーが発生した）
    $data = array();

    if(isset($_GET['set'])){
    
        switch($_GET['set']){

            //shohin一覧取得
            case 'getSpotsAll':
                $search = $dao->getSpotsAll();
                $data = array();
                //データベースから持ってきたデータをforeachを利用してデータの数だけ$dataに追加している
                foreach ($search as $row) {
                    array_push($data, 
                        array('spots_id' => $row['spots_id'],
                            'name' => $row['name'],
                            'adress' => $row['adress'],
                            'time' => $row['time'],
                            'detail' => $row['detail'],
                            'image' => $row['image'],
                            'latitude' => $row['latitude'],
                            'longitude' => $row['longitude'],
                            'generation' => $row['generation'],
                            'fee' => $row['fee'],
                            'people' => $row['people'],
                            'date' => $row['date'],
                            'outdoor' => $row['outdoor'],
                            'indoor' => $row['indoor']
                            ));
                }

                //arrayの中身をJSON形式に変換している
                $json_array = json_encode($data);

                print $json_array; //配列
                
                break;

            case 'insertSpot':
                $dao->insertSpot($_GET['results']);

                break;

            case 'searchSpot':
                $search = $dao->searchSpot($_GET['generation'],$_GET['fee'],$_GET['people'],$_GET['date'],$_GET['outdoor'],$_GET['indoor']);
                $data = array();

                foreach ($search as $row) {
                    array_push($data, 
                        array('spots_id' => $row['spots_id'],
                            'name' => $row['name'],
                            'adress' => $row['adress'],
                            'time' => $row['time'],
                            'detail' => $row['detail'],
                            'image' => $row['image'],
                            'latitude' => $row['latitude'],
                            'longitude' => $row['longitude'],
                            'generation' => $row['generation'],
                            'fee' => $row['fee'],
                            'people' => $row['people'],
                            'date' => $row['date'],
                            'outdoor' => $row['outdoor'],
                            'indoor' => $row['indoor']
                            ));
                }

                //arrayの中身をJSON形式に変換している
                $json_array = json_encode($data);

                print $json_array; //配列
                
                break;
        }
    }

    
    
    //arrayの中身をJSON形式に変換している
    //$json_array = json_encode($data);

    //print $json_array;

?>