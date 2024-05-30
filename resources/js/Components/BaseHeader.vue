<script setup>
import { Link } from '@inertiajs/vue3';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    type: {
        default: 'priority',
    },
});
</script>

<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo
                            class="block h-9 w-auto"
                        />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-1.5 sm:flex">
                    <NavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="font-semibold !text-[20px] text-primary-600 border-transparent"
                    >
                        TaskManager
                    </NavLink>
                </div>
            </div>

            <!-- usermenu -->
            <!-- Hamburger -->
            <slot />
        </div>
    </div>
</template>
