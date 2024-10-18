<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE . ' - Página no encontrada'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #1d3557;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
        }

        .error-container h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #f1faee;
        }

        .error-container p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .error-container .btn {
            margin: 10px;
            padding: 10px 20px;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary {
            background-color: #457b9d;
            border-color: #457b9d;
            color: #fff;
        }

        .btn-secondary {
            background-color: #e63946;
            border-color: #e63946;
            color: #fff;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #fff;
            color: #457b9d;
        }

        .space-illustration {
            max-width: 400px;
            margin: 20px auto;
        }

        .space-illustration img {
            width: 100%;
        }

    </style>
</head>

<body>
    <div class="error-container">
        <h1>¡Ooops!</h1>
        <p>Te hemos perdido! No sabemos qué ha podido pasar...<br>¿Pero dónde te has metido? Vuelve con nosotros.</p>
        <div class="space-illustration">
            <img src="<?php echo BASE_URL; ?>assets/images/space_illustration.png" alt="Ilustración espacial">
        </div>
        <div>
            <a href="<?php echo BASE_URL; ?>" class="btn btn-primary">Volver a casa</a>
            <a href="#" class="btn btn-secondary">Hablamos</a>
        </div>
    </div>
</body>

</html>
