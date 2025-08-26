<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden de Compra Nro. {{ $compra->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #007bff;
            font-size: 24px;
            margin: 0;
        }
        .content {
            line-height: 1.6;
            margin: 0 0 10px;
        }
        .info-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }
        .info-section p {
            margin: 0;
            font-size: 14px;
        }
        .info-section p span {
            font-weight: bold;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .product-table th, .product-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .product-table th {
            background-color: #007bff;
            color:  white;
            text-transform: uppercase;
        }
        .total-row {
            font-weight: bold;
            background-color: #e9f5ff;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Orden de Compra</h1>
            <h3>Nro. {{ $compra->id }}</h3>
        </div>

        <div class="info-section">
            <p><strong>Proveedor:</strong> {{ $proveedor->nombre }}</p>
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</p>
        </div>

        <div class="content">
            <p>Estimado/a {{ $proveedor->nombre }},</p>
            <p>Adjuntamos los Detalles de la Orden de Compra Nro.{{ ($compra->id) }}</p>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $detalle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        <div class="content">
            <p>Esperamos su Pronta confirmacion y Respuesta.</p>
            <p>Saludos Cordiales...</p>
        </div>
    </div>
</body>
</html>