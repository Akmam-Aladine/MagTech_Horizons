@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $issue->title }} - Articles</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
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

        .article-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .article-card {
            flex: 1 1 calc(33% - 20px);
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .article-card h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .article-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .article-card small {
            font-size: 12px;
            color: #999;
        }

        .article-card button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .article-card button:hover {
            background-color: #45a049;
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
    <h1>{{ $issue->title }} - Articles</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h2>Articles in {{ $issue->title }}</h2>
    @if($articles->isEmpty())
        <p>No articles found for this issue.</p>
    @else
        <div class="article-grid">
            @foreach($articles as $article)
                <div class="article-card">
                    <h3>{{ $article->title }}</h3>
                    <p><strong>Theme:</strong> {{ $article->theme->name }}</p>
                    <small>Published on:
                        {{ $article->published_at ? Carbon::parse($article->published_at)->format('d M Y') : 'Not Published Yet' }}
                    </small>
                    <button onclick="window.location.href='/articles/{{ $article->id }}'">Read More</button>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Footer -->
<footer>
    <p>&copy;Magazine Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
