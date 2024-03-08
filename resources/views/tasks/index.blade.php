<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-8 min-h-full dark:bg-gray-800">
            <div class="p-6 text-3xl text-gray-900 dark:text-gray-100">
                Welcome @auth {{Auth::user()->name}} @if(Auth::user()->role=='admin') (Admin) @endif @endauth
            </div>
            <form action="/tasks/create">
                <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Add Task
                </button>
            </form>
            <div>
                <input type="text" name="search" id="searchText">
                <select name="status" id="status">
                    <option value="" selected>Select status</option>
                    <option value="pending">pending</option>
                    <option value="in_progress">in_progress</option>
                    <option value="completed">completed</option>
                </select>
                <select name="category" id="category">
                    <!-- category -->
                </select>
                <span>From</span>
                <input type="datetime-local" name="date" id="from">
                <span>to</span>
                <input type="datetime-local" name="date" id="to">
                <button id="searchBTN">search</button>
            </div>
            <div class="flex pb-5  flex-wrap shadow-sm  sm:rounded-lg" id="taskDiv">
                <!-- tasks -->
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">
    let data = []
    let renderData = []
    let categoryData = []

    fetch('/category/all')
        .then(res => res.json())
        .then(res2 => {
            let catRenData = `<option value="" selected>Select Category</option>`
            res2.map(e => {
                categoryData.push(e['category_name'])
                catRenData += `<option value="${e['category_name']}">${e['category_name']}</option>`
            })
            document.getElementById('category').innerHTML = catRenData
            // console.log(categoryData)
        })
    fetch('/tasks/all')
        .then(res => res.json())
        .then(res2 => {
            data = res2
            renderData = res2
            // console.log(data)
            renderTask()
        })

    const renderTask = () => {
        const taskDiv = document.getElementById('taskDiv')
        let renderText = ''
        renderData==[]?renderText='': renderData.map(task => {
            
            let catText = ''
            JSON.parse(task['assigned']).map((e) => {
                    catText += `<p class="font-normal text-gray-700 dark:text-gray-400">
                                &#8226 ${e}
                              </p>`
            })
            // console.log({catText})
            renderText += `
            <div class="block  min-w-sm p-6 m-5 border border-gray-200 rounded-lg shadow dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-gray-700">
                <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    ${task['title']}
                </span>
                <h3 class="mb-2 tracking-tight text-gray-900 dark:text-white">
                    ${task['description']}
                </h3>
                <div class="mb-5">
                    <h1 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Assigned People:</h1>
                    ${catText}
                </div>
                <a href='/tasks/view/${task['id']}' >
                    <button type="button" class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        View Details
                    </button>
                </a>
            </div>
            `
        })
        taskDiv.innerHTML = renderText
    }

    document.getElementById('searchBTN').addEventListener('click', (e) => {
        e.preventDefault()
        const from = document.getElementById('from').value
        console.log({from})
        const to = document.getElementById('to').value
        console.log({to})
        const query = document.getElementById('searchText').value
        const status = document.getElementById('status').value
        const category = document.getElementById('category').value
        let queryRes = data.filter(item =>
            item.title.toLowerCase().includes(query.toLowerCase()) ||
            item.description.toLowerCase().includes(query.toLowerCase())
        );
        let statusRes = status=== '' ? queryRes: queryRes.filter(item=>item.status===status)
        let categoryRes = category=== '' ? statusRes: statusRes.filter(item=>JSON.parse(item.category).includes(category))
        let fromRes = from==='' ? categoryRes : categoryRes.filter(item=>item.due_date>from)
        let toRes = to==='' ? fromRes : categoryRes.filter(item=>item.due_date<to)
        renderData=toRes
        renderTask()
    })
</script>