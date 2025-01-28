@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browsing History</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 28px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .empty-message {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
            color: #666;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #4CAF50;
            color: white;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<!-- Header -->
<header>
    <h1>Browsing History</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h2>Your Browsing History</h2>

    @if($history->isEmpty())
        <p class="empty-message">You have not viewed any articles yet.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Article Title</th>
                <th>Theme</th>
                <th>Date Viewed</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $entry)
                <tr>
                    <td>{{ $entry->article->title }}</td>
                    <td>{{ $entry->article->theme->name }}</td>
                    <td>{{ Carbon::parse($entry->viewed_at)->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="/articles/{{ $entry->article->id }}" style="color: #4CAF50; text-decoration: none;">View
                            Article</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
