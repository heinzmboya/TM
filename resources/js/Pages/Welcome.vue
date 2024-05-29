<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

// function handleImageError() {
//     document.getElementById('screenshot-container')?.classList.add('!hidden');
//     document.getElementById('docs-card')?.classList.add('!row-span-1');
//     document.getElementById('docs-card-content')?.classList.add('!flex-row');
//     document.getElementById('background')?.classList.add('!hidden');
// }
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-white text-gray-900">
        <BaseHeader>
            <header class="">
                <nav
                    v-if="canLogin"
                    class="-mx-3 flex flex-1 justify-end gap-x-3"
                >
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link :href="route('login')">
                            <Btn class="bg-black !font-medium">Log in</Btn>
                        </Link>

                        <Link v-if="canRegister" :href="route('register')">
                            <Btn class="!font-medium">Get started</Btn>
                        </Link>
                    </template>
                </nav>
            </header>
        </BaseHeader>

        <div class="min-h-screen bbd">
            <div class="bbd">
                <main class="mt-6 bbd flex">
                    <section class="w-1/2 bbd px-20">
                        <p class="font-bold text-[72px]">
                            Simplify Your Workflow with TaskManager
                        </p>

                        <p class="font-inter text-gray-500 text-xl mt-4 mb-6">
                            Welcome to TaskManager, your ultimate solution for
                            efficient task management. Designed individuals,
                            TaskManager streamlines your projects, deadlines,
                            and daily to-dos with intuitive features and
                            seamless integration. Boost your productivity, stay
                            organized, and achieve more with less effort. Try
                            TaskManager today and transform the way you work!
                        </p>

                        <Btn class="rounded-lg py-4 px-6 text-lg !font-medium"
                            >Get Started</Btn
                        >
                    </section>
                    <section class="w-1/2 bbd relative">
                        <img
                            class="w-full h-full object-cover absolute -right-50"
                            src="/images/group.png"
                            alt="Logo"
                        />
                    </section>
                </main>

                <footer class="py-6 text-sm text-black px-20">
                    TaskManager 2024
                </footer>
            </div>
        </div>
    </div>
</template>
