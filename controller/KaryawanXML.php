<?php
// load file /model/karyawanModel.php
require __DIR__.'/../model/KaryawanModel.php';

// membuat object/instance dari class karyawanModel.php
$karyawanModel = new KaryawanModel();

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

if($url == '/employeeXML' && $_SERVER['REQUEST_METHOD'] == 'GET') {

    // code ini untuk mengambil semua data karyawan dari table karyawan.
    // lihat file model/karyawanModel.php function getAll()
    $dataKaryawan = $karyawanModel->getAll(); 

    $document = new SimpleXMLElement("<employees />");

    foreach ($dataKaryawan as $row) {
        $karyawan = $document->addChild("employee");
        // add child
        $karyawan->addChild("id", $row['id']);
        $karyawan->addChild("email", $row['email']);
        $karyawan->addChild("name", $row['name']);
        $karyawan->addChild("gender", $row['gender']);
        $karyawan->addChild("address", $row['address']);
    }

    echo $document->asXML();

    // membuat response json
    // echo json_encode($karyawan);
}

if($url == '/employeeXML' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // code ini untuk insert  data ke table karyawan.
    // lihat file model/karyawanModel.php function add()
    $karyawanId = $karyawanModel->add($_POST);


    // code ini untuk mengambil  data karyawan berdasrkan ID (yang baru saja si insert) dari table karyawan.
    // lihat file model/karyawanModel.php function getById()
    $karyawan = $karyawanModel->getById($karyawanId);


    // membuat response json
    echo json_encode($karyawan);
}

if(preg_match("/employeeXML\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
    parse_str(file_get_contents("php://input"),$input);

    $karyawanId = $matches[1];

    // code ini untuk update data ke table karyawan berdasarkan paframeter ID.
    // lihat file model/karyawanModel.php function update()
    $karyawanModel->update($karyawanId, $input);


    // code ini untuk mengambil  data karyawan berdasrkan ID (yang baru saja di update) dari table karyawan.
    // lihat file model/karyawanModel.php function getById()
    $karyawan = $karyawanModel->getById($karyawanId);
    

    // membuat response json
    echo json_encode($karyawan);
}

if(preg_match("/employeeXML\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){


    // code ini untuk mengambil  data karyawan berdasrkan ID (yang dikirim lewat parameter) dari table karyawan.
    // lihat file model/karyawanModel.php function getById()
    $karyawan = $karyawanModel->getById($matches[1]);


    // membuat response json
    echo json_encode($karyawan);
}

if(preg_match("/employeeXML\/([0-9])+/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $karyawanId = $matches[1];


    // code ini untuk menghapus  data karyawan berdasrkan ID (yang dikirim lewat parameter) dari table karyawan.
    // lihat file model/karyawanModel.php function delete()    
    $karyawanModel->delete($karyawanId);


    // membuat response json
    echo json_encode([
        'id'=> $karyawanId,
        'deleted'=> 'true'
    ]);
}
?>