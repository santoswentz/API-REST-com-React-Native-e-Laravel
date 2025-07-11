<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Rick and Morty Characters</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0b0c10;
            color: #C5C6C7;
            font-family: 'Orbitron', sans-serif;
        }

        h1 {
            color: #00ff91; /* verde portal */
            text-shadow: 1px 1px 5px #00ff91;
        }

        .card {
            background-color: #1f2833;
            color: #fff;
            border: 2px solid #45A29E;
            box-shadow: 0 0 10px #45A29E;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 15px #66FCF1;
        }

        .card-title {
            color: #66FCF1;
        }

        .status-alive {
            color: #00ff91;
        }

        .status-dead {
            color: #ff4f4f;
        }

        .status-unknown {
            color: #c5c6c7;
        }

        .navbar {
            background-color: #1f2833;
            border-bottom: 3px solid #66FCF1;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #45A29E;
        }
        #loading-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #0b0c10;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        #loading-spinner.fade-out {
            opacity: 0;
            pointer-events: none;
        }

}

    </style>
</head>
<body>
        <!-- Spinner de carregamento -->
    <div id="loading-spinner" class="d-flex justify-content-center align-items-center vh-100 bg-dark">
        <div class="text-center">
            <div class="spinner-border text-success" role="status" style="width: 4rem; height: 4rem;">
                <span class="visually-hidden">Carregando...</span>
            </div>
            <p class="mt-3 text-light">Carregando personagens...</p>
        </div>
    </div>
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">🌌 Rick and Morty Explorer</span>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-4">Personagens</h1>

        @if(isset($error))
            <div class="alert alert-danger text-center">{{ $error }}</div>
        @endif

        <div class="row">
            @foreach($characters as $character)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img src="{{ $character['image'] }}" class="card-img-top" alt="{{ $character['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $character['name'] }}</h5>
                            <p class="card-text">
                                <strong>Status:</strong>
                                <span class="status-{{ strtolower($character['status']) }}">
                                    {{ $character['status'] }}
                                </span><br>
                                <strong>Espécie:</strong> {{ $character['species'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="footer">
        Feito por wentz.dev@gmail.com - usando a Rick and Morty API
    </footer>

    <script>
    window.addEventListener('load', function () {
        const spinner = document.getElementById('loading-spinner');
        if (spinner) {
            spinner.classList.add('fade-out');
            setTimeout(() => {
                spinner.style.display = 'none';
            }, 500); // espera a animação terminar antes de esconder o elemento
        }
    });
</script>


</body>
</html>
