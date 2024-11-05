<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage de la File d'Attente</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background-color: #008000;
            color: white;
            font-weight: bold;
            padding: 10px;
            font-size: 1.2em;
            text-align: center;
            border-bottom: 2px solid #2c3e50;
        }

        table td {
            padding: 10px;
            text-align: center;
            font-size: 1.1em;
            color: #2c3e50;
            border-bottom: 1px solid #ddd;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #eaf2f8;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            h1 {
                font-size: 1.8em;
            }

            table {
                font-size: 0.9em;
            }
        }

        .indication {
            color: green;
            text-align: center;
            font-size: 1.1em;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Affichage de la File d'Attente</h1>
        <p class="indication">PENSEZ A VOUS ENREGISTRER A L'ACCUEIL</p>
        <table id="fileDattenteTable">
            <thead>
                <tr>
                    <th>Numéro d'appel</th>
                    <th>Porte Numéro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($file_d_attente as $item)
                    <tr>
                        <td>{{ $item['numero_appel'] ?? 'Non défini' }}</td>
                        <td>{{ $item['door_number'] ?? 'Non défini' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function speak() {
            const table = document.getElementById('fileDattenteTable');
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            let textToRead = '';

            for (let row of rows) {
                const numeroAppel = row.cells[0].innerText;
                const numSubstitut = row.cells[1].innerText;
                textToRead += `Le numéro ${numeroAppel} est attendu à la porte ${numSubstitut}. `;
            }

            // Création de deux instances pour répéter la voix deux fois
            const speech1 = new SpeechSynthesisUtterance(textToRead);
            const speech2 = new SpeechSynthesisUtterance(textToRead);

            speech1.lang = 'fr-FR'; // Langue française
            speech2.lang = 'fr-FR'; // Langue française

            // Prononce le texte une première fois
            window.speechSynthesis.speak(speech1);

            // Prononce le texte une deuxième fois après la première
            speech1.onend = function() {
                window.speechSynthesis.speak(speech2);
            };
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            speak();

            setInterval(() => {
                location.reload(); // Recharge la page
            }, 120000);
        });
    </script>
</body>
</html>
