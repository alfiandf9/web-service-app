<?php
// load file /model/UserModel.php
require __DIR__.'/../model/UserModel.php';

// membuat object/instance dari class UserModel.php
$userModel = new UserModel();

// Mendapatkan request URL
$url = $_SERVER['REQUEST_URI'];

//if use folder path 
$urlArr = explode("index.php", $url);
if (count($urlArr) >= 2) {
    $url = $urlArr[1];
}

// if use php -S localhost:8000
if(strpos($url,"/") !== 0){
    $url = "/$url";
}


// header("Content-Type:application/json");

if($url == '/users' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    // $users = array(
    //     array('id' => 1, 'name' => 'Sumatrana', 'email' => 'sumatrana@gmail.com', 'address' => 'Padang', 'gender' => 'Laki-laki'),
    //     array('id' => 2, 'name' => 'Jawarianto', 'email' => 'jawarianto@gmail.com', 'address' => 'Cimahi', 'gender' => 'Laki-laki'),
    //     array('id' => 3, 'name' => 'Kalimantanio', 'email' => 'kalimantanio@gmail.com', 'address' => 'Samarinda', 'gender' => 'Laki-laki'),
    //     array('id' => 4, 'name' => 'Sulawesiani', 'email' => 'sulawesiani@gmail.com', 'address' => 'Makasar', 'gender' => 'Perempuan'),
    //     array('id' => 5, 'name' => 'Papuani', 'email' => 'papuani@gmail.com', 'address' => 'Jayapura', 'gender' => 'Perempuan'),
    // );


    // code ini untuk mengambil semua data users dari table users.
    // lihat file model/UserModel.php function getAll()
    $users = $userModel->getAll(); 


    // membuat response json
    echo json_encode($users);
}

if($url == '/users' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // code ini untuk insert  data ke table users.
    // lihat file model/UserModel.php function add()
    $userId = $userModel->add($_POST);


    // code ini untuk mengambil  data user berdasrkan ID (yang baru saja si insert) dari table users.
    // lihat file model/UserModel.php function getById()
    $user = $userModel->getById($userId);


    // membuat response json
    echo json_encode($user);
}

if(preg_match("/users\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
    parse_str(file_get_contents("php://input"),$input);

    $userId = $matches[1];

    // $user = array(
    //     'id' => $userId,
    //     'name' => $input['name'],
    //     'email' => $input['email'],
    //     'address' => $input['address'],
    //     'gender' => $input['gender']
    // );


    // code ini untuk update data ke table users berdasarkan paframeter ID.
    // lihat file model/UserModel.php function update()
    $userModel->update($userId, $input);


    // code ini untuk mengambil  data user berdasrkan ID (yang baru saja di update) dari table users.
    // lihat file model/UserModel.php function getById()
    $user = $userModel->getById($userId);
    

    // membuat response json
    echo json_encode($user);
}

if(preg_match("/users\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    // $users = array(
    //     '1' => array('id' => 1, 'name' => 'Sumatrana', 'email' => 'sumatrana@gmail.com', 'address' => 'Padang', 'gender' => 'Laki-laki'),
    //     '2' => array('id' => 2, 'name' => 'Jawarianto', 'email' => 'jawarianto@gmail.com', 'address' => 'Cimahi', 'gender' => 'Laki-laki'),
    //     '3' => array('id' => 3, 'name' => 'Kalimantanio', 'email' => 'kalimantanio@gmail.com', 'address' => 'Samarinda', 'gender' => 'Laki-laki'),
    //     '4' => array('id' => 4, 'name' => 'Sulawesiani', 'email' => 'sulawesiani@gmail.com', 'address' => 'Makasar', 'gender' => 'Perempuan'),
    //     '5' => array('id' => 5, 'name' => 'Papuani', 'email' => 'papuani@gmail.com', 'address' => 'Jayapura', 'gender' => 'Perempuan'),
    // );
    // $user = $users[$matches[1]];


    // code ini untuk mengambil  data user berdasrkan ID (yang dikirim lewat parameter) dari table users.
    // lihat file model/UserModel.php function getById()
    $user = $userModel->getById($matches[1]);


    // membuat response json
    echo json_encode($user);
}

if(preg_match("/users\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $userId = $matches[1];


    // code ini untuk menghapus  data user berdasrkan ID (yang dikirim lewat parameter) dari table users.
    // lihat file model/UserModel.php function delete()    
    $userModel->delete($userId);


    // membuat response json
    echo json_encode([
        'id'=> $userId,
        'deleted'=> 'true'
    ]);
}
?>