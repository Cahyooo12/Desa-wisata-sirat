<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        @if($article->image)
                            <img src="{{ asset($article->image) }}" class="w-full h-64 object-cover rounded mb-4" alt="{{ $article->title }}">
                        @endif
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <span class="mr-4">Category: {{ $article->category }}</span>
                            <span>Date: {{ $article->created_at->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Excerpt</h3>
                        <p class="mb-4 text-gray-700">{{ $article->excerpt }}</p>
                        
                        <h3 class="text-lg font-bold mb-2">Content</h3>
                        <div class="prose max-w-none">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit Article</a>
                        <a href="{{ route('admin.articles.index') }}" class="text-gray-600 hover:text-gray-800">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
