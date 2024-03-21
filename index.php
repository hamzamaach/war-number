<?php
session_start();

if (isset($_SESSION['attempts'])) {
    unset($_SESSION['attempts']);
}
if (isset($_SESSION['number'])) {
    unset($_SESSION['number']);
}
if (isset($_SESSION['endGame'])) {
    unset($_SESSION['endGame']);
}
if (isset($_SESSION['win'])) {
    unset($_SESSION['win']);
}

$difficulty = isset($_SESSION["difficulty"]) ? $_SESSION["difficulty"] : "easy";


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>WAR NUMBER</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center">
        <h1>WAR NUMBER</h1>
        <form action="game.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label>Difficulté:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="difficulty" id="easy" value="easy" <?php echo ($difficulty == 'easy') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="easy">Facile (20 tentatives)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="difficulty" id="medium" value="medium" <?php echo ($difficulty == 'medium') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="medium">Moyen (10 tentatives)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="difficulty" id="hard" value="hard" <?php echo ($difficulty == 'hard') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="hard">Difficile (5 tentatives)</label>
                </div>
                <button type="submit" class="btn btn-primary">Commencer le jeu</button>
            </div>

        </form>
    </div>
</body>

</html>