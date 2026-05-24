<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>{{ $title ?? 'Bank Account Management' }}</title>
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">
                    Bank Account Management
                </h1>

                <nav class="flex gap-4">
                    <a href="{{ route('accounts.index') }}"
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Account List
                    </a>

                    <a href="{{ route('accounts.create') }}"
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Create Account
                    </a>
                </nav>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-6 py-8">
            @if (session('success'))
                <div class="mb-5 rounded border border-green-300 bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 rounded border border-red-300 bg-red-100 px-4 py-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>
</html>