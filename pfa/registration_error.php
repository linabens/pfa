<?php 
$page_title = "Email Existe Déjà";
include 'header.php'; 
?>

<div class="status-container error-bg">
    <div class="status-icon error">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <h1>Email Déjà Utilisé</h1>
    <p>L'adresse email que vous avez entrée est déjà associée à un compte existant.</p>
    <a href="index.html" class="btn">Réessayer</a>
    <a href="index.html" class="btn">Se Connecter</a>
    <div class="redirect-message">Redirection automatique dans <span id="countdown">5</span> secondes...</div>
</div>

<script>
    // Countdown for redirect
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