<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie - Hand Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }
        
        .success-container {
            max-width: 500px;
            padding: 40px;
            animation: fadeIn 0.8s ease-out;
        }
        
        .check-icon {
            font-size: 80px;
            margin-bottom: 25px;
            animation: bounceCheck 1s ease infinite alternate;
            color: #ffffff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .redirect-message {
            font-size: 0.9rem;
            margin-top: 20px;
            opacity: 0.8;
        }
        
        @keyframes bounceCheck {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="check-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Inscription réussie !</h1>
        <p>Votre compte a été créé avec succès.</p>
        <div class="redirect-message">Redirection vers l'accueil dans <span id="countdown">5</span> secondes...</div>
    </div>

    <script>
        // Countdown and redirect
        let seconds = 5;
        const countdownElement = document.getElementById('countdown');
        
        const countdown = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if(seconds <= 0) {
                clearInterval(countdown);
                window.location.href = 'index.html';
            }
        }, 1000);
    </script>
</body>
</html>