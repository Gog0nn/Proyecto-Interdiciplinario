<?php include_once __DIR__ . "/../../db/lib/app.php"; ?>
<?php
// Cada página puede cambiarla antes de incluir este archivo
$clase_main = $clase_main ?? 'px-3 px-md-5 py-4';
?>
<?php include(__DIR__ . "/head.php"); ?>
<body class="d-flex flex-column vh-100 overflow-hidden">
    <?php include(__DIR__ . "/header.php"); ?>
    
    <div class="container-fluid p-0 flex-grow-1 overflow-hidden">
        <div class="row g-0 flex-nowrap h-100">
            <main class="col bg-white overflow-auto h-100 <?= $clase_main ?>">