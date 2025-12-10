<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #f5f6fa;
    }

    .sidebar {
        height: 100vh;
        background: #343a40;
        color: white;
        padding-top: 30px;
        position: fixed;
        width: 250px;
    }

    .sidebar a {
        color: white;
        padding: 12px 20px;
        display: block;
        text-decoration: none;
        font-size: 16px;
    }

    .sidebar a:hover {
        background: #495057;
    }

    .content {
        margin-left: 260px;
        padding: 20px;
    }

    .section {
        display: none;
    }

    .active-section {
        display: block;
    }
    </style>
</head>

<body>