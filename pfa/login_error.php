<?php 
$page_title = "Erreur de Connexion";
include 'header.php'; 
?>

<div class="status-container error-bg">
    <div class="status-icon error" style="animation: statusAnimation 1s ease, shake 0.8s ease;">
        <i class="fas fa-user-times"></i>
    </div>
    <h1>Identifiants Incorrects</h1>
    <p>Le mot de passe ou l'email que vous avez entré est incorrect.</p>
    <a href="index.html" class="btn">Réessayer</a>
    <a href="index.html" class="btn">Mot de passe oublié?</a>
    <div class="redirect-message">Redirection automatique dans <span id="countdown">5</span> secondes...</div>
</div>

<script>
    let seconds = 5;
    const countdown = setInterval(() => {
        seconds--;
        document.getElementById('countdown').textContent = seconds;
        if(seconds <= 0) {
            clearInterval(countdown);
            window.location.href = 'index.html';
        }
    }, 1000);
</script>

<?php include 'footer.php'; ?>