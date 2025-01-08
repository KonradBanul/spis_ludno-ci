<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\home.css">
    <link href="assets\bootstrap-5.3.3-dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="assets\fontawesome-free-6.7.2-web\css\fontawesome.css" rel="stylesheet" />
    <link href="assets\fontawesome-free-6.7.2-web\css\brands.css" rel="stylesheet" />
    <link href="assets\fontawesome-free-6.7.2-web\css\solid.css" rel="stylesheet" />
    <script src="assets\bootstrap-5.3.3-dist\js\bootstrap.min.js"></script>
    <script src="assets\jquery-3.7.1.min.js"></script>
    <title>Spis ludności</title>
</head>
<body onload="clock()">
    <div id="head">
        <a href="index.php">Strona główna</a>
        <a href="index.php?page=omnie">O mnie</a>
        <a href="index.php?page=jeremi">O Jeremim</a>
        <button id="colorbtn" type="button" onclick="changeColor()">Zmień kolor tła</button>
        <button id="wlacz" type="button" onclick="toggle()">Włącz śnieg</button>
    </div> 
    <div class="toast-container top-0 end-0 p-3">
        <div id="mainToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" value="top-0 end-0">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <h1>Spis ludności</h1>
    <div class="container">
    
    
        