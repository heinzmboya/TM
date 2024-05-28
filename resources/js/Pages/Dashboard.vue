<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import UserCard from "@/Components/UserCard.vue";
import Analytics from "@/Components/Analytics.vue";
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
            
        </div>
    </AuthenticatedLayout>
</template>
