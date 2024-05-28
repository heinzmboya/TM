<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import UserCard from "@/Components/UserCard.vue";
import Analytics from "@/Components/Analytics.vue";
import ChevDown from "@/Components/Icons/ChevDown.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="space-y-8">
            <!-- <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </template> -->
            <section class="flex justify-between">
                <UserCard
                    :showEmail="true"
                    imgClass="w-[72px] h-[72px]"
                    nameClass="font-semibold text-xl"
                    emailClass="text-base"
                    class="space-x-2 pl-0"
                />

                <Analytics />
            </section>

            <!-- todos -->
            <section class="flex justify-between items-center">
                <p class="text-[32px] font-bold text-gray-900">Todos</p>

                <button
                    type="button"
                    class="text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none"
                >
                    + Add todo
                </button>
            </section>

            <!-- input -->
            <section class="flex gap-x-4">
                <div class="relative w-full">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none"
                    >
                        <SearchIcon />
                    </div>

                    <input
                        type="text"
                        class="border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                        placeholder="Search todos..."
                    />
                </div>

                <BaseDrop :isStatus="true" width="w-[191px]" />
                <BaseDrop />
            </section>
        </div>
    </AuthenticatedLayout>
</template>
