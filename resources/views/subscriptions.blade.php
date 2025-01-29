<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Subscriptions</title>
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

        .theme-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .theme-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .theme-header h3 {
            font-size: 24px;
            color: #2C3E50;
        }

        .theme-header a {
            color: #e74c3c;
            text-decoration: none;
            font-size: 14px;
            border: 1px solid #e74c3c;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .theme-header a:hover {
            background-color: #e74c3c;
            color: white;
        }

        .articles-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .article-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .article-item img {
            width: 100px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .article-item a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        .article-item a:hover {
            color: #2980b9;
        }

        .empty-message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #7f8c8d;
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
    <h1>Your Subscriptions</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h2>Your Subscribed Themes</h2>

    @if($themes->count() > 0)
        @foreach($themes as $theme)
            <div class="theme-card">
                <div class="theme-header">
                    <h3>{{ $theme->name }}</h3>
                    <a href="/themes/{{ $theme->id }}/unsubscribe">Unsubscribe</a>
                </div>

                @if($theme->articles->count() > 0)
                    <div class="articles-list">
                        @foreach($theme->articles->take(3) as $article)
                            <div class="article-item">
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image">
                                <div>
                                    <a href="/articles/{{ $article->id }}">{{ $article->title }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="empty-message">No articles available for this theme yet.</p>
                @endif
            </div>
        @endforeach
    @else
        <p class="empty-message">You are not subscribed to any themes yet.</p>
    @endif
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
