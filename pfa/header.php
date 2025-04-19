<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Hand Care</title>
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
        
        .status-container {
            max-width: 500px;
            padding: 40px;
            animation: fadeIn 0.8s ease-out;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            backdrop-filter: blur(5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .status-icon {
            font-size: 80px;
            margin-bottom: 25px;
            animation: statusAnimation 1s ease;
        }
        
        h1 {
            font-size: 2rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: white;
            color: #3a7bd5;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin: 0 10px;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .redirect-message {
            font-size: 0.9rem;
            margin-top: 20px;
            opacity: 0.8;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes statusAnimation {
            0% { transform: scale(0.5); opacity: 0; }
            70% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-10px); }
            40%, 80% { transform: translateX(10px); }
        }
        
        .error {
            color: #ff6b6b;
        }
        
        .error-bg {
            background: linear-gradient(135deg, #ff6b6b, #3a7bd5);
        }
    </style>
</head>
<body>