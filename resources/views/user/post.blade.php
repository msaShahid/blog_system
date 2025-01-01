<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Post') }}
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
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Content</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your posts data here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal (Popup Form) -->
    <div id="createPostModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-md w-96">
            <h3 class="text-lg font-semibold mb-4">Create New Post</h3>
    
            <form id="createPostForm">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required />
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required></textarea>
                </div>
    
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Save</button>
                <button id="closeModalBtn" class="bg-black text-white py-2 px-4 rounded-md">Close</button>
            </form>       
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
    
        closeModalBtn.addEventListener('click', function() {
            createPostModal.classList.add('hidden');
        });
    
        createPostForm.addEventListener('submit', function(event) {
            event.preventDefault();
    
            const title = document.getElementById('title').value;
            const content = document.getElementById('content').value;
           // console.log(title,content);
    
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
            })
            .catch(error => {
                console.error('Error creating post:', error);
            });
        });
    </script>
    
</x-app-layout>
