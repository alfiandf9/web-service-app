# Connect databse
1. Aplikasi ini adalah lanjutan dari aplikasi pada pertemuan sebelumnya.
2. Aplikasi ini bertujuan untuk melakukan koneksi ke database. Kalau pada pertemuan sebelumnya kita membuat aplikasi REST API tanpa connect ke database, maka pada pertemuan ini kita akan menambahkan fitur supaya bisa connect ke database.


## Database Setting
Ubah databse setting pada file /config/config.php, silahkan sesuaikan dengan settingan pada aplikasi masing masing
Contoh:
$db = [
    'host' => '127.0.0.1',
    'port' => 3306,
    'username' => 'root',
    'password' => 'root',
    'database' => 'web-service-app'
];

## Create database
Silahkan create database dengan nama 'web-service-app'. SQL command nya seperti dibawah ini.
CREATE DATABASE `web-service-app`;


## Create tables users
SIlahkan create table 'users' di dalam database 'web-service-app'. SQL command nya seperti dibawah ini.
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NULL,
  `name` varchar(255) NULL,
  `gender` varchar(20) NULL,
  `address` text NOT NULL
);


## Running App
1. Method #1
In terminal/command prompt
cd to {...}/web-service-app/controller/
php -S localhost:8000
In browser open localhost:8000/users

2. Method #2
If you use XAMPP locate you project folder to htdocs
In browser open {...}/web-service-app/controller/index.php/users
