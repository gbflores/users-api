<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome – Users API test for Conecta Lá</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384‑E4/X9c9luS6Swv5uaiu0rMZ6lOlI10mz0n4nY2fwVVXb9ZYO2i2GKfPH/2PjKU7R" crossorigin="anonymous">
</head>

<body class="d-flex vh-100">
    <div class="container m-auto text-center">
        <h1 class="mb-4 fw-bold">Users API – Demo Endpoints</h1>

        <div class="gap-3 mx-auto d-grid col-12 col-md-6">
            <a href="{{ url('/api/users') }}" target="_blank" class="btn btn-primary btn-lg">List Users (GET)</a>

            <button id="btn-create" class="btn btn-success btn-lg">Create Sample User (POST)</button>

            <a href="{{ url('/api/users/1') }}" target="_blank" class="text-white btn btn-info btn-lg">
                Show First User (GET /api/users/1)
            </a>
        </div>

        <p class="mt-5 text-muted">
            Simple Laravel 11 Test with Bootstrap 5<br>Test for Conecta Lá
        </p>
    </div>

    <script>
        document.getElementById('btn-create').addEventListener('click', async () => {
            const res = await fetch('{{ url('/api/users') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: 'Demo User Test' + Date.now(),
                    email: 'demo' + Date.now() + '@test.com',
                    password: 'secret123'
                })
            });

            const data = await res.json();
            alert('Created user ID ' + data.id);
        });
    </script>
</body>

</html>
