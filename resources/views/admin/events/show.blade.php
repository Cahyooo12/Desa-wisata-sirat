<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 text-sm text-gray-500">
                            <div>
                                <span class="font-bold block">Date & Time:</span>
                                {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }} at {{ $event->time }}
                            </div>
                            <div>
                                <span class="font-bold block">Location:</span>
                                {{ $event->location }}
                            </div>
                        </div>
                        
                        <h3 class="text-lg font-bold mb-2">Description</h3>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit Event</a>
                        <a href="{{ route('admin.events.index') }}" class="text-gray-600 hover:text-gray-800">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
