<x-app-layout>
    <div class="w-full">
        <div class="mx-auto w-[1200px]">
            <form action="/category/add" method="post" class="my-4 flex gap-4 flex-wrap">
                @csrf
                <input type="text" name="category" id="category"
                    class="flex-1 p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Add Category" required>
                <button type="submit"
                    class="w-28 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
            </form>
            <div>
                <p class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Categories:</p>
                <div class="flex gap-4 justify-start items-center">
                    @foreach($categories as $category)
                    <form action="{{ url('/category/delete/'.$category->category_id) }}" method="post"
                        class="flex justify-between items-center px-4 py-2 rounded-md shadow-md shadow-slate-800  gap-4">
                        @csrf
                        @method('DELETE')
                        <p class="text-gray-400">{{ $category->category_name }}</p>
                        <button type="submit"
                            class="text-red-700 hover:text-red-800 focus:text-red-900 font-medium rounded-lg text-md p-2 dark:text-red-500 dark:hover:text-red-600 dark:focus:text-red-700">X</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>