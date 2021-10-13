<?php
require_once '_connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$firstname = trim($_POST['firstname']);
var_dump($firstname);
$lastname = trim($_POST['lastname']);
var_dump($lastname);
$query = "INSERT INTO The_Friends (firstname, lastname) VALUES ('$firstname', '$lastname')";
$pdo->exec($query);

$query = "SELECT * FROM The_Friends";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

function savefriend(array $friend): void
{
    $connection = createConnection();
    $query = "INSERT INTO recipe (id, title, description) VALUES (:id, :title, :description)";
    $statement = $connection->prepare($query);
    $statement ->bindValue('id', $friend['id']);
    $statement ->bindValue('title', $friend['title']);
    $statement ->bindValue('description', $friend['description']);
    $statement ->execute();
    
}
function createConnection(): PDO
{
    return new PDO(DSN, USER, PASS);
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