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

@if(count($books) > 0)
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>العنوان</th>
            <th>المؤلف</th>
            <th>الوصف</th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <td>{{ $books['title'] }}</td>
                <td>{{ $books['author'] }}</td>
                <td>{{ $books['description'] }}</td>
            </tr>

        </tbody>
    </table>

@else
    <p class="text-danger">لا توجد نتائج.</p>
@endif
</body>
</html>
