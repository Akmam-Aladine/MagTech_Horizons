<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fb;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .article-header {
            margin-bottom: 20px;
        }

        .article-header h1 {
            font-size: 28px;
            color: #2C3E50;
        }

        .article-header p {
            font-size: 14px;
            color: #7f8c8d;
        }

        .article-content {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .article-actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn.approve {
            background-color: #2ecc71;
            color: white;
        }

        .btn.approve:hover {
            background-color: #27ae60;
        }

        .btn.reject {
            background-color: #e74c3c;
            color: white;
        }

        .btn.reject:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="article-header">
        <h1>{{ $article->title }}</h1>
        <p><strong>Theme:</strong> {{ $article->theme->name }}</p>
        <p><strong>Proposed By:</strong> {{ $article->proposer->first_name }} {{ $article->proposer->last_name }}</p>
        <p><strong>Status:</strong> {{ $article->status }}</p>
    </div>

    <div class="article-content">
        <p>{{ $article->content }}</p>
    </div>
</div>
</body>
</html>
