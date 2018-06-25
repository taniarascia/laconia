<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $this->page_title  . ' &mdash; ' . SITE_NAME; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700|Quattrocento:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= $this->getStylesheet('main'); ?>">

</head>

<body>

<?php include __DIR__ . '/navigation.php'; ?>