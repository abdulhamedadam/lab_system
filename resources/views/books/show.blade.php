<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتائج البحث</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
<h2 class="mb-4">نتائج البحث عن "{{ $query }}"</h2>

<a href="{{ route('books.index') }}" class="btn btn-secondary mb-3">رجوع</a>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $book['title'] }}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $book['image'] }}" alt="{{ $book['title'] }}" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <p><strong>السعر:</strong> {{ $book['price'] }}</p>
                    <p><strong>الوصف:</strong> {{ $book['description'] }}</p>
                    <a href="{{ $book['link'] }}" target="_blank" class="btn btn-primary">عرض على نيل وفرات</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
