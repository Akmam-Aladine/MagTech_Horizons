<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propose a New Article</title>
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
            max-width: 600px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input,
        textarea,
        select,
        button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
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
    <h1>Propose an Article</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/logout">Logout</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <h2>Submit a New Article</h2>

    <!-- Validation errors -->
    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form for proposing an article -->
    <form action="/propose-article" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter article title" required>

        <label for="theme">Select Theme</label>
        <select name="theme" id="theme" required>
            @foreach($themes as $theme)
                <option value="{{ $theme->id }}">{{ $theme->name }}</option>
            @endforeach
        </select>

        <label for="content">Content</label>
        <textarea name="content" id="content" rows="5" placeholder="Write the article content here..." required></textarea>

        <label for="image">Upload an Image</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit">Submit Article</button>
    </form>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
