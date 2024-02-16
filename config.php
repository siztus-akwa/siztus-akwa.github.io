<?php
    function pdo_connect_mysql(){
            return new PDO('mysql:host=localhost;dbname=scheduler','root','');
    }
?>