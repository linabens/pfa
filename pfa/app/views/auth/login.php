<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Connexion</h2>
            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['register_success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['register_success']; unset($_SESSION['register_success']); ?>
                </div>
            <?php endif; ?>

            <form action="/public/index.php?action=login" method="POST">
                <div class="form-group">
                    <label for="login_email">Email</label>
                    <input type="email" id="login_email" name="login_email" required>
                </div>
                <div class="form-group">
                    <label for="login_password">Mot de passe</label>
                    <input type="password" id="login_password" name="login_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <div class="register-link">
                <p>Pas encore de compte? <a href="/public/index.php?action=register">S'inscrire</a></p>
            </div>
        </div>
    </div>
</body>
</html> 