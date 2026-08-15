<?php
// Inicializar variables de error y estado
$error = '';
$email = '';

// Procesar el formulario cuando se envía mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y obtener los datos
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Validaciones básicas
    if (empty($email) || empty($password)) {
        $error = 'Por favor, completa todos los campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Por favor, ingresa un correo electrónico válido.';
    } else {
        // AQUÍ VA TU LÓGICA DE AUTENTICACIÓN (Consulta a BD)
        // Ejemplo de validación ficticia:
        if ($email === 'usuario@ejemplo.com' && $password === '12345678') {
            // Iniciar sesión y redireccionar
            session_start();
            $_SESSION['usuario'] = $email;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Credenciales incorrectas. Inténtalo de nuevo.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - SmartClean</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center min-vh-100">

    <div class="container py-5" style="max-width: 540px;">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="card-title mb-4 text-center fw-bold">Bienvenido a SmartClean</h2>
                <p class="text-muted text-center mb-4">Ingresa tus datos para iniciar sesión o registrarte.</p>

                <!-- Mostrar alerta si existen errores -->
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form action="{{ route('login') }}" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                        <input id="email" name="email" class="form-control" type="email"
                            placeholder="usuario@ejemplo.com" value="<?php echo htmlspecialchars($email); ?>"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <input id="password" name="password" class="form-control" type="password" placeholder="********"
                            required />
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Iniciar sesión</button>
                </form>

                <div class="text-center mt-4 pt-2 border-top">
                    <p class="mb-2 text-muted">¿Aún no tienes cuenta?</p>
                    <a href="registro.php" class="btn btn-outline-secondary px-4">Registrarse</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>