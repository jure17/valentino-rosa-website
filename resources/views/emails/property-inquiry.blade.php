<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuova Richiesta di Informazioni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #D12C7A;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 10px;
        }
        .title {
            color: #D12C7A;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .section {
            margin-bottom: 25px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #D12C7A;
        }
        .section-title {
            font-weight: bold;
            color: #D12C7A;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .field {
            margin-bottom: 8px;
        }
        .field-label {
            font-weight: bold;
            color: #555;
        }
        .field-value {
            color: #333;
            margin-left: 10px;
        }
        .property-details {
            background-color: #e8f4fd;
            border-left-color: #2196F3;
        }
        .contact-details {
            background-color: #f3e5f5;
            border-left-color: #9C27B0;
        }
        .message-details {
            background-color: #e8f5e8;
            border-left-color: #4CAF50;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1 class="title">
                @if(isset($inquiryData['property_title']))
                    Nuova Richiesta di Informazioni
                @else
                    Nuova Richiesta di Preventivo
                @endif
            </h1>
            <p>
                @if(isset($inquiryData['property_title']))
                    Hai ricevuto una nuova richiesta di informazioni su un immobile
                @else
                    Hai ricevuto una nuova richiesta di preventivo per i servizi
                @endif
            </p>
        </div>

        @if(isset($inquiryData['property_title']))
        <!-- Property Details -->
        <div class="section property-details">
            <div class="section-title">📋 Dettagli Immobile</div>
            <div class="field">
                <span class="field-label">Immobile:</span>
                <span class="field-value">{{ $inquiryData['property_title'] }}</span>
            </div>
            @if(isset($inquiryData['property_type']))
            <div class="field">
                <span class="field-label">Tipo:</span>
                <span class="field-value">{{ ucfirst($inquiryData['property_type']) }}</span>
            </div>
            @endif
        </div>
        @else
        <!-- Service Details -->
        <div class="section property-details">
            <div class="section-title">🔧 Servizio Richiesto</div>
            <div class="field">
                <span class="field-label">Tipo di Servizio:</span>
                <span class="field-value">{{ $inquiryData['service_type'] }}</span>
            </div>
        </div>
        @endif

        <!-- Contact Details -->
        <div class="section contact-details">
            <div class="section-title">👤 Dettagli Contatto</div>
            <div class="field">
                <span class="field-label">Nome e Cognome / Azienda:</span>
                <span class="field-value">{{ $inquiryData['name'] }}</span>
            </div>
            <div class="field">
                <span class="field-label">Telefono:</span>
                <span class="field-value">{{ $inquiryData['phone'] ?: 'Non fornito' }}</span>
            </div>
            <div class="field">
                <span class="field-label">Email:</span>
                <span class="field-value">{{ $inquiryData['email'] }}</span>
            </div>
        </div>

        <!-- Message Details -->
        <div class="section message-details">
            <div class="section-title">💬 Messaggio</div>
            <div class="field">
                <span class="field-label">Messaggio:</span>
                <div class="field-value" style="margin-left: 0; margin-top: 10px; white-space: pre-wrap;">{{ $inquiryData['message'] }}</div>
            </div>
        </div>



        <div class="footer">
            <p>Questo messaggio è stato inviato automaticamente dal sito web di Valentino Rosa SA</p>
            <p>Per rispondere, utilizza l'email del mittente: {{ $inquiryData['email'] }}</p>
        </div>
    </div>
</body>
</html> 