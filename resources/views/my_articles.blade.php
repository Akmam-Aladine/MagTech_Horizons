<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Proposed Articles</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fb;
            color: #333;
        }

        header {
            background-color: #2C3E50;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        header nav a:hover {
            color: #ecf0f1;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 32px;
            color: #2C3E50;
            margin-bottom: 20px;
        }

        .article-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .article-card h3 {
            font-size: 24px;
            color: #2C3E50;
            margin: 0;
        }

        .article-card .status {
            font-size: 14px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .status.pending {
            background-color: #f39c12;
            color: white;
        }

        .status.approved {
            background-color: #3498db;
            color: white;
        }

        .status.rejected {
            background-color: #e74c3c;
            color: white;
        }

        .status.published {
            background-color: #2ecc71;
            color: white;
        }

        .actions a,
        .actions form {
            margin-left: 10px;
        }

        .actions button {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .actions .delete {
            background-color: #e74c3c;
            color: white;
        }

        .actions .delete:hover {
            background-color: #c0392b;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #2C3E50;
            color: white;
            margin-top: 40px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
<!-- Header -->
<header>
    <h1>My Proposed Articles</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h2>Track Your Articles</h2>
    @if($articles->count() > 0)
        @foreach($articles as $article)
            <div class="article-card">
                <div>
                    <h3>{{ $article->title }}</h3>
                </div>
                <div>
                    <span class="status {{ strtolower($article->status) }}">{{ $article->status }}</span>
                </div>
                <div class="actions">
                    @if(!in_array($article->status, ['Approved', 'Published']))
                        <form action="/articles/{{ $article->id }}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                            @csrf
                            @method('DELETE')
                            <button class="delete">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>You have not proposed any articles yet.</p>
    @endif
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
