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
    <div class="container">
        <h1>WAR NUMBER</h1>
        <form action="game.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" value="hamza" required>
            </div>
            <div class="form-group">
                <label>Difficulté:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="difficulty" id="easy" value="easy" checked >
                    <label class="form-check-label" for="easy">Facile (20 tentatives)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="difficulty" id="medium" value="medium"  >
                    <label class="form-check-label" for="medium">Moyen (10 tentatives)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="difficulty" id="hard" value="hard"  >
                    <label class="form-check-label" for="hard">Difficile (5 tentatives)</label>
                </div>
            <button type="submit" class="btn btn-primary">Commencer le jeu</button>           
         </div>

        </form>
    </div>
</body>
</html>
