<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
    <title>LaraTask</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Set the initial opacity of the container to 0
            const container = document.querySelector(".anime");
            container.style.opacity = 0;

            // Fade in the container after 1 second
            setTimeout(function () {
                container.style.transition = "opacity 1s";
                container.style.opacity = 1;
            }, 1000);
        });
    </script>
</head>

<body class="anime">
    <div class=" absolute top-0 z-10 w-full">
        @if (Route::has('login'))
        <div class="px-5 py-4 flex text-white absolute right-0">
            @auth
            <!-- <a href="{{ url('/dashboard') }}"
                class="font-semibold dark:text-white text-white dark:hover:text-slate:300 hover:text-slate:300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a> -->
            <a href="{{ url('/tasks') }}"
                class="font-semibold dark:text-white text-white dark:hover:text-slate:300 hover:text-slate:300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 font-bold text-2xl">Task</a>
                <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout') " class="text-5xl font-semibold dark:text-white text-white dark:hover:text-slate:300 hover:text-slate:300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                @else
            <a href="{{ route('login') }}"
                class="font-semibold dark:text-white text-white dark:hover:text-slate:300 hover:text-slate:300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 font-semibold dark:text-white text-white dark:hover:text-slate:300 hover:text-slate:300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>
    <div id="particles-js"
        class="antialiased container bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="absolute flex items-center justify-center text-center">
            <div class="text-gray-600 dark:text-gray-400">

                <h1 class="text-5xl md:text-7xl text-white font-bold mb-6">
                    Welcome to LaraTask!
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Manage tasks seamlessly and hasstle free.
                </p>
            </div>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .container {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        h1 {
            font-size: 2.5em;
            color: #333;
        }

        p {
            font-size: 1.2em;
            color: #666;
        }

        .cta-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            font-size: 1.2em;
            cursor: pointer;
        }

        .cta-button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        particlesJS("particles-js", { 
            "particles": { 
                "number": { 
                    "value": 150, 
                    "density": { 
                        "enable": true, 
                        "value_area": 800 
                    } 
                }, 
                "color": { 
                    "value": "#3a5a77" 
                    // "value": "#ffffff" 
                }, 
                "shape": { 
                    "type": "circle", 
                    "stroke": { 
                        "width": 0, 
                        "color": "#000000" 
                    }, 
                    "polygon": { 
                        "nb_sides": 5 
                    }, 
                    "image": { 
                        "src": "img/github.svg", 
                        "width": 100, 
                    } 
                }, "opacity": { 
                    "value": 0.5, 
                    "random": false, 
                    "anim": { 
                        "enable": false, 
                        "speed": 1, 
                        "opacity_min": 0.1, 
                        "sync": false 
                    } 
                }, 
                "size": { 
                    "value": 3, 
                    "random": true, 
                    "anim": { 
                        "enable": false, 
                        "speed": 40, 
                        "size_min": 0.1, 
                        "sync": false 
                    } 
                },
                "line_linked": { 
                    "enable": true, 
                    "distance": 150, 
                    "color": "#ffffff", 
                    "opacity": 0.4, 
                    "width": 1 
                }, 
                "move": { 
                    "enable": true, 
                    "speed": 4, 
                    "direction": "none", 
                    "random": false, 
                    "straight": false, 
                    "out_mode": "out", 
                    "bounce": false, 
                    "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": true, "mode": "repulse" }, "onclick": { "enable": true, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true });

        update = function () {
            stats.begin();
            stats.end();
            if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
                count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
            }
            requestAnimationFrame(update);
        };
        requestAnimationFrame(update);;
    </script>
</body>

</html>