<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث عن الكتب</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
<h2 class="mb-4">ابحث عن كتاب</h2>

<form action="{{ route('books.search') }}" method="POST">
    @csrf
    <div class="mb-3">
        <input type="text" name="query" class="form-control" placeholder="أدخل اسم الكتاب" required>
    </div>
    <button type="submit" class="btn btn-primary">بحث</button>
</form>
</body>
</html>
