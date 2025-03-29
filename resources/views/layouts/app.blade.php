<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Comparison of Credit Cards')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            padding-top: 50px;
        }

        .card-item {
            background-color: #fff;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
        }

        .features {
            font-size: 14px;
            margin-top: 10px;
        }

        .features .check {
            color: green;
            font-weight: bold;
        }

        .features .warning {
            color: #aaa;
        }

        .price {
            text-align: right;
            font-weight: bold;
            color: #007bff;
        }

        .logo {
            width: 120px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-5">@yield('title')</h2>
        @yield('content')
    </div>
</body>

</html>