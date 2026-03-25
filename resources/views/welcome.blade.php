<x-guest-layout>
    <div class="max-w-md mx-auto p-6">
        <h1 class="text-xl font-semibold text-gray-900">
            Welcome
        </h1>

        <p class="mt-4 text-sm text-gray-600">
            ログインして掲示板を見てください。
        </p>

        <div class="mt-6 flex items-center gap-3">
            <a
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                href="{{ route('login') }}"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <a
                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-900 rounded-md hover:bg-gray-200"
                    href="{{ route('register') }}"
                >
                    Register
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>