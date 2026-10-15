
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar | RoseLab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ciruela: #79536f;
            --ciruela-oscuro: #56394f;
            --fondo: #f5f3f4;
            --texto: #29262c;
            --gris: #77717a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--fondo);
            color: var(--texto);
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-container {
            width: 100%;
            max-width: 950px;
            min-height: 570px;
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 65px rgba(49, 35, 46, 0.12);
        }

        .brand-panel {
            background: linear-gradient(145deg, #302831, #68485f 65%, #79536f);
            color: white;
            padding: 48px 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .brand-panel::before,
        .brand-panel::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 50%;
            width: 280px;
            height: 280px;
            right: -120px;
            bottom: 50px;
        }

        .brand-panel::after {
            width: 200px;
            height: 200px;
            right: -80px;
            bottom: 90px;
        }

        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .brand-logo span {
            color: #e7c7df;
        }

        .brand-tag {
            color: #e3d9e1;
            font-size: 12px;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 8px;
        }

        .brand-title {
            font-size: 35px;
            line-height: 1.2;
            font-weight: 700;
            margin-top: 100px;
        }

        .brand-description {
            color: #e5dce4;
            line-height: 1.8;
            margin-top: 20px;
            max-width: 300px;
        }

        .brand-footer {
            color: #d9cbd7;
            font-size: 12px;
        }

        .form-panel {
            padding: 65px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-panel h1 {
            font-size: 29px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--gris);
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 22px;
        }

        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gris);
            z-index: 2;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 15px 14px 44px;
            border: 1px solid #e6e0e5;
            border-radius: 10px;
            outline: none;
            background: #fff;
            transition: .2s;
        }

        .input-group-custom input:focus {
            border-color: var(--ciruela);
            box-shadow: 0 0 0 3px rgba(121, 83, 111, .12);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: var(--ciruela);
            color: white;
            font-weight: 600;
            margin-top: 8px;
            transition: .2s;
        }

        .btn-login:hover {
            background: var(--ciruela-oscuro);
            color: white;
            transform: translateY(-1px);
        }

        .security-note {
            margin-top: 28px;
            text-align: center;
            font-size: 12px;
            color: var(--gris);
        }

        .security-note i {
            margin-right: 5px;
            color: var(--ciruela);
        }

        .error-message {
            color: #b42318;
            font-size: 13px;
            margin-top: 6px;
        }

        @media (max-width: 700px) {
            body {
                padding: 15px;
            }

            .login-container {
                grid-template-columns: 1fr;
            }

            .brand-panel {
                padding: 28px;
                min-height: 230px;
            }

            .brand-title {
                font-size: 26px;
                margin-top: 35px;
            }

            .brand-description,
            .brand-footer {
                display: none;
            }

            .form-panel {
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>

    <main class="login-container">

        <section class="brand-panel">
            <div class="brand-content">
                <div class="brand-logo">
                    Rose<span>Lab</span>
                </div>

                <div class="brand-tag">
                    Gestión de equipos
                </div>

                <h2 class="brand-title">
                    Todo bajo control.<br>
                    En un solo lugar.
                </h2>

                <p class="brand-description">
                    Administra equipos, organiza préstamos y lleva un control
                    claro de cada devolución.
                </p>
            </div>

            <div class="brand-footer">
                RoseLab · Sistema de gestión de equipos
            </div>
        </section>

        <section class="form-panel">
            <h1>Bienvenido de nuevo</h1>

            <p class="subtitle">
                Ingresa tus datos para acceder a tu cuenta.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="mb-1">
                    <label for="email" class="form-label">
                        Correo electrónico
                    </label>

                    <div class="input-group-custom">
                        <i class="bi bi-envelope"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="ejemplo@correo.com"
                            value="{{ old('email') }}"
                            autocomplete="username"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">
                        Contraseña
                    </label>

                    <div class="input-group-custom">
                        <i class="bi bi-lock"></i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ingresa tu contraseña"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    Iniciar sesión
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>
            </form>

            <div class="security-note">
                <i class="bi bi-shield-lock"></i>
                Acceso protegido para usuarios autorizados.
            </div>
        </section>

    </main>

</body>
</html>
