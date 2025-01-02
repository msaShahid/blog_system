<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                    <form action="{{ route('post.update', $post->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input 
                                id="title" 
                                class="block mt-1 w-full sm:w-1/2 md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                type="text" 
                                name="title" 
                                value="{{ $post->title }}"
                                required 
                                autofocus 
                                placeholder="Enter the title"
                                aria-required="true" 
                            />
                        </div>
                    
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea 
                                id="content" 
                                class="block mt-1 w-full sm:w-1/2 md:w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                name="content" 
                                required 
                                placeholder="Enter the content"
                                rows="5"
                                aria-required="true"
                            >{{ $post->content }}"</textarea>
                        </div>
                    
                        <div class="flex justify-start">
                            <button type="submit" class="px-2 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Submit
                            </button>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
        
</x-app-layout>
