<script setup>
import ChevDown from '@/Components/Icons/ChevDown.vue';
import { avatar } from '@/util';

const props = defineProps({
    showEmail: {
        default: false,
    },
    imgClass: {
        default: 'w-8 h-8',
    },
    nameClass: {
        default: '',
    },
    emailClass: {
        default: 'text-xs',
    },
    class: {
        default: 'space-x-1',
    },
});
</script>

<template>
    <button
        type="button"
        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-900 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
        :class
    >
        <img
            class="rounded-full"
            :src="$page.props.auth.user?.avatar || avatar"
            alt="Rounded avatar"
            :class="imgClass"
        />

        <section class="text-start space-y-1 hidden sm:block">
            <div class="capitalize" :class="nameClass">
                {{ $page.props.auth.user?.name }}
            </div>
            <div
                v-if="showEmail"
                class="text-gray-500 font-normal font-inter"
                :class="emailClass"
            >
                {{ $page.props.auth.user?.email }}
            </div>
        </section>

        <ChevDown v-if="!showEmail" />
    </button>
</template>
