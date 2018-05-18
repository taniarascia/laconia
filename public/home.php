<?php

//home.php

/**
 * Start the session.
 */
session_start();

/**
 * Include our MySQL connection.
 */
require $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

/**
 * Check if the user is logged in.
 */
if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

/**
 * Print out something that only logged in users can see.
 */

echo 'Congratulations! You are logged in!';

$sql = "SELECT * FROM users";
$stmt = $pdo->prepare($sql);

//Execute.
$stmt->execute();

//Fetch the row.
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>
<?php foreach ($rows as $row) : ?>
    <tr>
        <td><?= $row['username']; ?></td>
        <td><?= $row['email']; ?></td>
    </tr>
<?php endforeach; ?>
</table>