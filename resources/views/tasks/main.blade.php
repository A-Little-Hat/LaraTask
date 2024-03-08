<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl min-h-80 pt-5 mx-auto lg:px-8 dark:bg-gray-800">
            <div class="p-5 border border-gray-200 rounded-lg mb-5">
                <p class="mb-2  tracking-tight text-gray-900">
                    <span class="text-2xl dark:text-white font-bold" >Title: </span><span class="text-xl font-thin dark:text-slate-500" >{{ $task[0]->title }}</span>
                </p>
                <p class="mb-2  tracking-tight text-gray-900">
                <span class="text-xl dark:text-white font-bold" >Description: </span><span class="text-xl font-thin dark:text-slate-500" > {{ $task[0]->description }} </span>
                </p>
                <p class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                <span class="text-xl dark:text-white font-bold" >Due Date: </span><span class="text-xl font-thin dark:text-slate-500" >{{ $task[0]->due_date }}</span>
                </p>
                <div class="mb-2 ">
                <span class="text-xl dark:text-white font-bold" > Assigned People:</span>
                    @foreach(json_decode($task[0]->assigned) as $assign)
                    <p class="text-xl font-thin dark:text-slate-500" >
                        &#8226; {{ $assign }}
                    </p>
                    @endforeach
                </div>
                <div class="mb-2 ">
                <span class="text-xl dark:text-white font-bold" > Category:</span>
                    @foreach(json_decode($task[0]->category) as $category)
                        <p class="text-xl font-thin dark:text-slate-500" >
                            &#8226; {{ $category }}
                        </p>
                    @endforeach
                </div>
                @auth
                @if(auth()->user()->id == $task[0]->id || auth()->user()->role == 'admin')
                <div class="flex">
                    <form class="mx-5" action="{{ url('/tasks/edit/'.$task[0]->task_id) }}">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            UPDATE
                        </button>
                    </form>
                    <form class="mx-5" action="{{ url('/tasks/delete/'.$task[0]->task_id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            DELETE
                        </button>
                    </form>
                </div>
                @elseif(in_array(auth()->user()->name,json_decode($task[0]->assigned)))
                <div>
                    <form action="{{ url('/tasks/update/status/'.$task[0]->task_id) }}" method="get">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            UPDATE
                        </button>
                    </form>
                </div>
                @endif
                @endauth
            </div>
            <div class="mt-5 flex gap-4 ">
                <div class="flex-1">
                    <section class="w-full mb-5 border-2 border-sky-500 rounded-lg p-5">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Comments</h2>
                        </div>
                        <div class="h-64 overflow-y-auto">
                            @foreach($comments as $comment)
                            <article
                                class="p-4 mb-4 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p
                                            class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                            {{$comment->author}}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate
                                                datetime="2022-02-08"
                                                title="February 8th, 2022">{{$comment->created_at}}</time></p>
                                    </div>
                                </footer>
                                <p class="text-gray-500 dark:text-gray-400">{{$comment->body}}</p>
                            </article>
                            @endforeach
                        </div>
                        @if(in_array(auth()->user()->name,json_decode($task[0]->assigned)) || auth()->user()->role ==
                        'admin' || auth()->user()->id == $task[0]->id)
                        <form class="mt-4" action="{{ url('/comment/add/'.$task[0]->task_id) }}" method="post">
                            @csrf
                            <textarea name="body" id="comment" cols="30" rows="3"
                                class="block text-black w-full p-2.5 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write a comment..." required></textarea>
                            <button type="submit"
                                class="block w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2">Comment</button>
                        </form>
                        @endif
                    </section>
                </div>
                <div class="flex-1 flex flex-col gap-4">
                    <div class="bg-white p-5 rounded-lg shadow-lg">
                        @foreach($documents as $doc)
                        <div class="flex items-center mb-4 justify-between">
                            <span class="text-gray-700 w-56 truncate">{{ preg_replace('/^documents\/'.$task[0]->task_id.'\//', '',
                                $doc) }}</span>
                            <div class="flex gap-2">
                                <a href="{{ url('/file/download/'.$task[0]->task_id.'/'.preg_replace('/^documents\/'.$task[0]->task_id.'\//', '', $doc)) }}"
                                    class="text-blue-700 hover:text-blue-800 focus:text-blue-900 ml-2 font-medium rounded-lg text-sm px-5 py-1.5 dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-700">Download</a>
                                <a href="{{ url('/file/delete/'.$task[0]->task_id.'/'.preg_replace('/^documents\/'.$task[0]->task_id.'\//', '', $doc)) }}"
                                    class="text-red-700 hover:text-red-800 focus:text-red-900 ml-2 font-medium rounded-lg text-sm px-5 py-1.5 dark:text-red-500 dark:hover:text-red-600 dark:focus:text-red-700">Delete</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-lg">
                        <form action="{{ url('/file/upload/'.$task[0]->task_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="document"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <button type="submit"
                                class="block w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-2">Upload
                                Document</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>