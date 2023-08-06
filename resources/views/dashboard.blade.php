<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2">
                <div class="p-4 bg-white transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col space-y-2">
                            <h3 class="text-lg text-gray-400">Total Authors</h3>
                            <span class="text-2xl font-semibold">{{ $totalAuthors }}</span>
                        </div>
                        <div class="p-10 bg-gray-200 rounded-md"></div>
                    </div>
                </div>

                <div class="p-4 bg-white transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                    <div class="flex items-start justify-between">
                        <div class="flex flex-col space-y-2">
                            <h3 class="text-lg text-gray-400">Total Books</h3>
                            <span class="text-2xl font-semibold">{{ $totalBooks }}</span>
                        </div>
                        <div class="p-10 bg-gray-200 rounded-md"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
