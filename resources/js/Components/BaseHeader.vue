<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    hideUserCard: {
        default: false,
    },
});
</script>

<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo class="block h-9 w-auto" />
                    </Link>
                </div>

                <Link
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    class="font-semibold !text-[20px] text-primary-600 border-transparent ml-2"
                >
                    TaskManager
                </Link>
            </div>

            <UserMenu v-if="!hideUserCard" />
        </div>
    </div>
</template>
