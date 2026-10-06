<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- agrega el bootstrap css -->
    <link rel="stylesheet" href="/assets/Bootstrap/css/bootstrap.min.css">
    <!-- agrega el bootstrap icons -->
    <link rel="stylesheet" href="/assets/Bootstrap-Icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/DataTables/datatables.min.css">
    <style>
        .crud-table th,
        .crud-table td {
            vertical-align: middle;
            white-space: nowrap;
        }
        .crud-table td.col-email {
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .mi-fondo-basquet {
            background-image: url('/template/img/basquet.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .sidebar-toggle {
            position: fixed;
            top: 76px;
            left: 264px;
            z-index: 1030;
            transition: left .2s ease;
        }
        .sidebar-toggle.is-collapsed {
            left: 12px;
        }
        #appSidebar {
            transition: width .2s ease, padding .2s ease, opacity .2s ease;
            overflow: hidden;
        }
        #appSidebar.is-collapsed {
            width: 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            opacity: 0;
            border-right: 0 !important;
        }
    </style>
</head>