<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #{{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 0;
            color: #333;
        }
        .container {
            width: 800px;
            margin: auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #F4F1ED;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header img {
            max-width: 80px;
        }
        .invoice-number {
            background: #fff;
            padding: 5px 10px;
            border: 1px solid #333;
            display: inline-block;
            margin-top: 10px;
        }
        .section {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
        .box {
            width: 48%;
            padding: 10px;
            border: 1px solid #ddd;
            background: #F9F9F9;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background: #222;
            color: #fff;
        }
        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .payment-info {
            margin-top: 30px;
            padding: 15px;
            background: #F9F9F9;
            border: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- ENCABEZADO -->
        <div class="header">
            <h1>FACTURA</h1>
            <img src="{{ public_path('img/logo.png') }}" alt="Logo">
        </div>
        <p class="invoice-number">Nº {{ $order->id }}</p>

        <!-- DATOS DEL CLIENTE Y EMPRESA -->
        <div class="section">
            <div class="box">
                <p><strong>DATOS DEL CLIENTE</strong></p>
                <p>{{ $order->user->name }}</p>
                <p>{{ $order->user->email }}</p>
                <p>{{ $order->user->address }}</p>
            </div>
            <div class="box">
                <p><strong>DATOS DE LA EMPRESA</strong></p>
                <p>Tu Tienda Online</p>
                <p>contacto@tutienda.com</p>
                <p>Dirección de la empresa</p>
            </div>
        </div>

        <!-- TABLA DE PRODUCTOS -->
        <table class="table">
            <thead>
                <tr>
                    <th>Detalle</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->shoe->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->shoe->price, 2) }} €</td>
                    <td>{{ number_format($item->shoe->price * $item->quantity, 2) }} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TOTAL -->
        <p class="total">IVA (21%): {{ number_format($totalPrice * 0.21, 2) }} €</p>
        <p class="total">TOTAL: {{ number_format($totalPrice * 1.21, 2) }} €</p>

        <!-- INFORMACIÓN DE PAGO -->
        <div class="payment-info">
            <p><strong>INFORMACIÓN DE PAGO</strong></p>
            <p>Transferencia bancaria</p>
            <p>Banco: Nombre del Banco</p>
            <p>Titular: Tu Tienda Online</p>
            <p>Número de cuenta: XXXX XXXX XXXX XXXX</p>
        </div>

        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <p>www.tutienda.com</p>
        </div>
    </div>

</body>
</html>
