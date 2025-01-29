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

        /* .article-grid {
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
        } */
         
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
        <div class="articles-grid">
          @foreach($articles as $article)
             <div class="article-card">
                 <a href="/articles/{{ $article->id }}">
                     <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                 </a>
                <h3>{{ $article->title }}</h3>
                   <p>{{ $article->theme->name }}</p>
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
