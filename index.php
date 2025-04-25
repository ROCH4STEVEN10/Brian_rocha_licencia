<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tienda de Procesadores</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: white;
      padding: 2rem 3rem;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h1 {
      margin-bottom: 2rem;
      color: #333;
    }

    .btn {
      display: block;
      width: 200px;
      padding: 1rem;
      margin: 1rem auto;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-login {
      background-color: #007bff;
      color: white;
    }

    .btn-login:hover {
      background-color: #0056b3;
    }

    .btn-register {
      background-color: #28a745;
      color: white;
    }

    .btn-register:hover {
      background-color: #1e7e34;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Tienda de Procesadores</h1>
    <button class="btn btn-login" onclick="location.href='login.php'">Iniciar Sesión</button>
    <!-- <button class="btn btn-register" onclick="location.href='register.php'">Registrarse</button> -->
  </div>
</body>
</html>
