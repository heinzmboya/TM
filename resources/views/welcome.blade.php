<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-white text-gray-900">
        <!-- BaseHeader Component -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <svg class="block h-9 w-auto text-gray-800" width="32" height="32" viewBox="0 0 32 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M27.3333 9.70381L16 16.0002M16 16.0002L4.66663 9.70381M16 16.0002V28.6668M28 21.4115V10.5887C28 10.1319 28 9.90347 27.9327 9.69973C27.8732 9.51949 27.7757 9.35405 27.6472 9.21447C27.5017 9.05668 27.3021 8.94575 26.9027 8.72388L17.036 3.2424C16.6579 3.03232 16.4688 2.92728 16.2687 2.88609C16.0913 2.84965 15.9087 2.84965 15.7315 2.88609C15.5312 2.92728 15.3421 3.03232 14.964 3.2424L5.09729 8.72388C4.69793 8.94575 4.49825 9.05668 4.35284 9.21447C4.22421 9.35405 4.12687 9.51949 4.06731 9.69973C4 9.90347 4 10.1319 4 10.5887V21.4115C4 21.8684 4 22.0968 4.06731 22.3006C4.12687 22.4808 4.22421 22.6463 4.35284 22.7858C4.49825 22.9436 4.69793 23.0546 5.09729 23.2764L14.964 28.7579C15.3421 28.968 15.5312 29.073 15.7315 29.1142C15.9087 29.1507 16.0913 29.1507 16.2687 29.1142C16.4688 29.073 16.6579 28.968 17.036 28.7579L26.9027 23.2764C27.3021 23.0546 27.5017 22.9436 27.6472 22.7858C27.7757 22.6463 27.8732 22.4808 27.9327 22.3006C28 22.0968 28 21.8684 28 21.4115Z"
                                stroke="#3C62D4" stroke-width="2.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-1.5 sm:flex">
                        <p class="font-semibold text-2xl text-primary-600 border-transparent">
                            TaskManager
                        </p>
                    </div>
                </div>

                <!-- slot -->
                <header>
                    @if($canLogin)
                        <nav class="-mx-3 flex flex-1 justify-end gap-x-3">
                            @auth
                                <a href="{{ route('dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}">
                                    <button type="button"
                                        class="py-3 px-4 text-sm font-medium rounded-md bg-black text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Log in
                                    </button>

                                </a>
                                @if($canRegister)
                                    <a href="{{ route('register') }}">
                                        <button type="button"
                                            class="py-3 px-4 text-sm font-medium rounded-md bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                                            Get started
                                        </button>

                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>
                <!-- \slot -->
            </div>
        </div>

        <!-- body -->
        <div class="min-h-screen ">
            <div class="">
                <main class="mt-6  flex">
                    <section class="w-1/2  px-20 ml-5">
                        <p class="font-bold text-[72px]">
                            Simplify Your Workflow with TaskManager
                        </p>

                        <p class="font-inter text-gray-500 text-xl mt-4 mb-6">
                            Welcome to TaskManager, your ultimate solution for efficient task management. Designed for
                            individuals, TaskManager streamlines your projects, deadlines, and daily to-dos with
                            intuitive features and seamless integration. Boost your productivity, stay organized, and
                            achieve more with less effort. Try TaskManager today and transform the way you work!
                        </p>


                        <button type="button"
                            class="py-4 px-6 text-lg font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none">
                            Get started
                        </button>
                    </section>
                    <section class="w-1/2  relative">
                        <img class="w-full h-full object-cover absolute -right-50" src="/images/group.png" alt="Logo" />
                    </section>
                </main>

                <footer class="py-6 text-sm px-24 text-gray-500 font-medium">
                &#169; TaskManager 2024
                </footer>
            </div>
        </div>
    </div>

    <!-- @vite('resources/js/app.js') -->
</body>

</html>