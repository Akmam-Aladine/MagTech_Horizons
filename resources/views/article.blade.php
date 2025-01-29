@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
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
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .article-header img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        .article-header h2 {
            font-size: 28px;
            color: #4CAF50;
            margin-top: 20px;
        }

        .article-meta {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        .article-content {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .comments-section {
            margin-top: 40px;
        }

        .comments-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            font-size: 14px;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .rating-section {
            margin-top: 40px;
        }

        .rating-stars {
            font-size: 20px;
            cursor: pointer;
            color: #ddd;
        }

        .rating-stars.selected {
            color: #FFD700;
        }

        form {
            margin-top: 20px;
        }

        textarea,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
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
    <h1>Article Details</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <!-- Article Header -->
    <div class="article-header">
        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" style="max-width: 100%; height: auto; border-radius: 8px;">
        @else
            <p>No image available for this article.</p>
        @endif        <h2>{{ $article->title }}</h2>
        <div class="article-meta">
            <p><strong>Theme:</strong> {{ $article->theme->name }}</p>
            <p><strong>Author:</strong> {{ $article->proposer->first_name }} {{ $article->proposer->last_name }}</p>
            <p><strong>Published on:</strong> {{ Carbon::parse($article->published_at)->format('d M Y') }}</p>
        </div>
    </div>

    <!-- Article Content -->
    <div class="article-content">
        <p>{{ $article->content }}</p>
    </div>

    <!-- Rating Section -->
    <div class="rating-section">
        <h3>Rate this Article</h3>
        <p><strong>Average Rating:</strong> {{ number_format($averageRating, 1) }} / 5 ({{ $totalRatings }} ratings)</p>

        @auth
            @if(Auth::user()->role !== 'Guest')
                <form action="/articles/{{ $article->id }}/rate" method="POST">
                    @csrf
                    <div>
                        @for($i = 1; $i <= 5; $i++)
                            <span class="rating-stars" data-value="{{ $i }}">&#9733;</span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating" value="">
                    <input type="submit" value="Submit Rating">
                </form>
            @else
                <p>You cannot rate this article as a guest user.</p>
            @endif
        @else
            <p><a href="/login">Log in</a> to rate this article.</p>
        @endauth
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <h3>Comments ({{ $comments->count() }})</h3>
        @foreach($comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</strong> said:</p>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach

        <h4>Add a Comment</h4>
        @auth
            @if(Auth::user()->role !== 'Guest')
                <form action="/articles/{{ $article->id }}/comments" method="POST">
                    @csrf
                    <textarea name="content" rows="3" placeholder="Write your comment..." required></textarea>
                    <input type="submit" value="Post Comment">
                </form>
            @else
                <p>You cannot add a comment as a guest user.</p>
            @endif
        @else
            <p><a href="/login">Log in</a> to add a comment.</p>
        @endauth
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>

<!-- JavaScript for Rating -->
<script>
    const stars = document.querySelectorAll('.rating-stars');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const ratingValue = star.getAttribute('data-value');
            ratingInput.value = ratingValue;

            // Update UI
            stars.forEach(s => s.classList.remove('selected'));
            for (let i = 0; i < ratingValue; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
</script>
</body>
</html>
