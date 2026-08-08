<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CMT — LJ University')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            font-family:'Segoe UI',sans-serif;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(160deg,#eef2ff 0%,#dbe4ff 50%,#eef2ff 100%);
            padding:24px;
        }
        .auth-card { border:none; border-radius:20px; box-shadow:0 20px 50px rgba(30,58,138,.15); overflow:hidden; }
        .auth-brand { background:linear-gradient(160deg,#1e3a8a 0%,#2563eb 60%,#3b82f6 100%); color:#fff; }
        .input-group-text { background:#f8f9fa; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>