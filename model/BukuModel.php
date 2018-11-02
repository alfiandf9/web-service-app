<?php

class BukuModel {
    /**
     * Get all
     *
     * @return mixed
     */
    function getAll() {
        //membuat instance dari class DB
        $dbInstance = new DB(); 

        //membuat koneksi ke databse
        $dbConn = $dbInstance->connect(); 

        //menyiapkan query
        $statement = $dbConn->prepare("SELECT * FROM buku");

        //menjalankan query
        $statement->execute();

        //set fetch mode
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        //mengubah object mysql menjadi object php
        return $statement->fetchAll();
    }


    /**
     * Get user based on ID
     *
     * @param $id
     *
     * @return Associative Array
     */
    function getById($id) {
        //membuat instance dari class DB
        $dbInstance = new DB(); 

        //membuat koneksi ke databse
        $dbConn = $dbInstance->connect(); 

        //menyiapkan query
        $statement = $dbConn->prepare("SELECT * FROM buku where id={$id}");

        //menjalankan query
        $statement->execute();

        //mengubah object mysql menjadi object php
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Add
     *
     * @param $input
     * @return integer
     */
    function add($input){
        //membuat instance dari class DB
        $dbInstance = new DB(); 

        //membuat koneksi ke databse
        $dbConn = $dbInstance->connect(); 

        //menyiapkan query
        $sql = "INSERT INTO buku 
              ( judul, pengarang, penerbit, tahun_terbit) 
              VALUES 
              ('{$input['judul']}', '{$input['pengarang']}', '{$input['penerbit']}', '{$input['tahun_terbit']}')";
        $statement = $dbConn->prepare($sql);

        //menjalankan query
        $statement->execute();

        //get last inserted ID
        return $dbConn->lastInsertId();
    }

    /**
     * Update User
     *
     * @param $id
     * @param $input
     */
    function update($id, $input){
        //membuat instance dari class DB
        $dbInstance = new DB(); 

        //membuat koneksi ke databse
        $dbConn = $dbInstance->connect(); 

        //menyiapkan query
        $sql = "
              UPDATE buku 
              SET judul='{$input['judul']}', pengarang='{$input['pengarang']}', penerbit='{$input['penerbit']}', tahun_terbit='{$input['tahun_terbit']}'
              WHERE id='$id'
               ";
        $statement = $dbConn->prepare($sql);

        //menjalankan query
        $statement->execute();

        
        return $id;

    }

    /**
     * Delete User record based on ID
     *
     * @param $id
     */
    function delete($id) {
        //membuat instance dari class DB
        $dbInstance = new DB(); 

        //membuat koneksi ke databse
        $dbConn = $dbInstance->connect(); 

        //menyiapkan query
        $statement = $dbConn->prepare("DELETE FROM buku where id={$id}");

        //menjalankan query
        $statement->execute();
    }


}