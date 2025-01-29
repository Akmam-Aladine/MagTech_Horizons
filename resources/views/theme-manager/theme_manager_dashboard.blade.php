<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Manager Dashboard</title>
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

        .section {
            margin-bottom: 40px;
        }

        .section h2 {
            font-size: 24px;
            color: #2C3E50;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #2C3E50;
            color: white;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .stat-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #3498db;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 24px;
        }

        .stat-card p {
            margin: 0;
            font-size: 16px;
        }

        .actions button {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .actions .approve {
            background-color: #2ecc71;
            color: white;
        }

        .actions .approve:hover {
            background-color: #27ae60;
        }

        .actions .reject {
            background-color: #e74c3c;
            color: white;
        }

        .actions .reject:hover {
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
    <h1>Theme Manager Dashboard</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <!-- Statistics Section -->
    <div class="section">
        <h2>Statistics</h2>
        <div class="stat-card">
            <div>
                <h3>{{ $articlesCount }}</h3>
                <p>Total Articles</p>
            </div>
            <div>
                <h3>{{ $subscribersCount }}</h3>
                <p>Total Subscribers</p>
            </div>
        </div>
    </div>

    <!-- Article Management Section -->
    <div class="section">
        <h2>Manage Articles</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Proposed By</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->proposer->first_name }} {{ $article->proposer->last_name }}</td>
                    <td>{{ $article->status }}</td>
                    <td class="actions">
                        @if($article->status === 'Pending')
                            <form action="/theme-manager/articles/{{ $article->id }}/approve" method="POST" style="display: inline;">
                                @csrf
                                <button class="approve">Approve</button>
                            </form>
                            <form action="/theme-manager/articles/{{ $article->id }}/reject" method="POST" style="display: inline;">
                                @csrf
                                <button class="reject">Reject</button>
                            </form>
                            <!-- View Article Button -->
                            <a href="/theme-manager/articles/{{ $article->id }}" style="margin-right: 10px; text-decoration: none; color: #3498db; font-weight: bold;">
                                View Article
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Subscribers Section -->
    <div class="section">
        <h2>Manage Subscribers</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subscribed On</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber->first_name }} {{ $subscriber->last_name }}</td>
                    <td>{{ $subscriber->email }}</td>
                    <td>{{ $subscriber->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Manage Comments Section -->
    <div class="section">
        <h2>Manage Comments</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Comment</th>
                <th>Article</th>
                <th>Commented By</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->article->title }}</td>
                    <td>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</td>
                    <td class="actions">
                        <form action="/theme-manager/comments/{{ $comment->id }}/delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
