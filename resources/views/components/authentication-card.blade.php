<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white-100 dark:bg-white-900">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
