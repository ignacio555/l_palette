<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <form method="POST" action="{{ route('cargar') }}">
        @csrf

        <label for="email">Email:</label>
        <input type="text" name="user" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Iniciar sesión</button>
    </form>

</body>
</html>