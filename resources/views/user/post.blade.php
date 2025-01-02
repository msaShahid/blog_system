<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Post Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Create Post Button -->
                    <button id="createPostBtn" class="bg-blue-500 text-white py-2 px-4 rounded-md mb-4">
                        Create Post
                    </button>
                    <hr>
                    <!-- Table for List (you can add your actual posts table here) -->
                    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                        <table class="min-w-full table-auto text-left">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Content</th>
                                    <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Author</th>
                                    <th class="px-6 py-3 text-sm font-medium uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900">
                                @foreach($posts as $post)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm">{{ $post->title }}</td>
                                        <td class="px-6 py-4 text-sm">{{ Str::limit($post->content, 50) }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $post->author->name }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex space-x-4">
                                                <a href="{{ route('post.edit', $post->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">Edit</a>
                        
                                                <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 ease-in-out">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--  (Modal Form) -->
    <div id="createPostModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-1/2">
            <h3 class="text-lg font-semibold mb-4">Create New Post</h3>
    
            <form id="createPostForm">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title of the post</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Write Content</label>
                    <textarea id="content" name="content" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required></textarea>
                </div>
    
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Save</button>
                
            </form>    
            <button id="closeModalBtn" class="mt-2 bg-black text-white py-2 px-4 rounded-md">Close</button>   
        </div>
    </div>
    
    <script>

        const createPostBtn = document.getElementById('createPostBtn');
        const createPostModal = document.getElementById('createPostModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const createPostForm = document.getElementById('createPostForm');
    
        createPostBtn.addEventListener('click', function() {
            createPostModal.classList.remove('hidden');
        });

        createPostBtn.addEventListener('click', function() {
            createPostModal.classList.remove('hidden');
        });
    
        closeModalBtn.addEventListener('click', function() {
            createPostModal.classList.add('hidden');
        });
    
        createPostForm.addEventListener('submit', function(event) {
            event.preventDefault();
    
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
    
            fetch('/user/post', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    title: title,
                    content: content
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Post created:', data);
                createPostModal.classList.add('hidden');
                createPostForm.reset();
                window.location.reload();
            })
            .catch(error => {
                console.error('Error creating post:', error);
            });
        });
    </script>
    
</x-app-layout>
