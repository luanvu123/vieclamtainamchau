<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Employer Portal</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --error-color: #ef4444;
            --text-color: #1f2937;
            --border-color: #e5e7eb;
            --background-color: #f3f4f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.5;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .employer-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navigation */
        .employer-nav {
            background-color: white;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand .logo {
            height: 40px;
            width: auto;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
        }

        .btn-register {
            background-color: var(--primary-color);
            color: white !important;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s;
        }

        .btn-register:hover {
            background-color: var(--secondary-color);
        }

        /* Main Content */
        .employer-main {
            flex: 1;
            padding: 2rem;
        }

        /* Auth Container */
        .auth-container {
            max-width: 32rem;
            margin: 0 auto;
            padding: 1rem;
        }

        .auth-card {
            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .auth-card h1 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--text-color);
        }

        /* Form Styles */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 500;
            color: var(--text-color);
        }

        .form-group input {
            padding: 0.625rem;
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: -2px;
        }

        .remember-me {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .error {
            color: var(--error-color);
            font-size: 0.875rem;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
        }

        .auth-links {
            margin-top: 1.5rem;
            text-align: center;
        }

        .auth-links a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .auth-links a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.875rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        /* Footer */
        .employer-footer {
            background-color: white;
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid var(--border-color);
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .employer-nav {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                width: 100%;
                justify-content: center;
            }

            .auth-container {
                padding: 0.5rem;
            }

            .auth-card {
                padding: 1.5rem;
            }

            .remember-me {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }

        /* Logout Form */
        .logout-form {
            margin: 0;
            padding: 0;
        }

        .logout-form button {
            background: none;
            border: none;
            color: var(--text-color);
            font-weight: 500;
            cursor: pointer;
            font-size: 1rem;
            padding: 0;
        }

        .logout-form button:hover {
            color: var(--primary-color);
        }
    </style>

</head>

<body>
    <div class="employer-container">
       

        <main class="employer-main">
            @yield('content')
        </main>

        <footer class="employer-footer">
            <p>&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
