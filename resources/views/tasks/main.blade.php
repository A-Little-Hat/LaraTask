<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl min-h-80 pt-5 mx-auto lg:px-8 dark:bg-gray-800">
            <p class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                Title: {{ $task[0]->title }}
            </p>
            <p class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                Description: {{ $task[0]->description }}
            </p>
            <div class="mb-2 text-xl text-gray-700 dark:text-white">
                Assigned People:
                @foreach(json_decode($task[0]->assigned) as $assign)
                <p>
                    &#8226 {{ $assign }}
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
            <div class="mt-5 flex ">
                <div class="flex-w-1/2 ">
                    <section class="w-full mb-5 dark:bg-gray-900 lg:py-16 antialiased">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments</h2>
                        </div>
                        <div class="mx-auto border-2 border-sky-500 overflow-y-auto h-64">
                            @foreach($comments as $comment)
                            <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
                                <footer class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p
                                            class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
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
                        'admin' ||
                        auth()->user()->id == $task[0]->id)
                        <form class="m-6 p-5" action="{{ url('/comment/add/'.$task[0]->task_id) }}" method="post">
                            @csrf
                            <div
                                class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <input id="comment" rows="6"
                                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                    placeholder="Write a comment..." name="body" id="body" required />
                            </div>
                            <div class="flex justify-end px-4">
                                <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500"
                                    value="Comment">
                            </div>
                        </form>
                        @endif
                    </section>
                </div>
                <div class="flex-w-1/2 mx-auto">
                    <div class="text-white" >
                        @foreach($documents as $doc)
                        <div>
                            <span>{{ preg_replace('/^documents\/'.$task[0]->task_id.'\//', '', $doc) }}</span>
                            <a href="{{ url('/file/download/'.$task[0]->task_id.'/'.preg_replace('/^documents\/'.$task[0]->task_id.'\//', '', $doc)) }}"><button>Download File</button></a>
                            <a href="{{ url('/file/delete/'.$task[0]->task_id.'/'.preg_replace('/^documents\/'.$task[0]->task_id.'\//', '', $doc)) }}"><button>Delete File</button></a>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        <form action="{{ url('/file/upload/'.$task[0]->task_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="document">
                            <button type="submit">Upload Document</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>