<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $this->pageTitle ? $this->pageTitle  . ' &ndash; ' . SITE_NAME : SITE_NAME  . ' &mdash; MVC Framework'; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat+Alternates:800|Mandali" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" rel="stylesheet">
    <link href="<?= $this->getStylesheet('main'); ?>" rel="stylesheet">

</head>

<body>

    <section class="layout">

        <?php include __DIR__ . '/navigation.php'; ?>

        <main>