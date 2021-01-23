<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('bootstrap-4.2.1/css/bootstrap.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    @yield('css')
    <title>Dashboard</title>
    <style>
        a:link, a:active, a:visited, a:hover {
            text-decoration: none;
        }

        .list-group-item-se {
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: -1px;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .btn-close {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light row">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/list_management">contacts list</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo03">
        </div>
    </nav>
    <section style="min-height: 500px">
        @yield('conteudo')
    </section>

    <section>
        <footer class="rodape border-top">
            <p class="text-center col-12"><b>Copyright © 2021 Todos os direitos reservado</b></p>
        </footer>
        <script src="{{ asset('js/jquery-3-4-1-jquery-min.js') }}"></script>
        <script src="{{ asset('bootstrap-4.2.1/js/bootstrap.js') }}"></script>
        <script>

        </script>
    </section>
</div>
</body>
</html>
