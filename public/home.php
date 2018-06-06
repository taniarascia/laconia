<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/class.database.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: /login');
    exit;
}

$database->query("SELECT * FROM users WHERE id = :id LIMIT 1");
$database->bind(':id', $_SESSION['user_id']);

$row = $database->result();  

?>

<h1><?= $row['username']; ?></h1>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>

    <tr>
        <td><?= $row['username']; ?></td>
        <td><?= $row['email']; ?></td>
    </tr>

</table>

<a href="/logout">Logout</a>