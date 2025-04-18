<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="register-form">
            <h2>Inscription</h2>
            
            <?php if (isset($_SESSION['register_errors']) && !empty($_SESSION['register_errors'])): ?>
                <div class="alert alert-danger">
                    <?php 
                    foreach ($_SESSION['register_errors'] as $error) {
                        echo "<p>" . $error . "</p>";
                    }
                    unset($_SESSION['register_errors']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                </div>
            <?php endif; ?>

            <form action="/public/index.php?action=register" method="POST">
                <div class="form-group">
                    <label for="register_email">Email</label>
                    <input type="email" id="register_email" name="register_email" 
                           value="<?php echo isset($_SESSION['register_email']) ? htmlspecialchars($_SESSION['register_email']) : ''; ?>" 
                           required>
                </div>
                <div class="form-group">
                    <label for="register_password">Mot de passe</label>
                    <input type="password" id="register_password" name="register_password" required>
                </div>
                <div class="form-group">
                    <label for="register_confirm_password">Confirmer le mot de passe</label>
                    <input type="password" id="register_confirm_password" name="register_confirm_password" required>
                </div>
                <button type="submit" name="register_submit" class="btn btn-primary">S'inscrire</button>
            </form>

            <div class="login-link">
                <p>Déjà un compte? <a href="/public/index.php">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html> 