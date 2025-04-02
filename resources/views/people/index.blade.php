<!-- resources/views/people/index.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Personnes</title>
</head>
<body>
    <h1>Liste des Personnes</h1>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Créé par</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
                <tr>
                    <td>{{ $person->first_name }}</td>
                    <td>{{ $person->last_name }}</td>
                    <td>{{ $person->creator->first_name }} {{ $person->creator->last_name }}</td>
                    <td>
                        <a href="{{ route('people.show', $person->id) }}">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('people.create') }}">Créer une nouvelle personne</a>
</body>
</html>
