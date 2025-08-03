<?php
$isSearch = false;
$searchResults = [];

if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
    $isSearch = true;

    require_once __DIR__ . '/../models/tutoriasModel.php';
    $keyword = $_GET['keyword'];
    $searchResults = buscarTutorias($keyword);
}

// Cargar la vista
require_once __DIR__ . '/../views/tutorias.php';
