<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement OPJ</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 800px;
            margin: 2rem auto;
        }

        .logo {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto 2rem auto;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        .date {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #555;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 1rem;
            margin: 0.5rem 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 1.1rem;
        }

        .btn-policier {
            background-color: #28a745;
        }

        .btn-gendarme {
            background-color: #007bff;
        }

        .btn-inspecteur {
            background-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .alert-success {
            color: #218838;
            text-align: center;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('OIP.jpg') }}" alt="Logo du Tribunal" class="logo">
        
        <!-- Affichage de la date d'aujourd'hui en format long -->
        <div class="date">
            {{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F Y') }}
        </div>

        <h1>Soyez le bienvenu</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }} - Numéro d'appel : {{ session('numero_appel') }} <br> <br>
                Nombre d'OPJ non pris en charge : {{ session('nombreNonPriseEnCharge') }}
            </div>
            <script>
                // Fonction pour imprimer le ticket
                function imprimerTicket() {
                    var ticketContent = `
                        <div style="width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; text-align: center;">
                            <h2 style="margin-bottom: 20px;">Ticket d'Appel</h2>
                            <p style="margin: 5px 0;">Numéro d'appel : <strong>{{ session('numero_appel') }}</strong></p>
                            <p style="margin: 5px 0;">Nombre d'OPJ non pris en charge : <strong>{{ session('nombreNonPriseEnCharge') }}</strong></p>
                        </div>
                    `;

                    // Ouvrir une nouvelle fenêtre pour l'impression du ticket
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write('<html><head><title>Ticket</title></head><body>');
                    printWindow.document.write(ticketContent);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    
                    // Attendre que le contenu de la fenêtre soit prêt, puis imprimer et fermer
                    printWindow.focus();
                    printWindow.print();
                    
                    // Fermer la fenêtre après un délai de 3 secondes (pour s'assurer que l'impression est terminée)
                    printWindow.onafterprint = function() {
                        setTimeout(function() {
                            printWindow.close();
                        }, 3000); // 3 secondes après l'impression
                    };
                }

                // Imprimer le ticket après un délai de 1 seconde
                setTimeout(imprimerTicket, 1000);

                // Actualiser la page principale après 2 secondes
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            </script>
        @endif

        <form action="{{ route('opj.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="provenance">Provenance :</label>
                <select id="provenance" name="provenance" required>
                    <option value="">Sélectionnez votre lieu de travail</option>
                    @foreach($provenances as $provenance)
                        <option value="{{ $provenance }}">{{ $provenance }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="role" value="policier" class="btn btn-policier">Policier</button>
                <button type="submit" name="role" value="gendarme" class="btn btn-gendarme">Gendarme</button>
                <button type="submit" name="role" value="inspecteur" class="btn btn-inspecteur">Inspecteur</button>
            </div>
        </form>
    </div>
</body>
</html>
