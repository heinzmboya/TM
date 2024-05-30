<script setup>
const model = defineModel();
</script>

<template>
    <div class="relative w-full">
        <div
            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none"
        >
            <SearchIcon />
        </div>

        <input
            v-model="model"
            type="text"
            class="border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
            placeholder="Search todos..."
        />
    </div>
</template>
