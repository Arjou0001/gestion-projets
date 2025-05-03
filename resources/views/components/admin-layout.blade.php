<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
</head>
<body>
    <div class="admin-container">
        <nav>
            <a href="{{ route('admin.users.index') }}" class="nav-link">Chefs d'Entreprise</a>
            <a href="{{ route('admin.entreprises.index') }}" class="nav-link">Entreprises</a>
            <a href="{{ route('admin.projets.index') }}" class="nav-link">Projets</a>
        </nav>
        <main>
            {{ $slot }}
        </main>
        <footer>
        </footer>
    </div>
</body>
</html>