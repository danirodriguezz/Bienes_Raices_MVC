<?php

function conectarDB() : mysqli {
    $db = new mysqli("localhost", "root", "", "Bienes_Raices");
    
    if (!$db) {
        echo "Error no se pudo concectar";
        exit;
    }

    return $db;
};