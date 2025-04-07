<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-500 text-center mb-4">Username already exists</p>
        <?php endif; ?>
        <form method="POST" action="process.php">
            <div class="mb-4">
                <input type="text" name="username" placeholder="Username" required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <input type="password" name="password" placeholder="Password" required
                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" name="register"
                class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Register
            </button>
        </form>
        <p class="mt-4 text-center">Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
    </div>
</body>
</html>