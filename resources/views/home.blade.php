<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Horizons - Home</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fb;
            color: #333;
        }

        /* header {
            background-color: #2C3E50;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed; Fixe le header
            top: 0;          Positionné en haut
            left: 0;         S'étend à gauche
            right: 0;        S'étend à droite
            z-index: 1000;   S'assure qu'il est au-dessus des autres éléments
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
        }  */
          
        header {
            background-color: #2C3E50;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
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

        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 20px;
            padding: 5px 10px;
            margin-left: 20px;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-size: 16px;
        }

        .search-bar input::placeholder {
            color: #999;
        }

        .search-bar button {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .search-bar svg {
            width: 20px;
            height: 20px;
            fill: #2C3E50;
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

        .cta-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #27AE60;
            color: white;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #1e7e3b;
        }

        .theme-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .theme-card {
            flex: 1 1 calc(33% - 20px);
            background-color: #ecf0f1;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .theme-card h3 {
            font-size: 20px;
            color: #2C3E50;
            margin-bottom: 15px;
        }

        .theme-card p {
            font-size: 14px;
            color: #7f8c8d;
        }

        .theme-card button {
            padding: 12px 20px;
            margin-top: 15px;
            background-color: #27AE60;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .theme-card button:hover {
            background-color: #1e7e3b;
        }

        .message-box {
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            background-color: #f1f8e9;
            border: 1px solid #d4e157;
            color: #388e3c;
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

        .public-issues .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .public-issues .card h3 {
            font-size: 22px;
            margin-bottom: 15px;
        }

        .public-issues .card p {
            color: #7f8c8d;
        }

        .public-issues .card button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .public-issues .card button:hover {
            background-color: #2980b9;
        }

    </style>
</head>
<body>
<!-- Header -->
<header>
    <!-- <h1>Tech Horizons</h1>
    <nav>
        @if(Auth::check())
            @if(Auth::user()->role === 'Theme Manager')
                <a href="/theme-manager/dashboard">Dashboard</a>
                <a href="/logout">Logout</a>
            @endif
        @if(Auth::user()->role === 'Editor')
                <a href="/editor/dashboard">Dashboard</a>
                <a href="/logout">Logout</a>
            @endif
            @if(Auth::user()->role === 'Subscriber')
                <a href="/propose-article">Propose a New Article</a>
                <a href="/history">View Browsing History</a>
                    <a href="/subscriptions">Subscriptions</a>
                    <a href="/my-articles">My articles</a>
                    <a href="/logout">Logout</a>
            @endif
                @if(Auth::user()->role === 'Guest')
                    <a href="/logout">Logout</a>
                @endif
        @else
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        @endif
    </nav> -->
    <h1>Tech Horizons</h1>
    <div style="display: flex; align-items: center;">
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Rechercher un article">
            <button onclick="handleSearch()">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="currentColor">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 10.5 5 15 7.01 15 9.5 12.99 14 10.5 14z"/>
                </svg>
            </button>
        </div>
        <nav>
            @if(Auth::check())
                @if(Auth::user()->role === 'Theme Manager')
                    <a href="/theme-manager/dashboard">Dashboard</a>
                    <a href="/logout">Logout</a>
                @endif
                @if(Auth::user()->role === 'Editor')
                    <a href="/editor/dashboard">Dashboard</a>
                    <a href="/logout">Logout</a>
                @endif
                @if(Auth::user()->role === 'Subscriber')
                    <a href="/propose-article">Propose a New Article</a>
                    <a href="/history">View Browsing History</a>
                    <a href="/subscriptions">Subscriptions</a>
                    <a href="/my-articles">My articles</a>
                    <a href="/logout">Logout</a>
                @endif
                @if(Auth::user()->role === 'Guest')
                    <a href="/logout">Logout</a>
                @endif
            @else
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            @endif
        </nav>
        
    </div>

</header>

<!-- Main Content -->
<div class="container">
    <!-- For Guests -->
    @if(Auth::guest())
        <h2>Welcome to Tech Horizons!</h2>
        <p>Tech Horizons is your gateway to the latest technological innovations. Explore our public content or submit a request to become a subscriber and unlock exclusive features!</p>
        <a href="/register" class="cta-button">Submit Subscription Request</a>
    @endif

    <!-- For Subscribers -->
    @if(Auth::check() && Auth::user()->role === 'Subscriber')
        <h2>Welcome Back, {{ Auth::user()->first_name }}!</h2>
        <p>Here are the themes you're subscribed to. Click on a theme to explore its articles:</p>
    @endif

    <!-- For Pending Requests -->
    @if(Auth::check() && Auth::user()->role === 'Guest')
        <h2>Your Subscription Request is Pending</h2>
        <div class="message-box success">
            <p>Your request to become a subscriber is currently being reviewed. Once approved, you will gain access to exclusive content.</p>
        </div>
    @endif

    <h3>Themes</h3>
    <div class="theme-grid">
        @foreach($themes as $theme)
            <div class="theme-card">
                <h3>{{ $theme->name }}</h3>
                <p>{{ $theme->description }}</p>
                <a href="/themes/{{ $theme->id }}/articles">
                    <button>View Articles</button>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Issues -->
   @if(Auth::check())
        <h3>Issues</h3>
    @else
        <h3>Public Issues</h3>
    @endif

    <div class="public-issues">
        @if(Auth::check() && Auth::user()->role != 'Guest')

        @foreach($issues as $data)
             @if($data->is_active) <!-- Vérifie si l'issue est active -->
                <div class="card">
                    <h3>{{ $data->title }}</h3>
                    <p>Published on: {{ $data->published_at }}</p>
                     <button onclick="window.location.href='/issues/{{ $data->id }}/articles'">View Issue</button>
                </div>
             @endif
        @endforeach
        @else
            @foreach($publicIssues as $issue)
                <div class="card">
                    <h3>{{ $issue->title }}</h3>
                    <p>Published on: {{ $issue->published_at }}</p>
                    <button onclick="window.location.href='/issues/{{ $issue->id }}/articles'">View Issue</button>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Tech Horizons. All rights reserved.</p>
</footer>
</body>
</html>
