<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - {{ $theme->name }}</title>
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

        .subscribe-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .subscribe-button:hover {
            background-color: #2980b9;
        }

        .unsubscribe-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .unsubscribe-button:hover {
            background-color: #e74c3c; /* Couleur rouge vif */
        }

    

        .articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
    background-color: #f4f7fb;
}

.article-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.article-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.article-card img {
    width: 100%;
    height: auto;
    max-height: 200px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.article-card h3 {
    font-size: 18px;
    margin: 10px 0;
    color: #2C3E50;
}

.article-card p {
    font-size: 14px;
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
    <h1>Tech Horizons</h1>
    <nav>
        @if(Auth::check())
            @if(Auth::user()->role === 'Theme Manager' || Auth::user()->role === 'Editor')
                <a href="/dashboard">Dashboard</a>
                <a href="/logout">Logout</a>
            @endif
            @if(Auth::user()->role === 'Subscriber')
                <a href="/propose-article">Propose a New Article</a>
                <a href="/history">View Browsing History</a>
                <a href="/logout">Logout</a>
            @endif
        @else
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        @endif
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h2>Articles in the "{{ $theme->name }}" Theme</h2>
    <p>Explore all articles related to this theme. Click on an article title to read more.</p>


    <!-- Subscribe Button -->
    @auth
        @if(Auth::user()->role === 'Subscriber')
            @if($is_subscribed)
                <a href="/themes/{{ $theme->id }}/unsubscribe" class="unsubscribe-button">Unsubscribe</a>
            @else
                <a href="/themes/{{ $theme->id }}/subscribe" class="subscribe-button">Subscribe</a>
            @endif
        @endif
    @endauth

  

<div class="articles-grid">
@if($articles->count() > 0)
    @foreach($articles as $article)
    <div class="article-card">
        <a href="/articles/{{ $article->id }}">
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
        </a>
        <h3>{{ $article->title }}</h3>
        <p>{{ $article->theme->name }}</p>
    </div>
    @endforeach
    @else
        <p>No articles found in this theme.</p>
 @endif   
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
