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
            <a href="{{ url('/api/users/1') }}" target="_blank" class="text-white btn btn-info btn-lg">
                Show First User (GET /api/users/1)
            </a>
            <button id="btn-delete" class="btn btn-danger btn-lg">
                Delete User 1 (DELETE)
            </button>
        </div>

        <p class="mt-5 text-muted">
            Simple Laravel 11 Test with Bootstrap 5<br>Test for Conecta Lá
        </p>
    </div>
</body>
<script>
    document.getElementById('btn-delete').addEventListener('click', async () => {
        if (!confirm('Are you sure you want to delete user #1?')) return;

        const res = await fetch('{{ url('/api/users/1') }}', {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (res.status === 204) {
            alert('User #1 deleted ✅');
        } else {
            const data = await res.json().catch(() => ({}));
            alert('Deletion failed: ' + (data.message ?? res.statusText));
        }
    });
</script>

</html>
