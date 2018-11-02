<?php
// load file /model/UserModel.php
require __DIR__.'/../model/BukuModel.php';

// membuat object/instance dari class BukuModel.php
$bukuModel = new BukuModel();

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

if($url == '/buku' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    
    // code ini untuk mengambil semua data buku dari table buku.
    // lihat file model/BukuModel.php function getAll()
    $buku = $bukuModel->getAll(); 


    // membuat response json
    echo json_encode($buku);
}

if($url == '/buku' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // code ini untuk insert  data ke table buku.
    // lihat file model/BukuModel.php function add()
    $bukuId = $bukuModel->add($_POST);


    // code ini untuk mengambil  data buku berdasrkan ID (yang baru saja si insert) dari table buku.
    // lihat file model/BukuModel.php function getById()
    $buku = $bukuModel->getById($bukuId);


    // membuat response json
    echo json_encode($buku);
}

if(preg_match("/buku\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
    parse_str(file_get_contents("php://input"),$input);

    $bukuId = $matches[1];


    // code ini untuk update data ke table buku berdasarkan paframeter ID.
    // lihat file model/BukuModel.php function update()
    $bukuModel->update($bukuId, $input);


    // code ini untuk mengambil  data buku berdasrkan ID (yang baru saja di update) dari table buku.
    // lihat file model/bukuModel.php function getById()
    $buku = $bukuModel->getById($bukuId);
    

    // membuat response json
    echo json_encode($buku);
}

if(preg_match("/buku\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){

    // code ini untuk mengambil  data buku berdasrkan ID (yang dikirim lewat parameter) dari table buku.
    // lihat file model/UserModel.php function getById()
    $buku = $bukuModel->getById($matches[1]);


    // membuat response json
    echo json_encode($buku);
}

if(preg_match("/buku\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $bukuId = $matches[1];


    // code ini untuk menghapus  data buku berdasrkan ID (yang dikirim lewat parameter) dari table buku.
    // lihat file model/BukuModel.php function delete()    
    $bukuModel->delete($bukuId);


    // membuat response json
    echo json_encode([
        'id'=> $bukuId,
        'deleted'=> 'true'
    ]);
}
?>