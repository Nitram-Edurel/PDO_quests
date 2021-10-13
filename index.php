<?php
require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);


$query = "SELECT * FROM The_Friends";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $friend = array_map('trim', $_POST);

    if(strlen($friends['firstname']) > $maxTitleLength) {
        $errors[] = 'Le first name doit faire moins de ' . $maxTitleLength;
    }
    $maxTitleLength = 45;
    if(strlen($friends['lastname'])) {
        $errors[] = 'Le last name doit faire moins de' . $maxTitleLength;
    }
    if(empty($errors)) {
     $query = "INSERT INTO friend(firstname, lastname) VALUES ('$firstname', '$lastname')";
     header('Location: index.php');
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Friends</title>
</head>

<body>

    <h2>List of the Friends</h2>
    
    <ul>
        <?php foreach ($friends as $friend) : ?>
            <li>
                <?= $friend['firstname'] . " " . $friend['lastname'] ?>
            </li>
        <?php endforeach ?>
    </ul>
    <h2>Formulaire</h2>
    <form method="POST">
        <label for="firstname">First name</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">Last name</label>
        <input type="text" name="lastname" id="lastname" required>

        <input type="submit" value="Envoyez">

    </form>

</body>

</html>
