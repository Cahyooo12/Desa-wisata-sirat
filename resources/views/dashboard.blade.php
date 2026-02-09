<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">{{ __("You're logged in!") }}</h3>
                    
                    @if(Auth::user()->is_admin)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                            <a href="{{ route('admin.products.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 transition">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Manage Products</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400 text-center">Add, Edit, and Delete Products</p>
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 transition">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Manage Orders</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400 text-center">View and Update Orders Status</p>
                            </a>
                            <a href="{{ route('admin.articles.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 transition">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Manage Articles</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400 text-center">Manage News and Stories</p>
                            </a>
                            <a href="{{ route('admin.events.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 transition">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">Manage Events</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400 text-center">Manage Village Events</p>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
