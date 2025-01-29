@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Dashboard</title>
    <style>
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
            max-width: 1200px;
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

        .form-inline {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .form-inline input,
        .form-inline select,
        .form-inline button {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: box-shadow 0.3s ease;
        }

        .form-inline button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-inline button:hover {
            background-color: #2980b9;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            padding: 15px;
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

        .actions button,
        .actions a {
            padding: 8px 12px;
            font-size: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .actions .activate {
            background-color: #2ecc71;
            color: white;
        }

        .actions .activate:hover {
            background-color: #27ae60;
        }

        .actions .deactivate {
            background-color: #e67e22;
            color: white;
        }

        .actions .deactivate:hover {
            background-color: #d35400;
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
    <h1>Editor Dashboard</h1>
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
        <ul>
            <li>Total Subscribers: {{ $subscribersCount }}</li>
            <li>Total Themes: {{ $themesCount }}</li>
            <li>Total Articles: {{ $articlesCount }}</li>
            <li>Total Issues: {{ $issuesCount }}</li>
        </ul>
    </div>

    <!-- Manage Articles Section -->
    <div class="section">
        <h2>Manage Articles</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Theme</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->theme->name }}</td>
                    <td>
                        <form action="articles/{{ $article->id }}/publish" method="POST">
                            @csrf
                            <select name="issue_id" required>
                                @foreach($issues as $issue)
                                    <option value="{{ $issue->id }}">{{ $issue->title }}</option>
                                @endforeach
                            </select>
                            <button class="activate" type="submit">Publish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add User Section -->
    <div class="section">
        <h2>Add New User</h2>
        <form action="users/add" method="POST" class="form-inline">
            @csrf
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="Guest">Guest</option>
                <option value="Subscriber">Subscriber</option>
                <option value="Theme Manager">Theme Manager</option>
                <option value="Editor">Editor</option>
            </select>
            <button type="submit">Add User</button>
        </form>
    </div>


    <!-- Manage Users Section -->
    <div class="section">
        <h2>Manage Users</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="/editor/users/{{ $user->id }}/change-role" method="POST" class="form-inline">
                            @csrf
                            <select name="role" required onchange="toggleThemeField(this, {{ $user->id }})">
                                <option value="Guest" {{ $user->role === 'Guest' ? 'selected' : '' }}>Guest</option>
                                <option value="Subscriber" {{ $user->role === 'Subscriber' ? 'selected' : '' }}>Subscriber</option>
                                <option value="Theme Manager" {{ $user->role === 'Theme Manager' ? 'selected' : '' }}>Theme Manager</option>
                                <option value="Editor" {{ $user->role === 'Editor' ? 'selected' : '' }}>Editor</option>
                            </select>
                            <!-- Conteneur du champ de sélection des thèmes -->
                            <div id="theme-field-{{ $user->id }}" style="display: {{ $user->role === 'Theme Manager' ? 'block' : 'none' }};">
                                <select name="theme_id" required>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="edit" type="submit">Change Role</button>
                        </form>
                    </td>
                    <td>{{ $user->is_active ? 'Active' : 'Blocked' }}</td>
                    <td class="actions">
                        <form action="/editor/users/{{ $user->id }}/toggle" method="POST" style="display: inline;">
                            @csrf
                            <button class="{{ $user->is_active ? 'deactivate' : 'activate' }}">
                                {{ $user->is_active ? 'Block' : 'Unblock' }}
                            </button>
                        </form>
                        <form action="/editor/users/{{ $user->id }}/delete" method="POST" style="display: inline;">
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


    <!-- Add Issue Section -->
    <div class="section">
        <h2>Add New Issue</h2>
        <form action="issues/add" method="POST" class="form-inline">
            @csrf
            <input type="text" name="title" placeholder="Issue Title" required>
            <input type="text" name="description" placeholder="Issue description" required>
            <button type="submit">Add Issue</button>
        </form>
    </div>

    <!-- Manage Issues Section -->
    <div class="section">
        <h2>Manage Issues</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Published</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td>
                        {{ $issue->published_at ? Carbon::parse($issue->published_at)->format('d M Y') : 'Not Published' }}
                    </td>
                    <td>{{ $issue->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="actions">
                        <form action="editor/issues/{{ $issue->id }}/toggle" method="POST" style="display: inline;">
                            @csrf
                            <button class="{{ $issue->is_active ? 'deactivate' : 'activate' }}">
                                {{ $issue->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
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
<script>
    /**
     * Affiche ou masque le champ "theme_id" selon la sélection du rôle.
     * @param {HTMLSelectElement} select - Le menu déroulant des rôles.
     * @param {Number} userId - L'ID de l'utilisateur pour gérer le champ correspondant.
     */
    function toggleThemeField(select, userId) {
        const themeField = document.getElementById(`theme-field-${userId}`);
        if (select.value === "Theme Manager") {
            themeField.style.display = "block";
        } else {
            themeField.style.display = "none";
        }
    }
</script>
</body>
</html>
