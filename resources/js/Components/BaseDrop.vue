<script setup>
import ChevDown from '@/Components/Icons/ChevDown.vue';

const props = defineProps({
    isStatus: {
        default: false,
    },
    width: {
        default: 'md:w-[195px] w-full',
    },
    addModalLabel: {
        default: '',
    },
});

const selectedItem = defineModel();

function onUpdate(item) {
    selectedItem.value = item;
}
</script>

<template>
    <Dropdown
        align="right"
        width="48"
        wrapperClass="border border-gray-200"
        :class="width"
    >
        <template #trigger>
            <button
                type="button"
                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                :class="width"
            >
                <!-- addModalLabel from addtodo modal -->
                <span
                    class="w-full text-start text-gray-900"
                    v-if="addModalLabel && !selectedItem"
                >
                    {{ addModalLabel }}
                </span>

                <template v-else>
                    <span class="capitalize"
                        >{{ isStatus ? 'Status' : 'Priority' }}:</span
                    >

                    <BaseIndicator
                        :isStatus
                        :value="selectedItem"
                        class="space-x-1 hover:bg-transparent w-full"
                    />
                </template>
                <ChevDown class="flex-shrink-0" />
            </button>
        </template>

        <template #content>
            <BaseIndicator @update="onUpdate" :isStatus />
        </template>
    </Dropdown>
</template>
