<script setup>
import ChevDown from "@/Components/Icons/ChevDown.vue";

const props = defineProps({
    showEmail: {
        default: false,
    },
    imgClass: {
        default: "w-8 h-8",
    },
    nameClass: {
        default: "",
    },
    emailClass: {
        default: "text-xs",
    },
    class: {
        default: "space-x-1",
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
            src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80"
            alt="Rounded avatar"
            :class="imgClass"
        />

        <section class="text-start space-y-1">
            <div class="capitalize" :class="nameClass">
                {{ $page.props.auth.user.name }}
            </div>
            <div
                v-if="showEmail"
                class="text-gray-500 font-normal font-inter"
                :class="emailClass"
            >
                {{ $page.props.auth.user.email }}
            </div>
        </section>

        <ChevDown v-if="!showEmail" />
    </button>
</template>
