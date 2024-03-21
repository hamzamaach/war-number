<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["difficulty"])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION["number"])) {
    $digits = range(0, 9);
    shuffle($digits);
    $number = '';
    for ($i = 0; $i < 4; $i++) {
        $number .= $digits[$i];
    }
    $_SESSION["number"] = $number;
} else {
    $number =  $_SESSION["number"];
}
if (isset($_POST["username"]) && isset($_POST["difficulty"]) && !isset($_SESSION["attempts"])) {
    $difficulty = $_POST["difficulty"];
    if ($difficulty == "easy") {
        $tentatives = 20;
    } else if ($difficulty == "medium") {
        $tentatives = 10;
    } else {
        $tentatives = 5;
    }
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["difficulty"] = $difficulty;
    $_SESSION["tentatives"] = $tentatives;
    $attempts = [];
} else {
    $attempts = isset($_SESSION["attempts"]) ? $_SESSION["attempts"] : [];
}
$lastGuess = "";
if (isset($_POST["guess"]) && $_SESSION["tentatives"] > 0) {
    $guess = $_POST["guess"];
    $_SESSION["tentatives"] -= 1;
    $morts = 0;
    $blesses = 0;
    for ($i = 0; $i < strlen($guess); $i++) {
        $char = $guess[$i];
        if ($char === $number[$i]) {
            $morts++;
        } else {
            if (strpos($number, $char) !== false) {
                $blesses++;
            }
        }
    }
    $attempts[] = [
        'guess' => $guess,
        'morts' => $morts,
        'blesses' => $blesses
    ];
    $_SESSION["attempts"] = $attempts;
    $lastGuess = $guess;
    if ($_SESSION["tentatives"] == 0) {
        $_SESSION["endGame"] = true;
    } else if ($morts == 4) {
        $_SESSION["endGame"] = true;
        $_SESSION["win"] = true;
    }
}
if (!isset($_SESSION["endGame"])) {
    $_SESSION["endGame"] = false;
}
if (!isset($_SESSION["win"])) {
    $_SESSION["win"] = false;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>WAR NUMBER - Jeu en cours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>WAR NUMBER</h1>
        <h2>Bonjour, <?php echo $_SESSION["username"]; ?>!</h2>
        <p>Tentatives restantes: <?php echo $_SESSION["tentatives"]; ?></p>
        <form action="game.php" method="post">
            <div class="form-group">
                <label for="guess">Entrez votre devinette:</label>
                <input type="text" class="form-control" id="guess" name="guess" autofocus pattern="[0-9]{4}" value="<?php echo $lastGuess; ?>" required <?php if ($_SESSION["endGame"]) echo 'disabled'; ?>>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" <?php if ($_SESSION["endGame"]) echo 'disabled'; ?>>Essayer</button>
            </div>
        </form>
        <?php if ($_SESSION["endGame"]) : ?>
            <?php if ($_SESSION["win"]) : ?>
                <div class="alert alert-success">
                    Félicitations! Vous avez trouvé le nombre!
                </div>
            <?php else : ?>
                <div class="alert alert-danger">
                    Dommage! Vous avez perdu. Le nombre était <?= $number ?>.
                </div>
            <?php endif; ?>
            <a href="index.php" class="btn btn-primary d-block mx-auto">Rejouer</a>
        <?php endif; ?>

        <?php if (isset($_SESSION["attempts"])) : ?>
            <h2>Historique des tentatives</h2>
            <ul>
                <?php foreach ($_SESSION["attempts"] as $attempt) : ?>
                    <li><?php echo $attempt['guess']; ?> - <?php echo $attempt['morts']; ?> morts, <?php echo $attempt['blesses']; ?> blessés</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>