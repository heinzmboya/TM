<script setup>
import { computed, ref } from 'vue';
import ChevUp2 from '@/Components/Icons/ChevUp2.vue';
import Equal from '@/Components/Icons/Equal.vue';
import ChevDown from '@/Components/Icons/ChevDown.vue';

const emit = defineEmits(['update']);

const props = defineProps({
    type: {
        default: 'priority',
    },
    isStatus: {
        default: false,
    },
    value: {
        default: null,
    },
    class: {
        default: 'space-x-2 px-4 py-2',
    },
});

const priorities = [
    {
        value: 'all',
    },
    { value: 'highest', icon: ChevUp2 },
    { value: 'high', icon: ChevDown, class: '!stroke-red-600 rotate-180' },
    { value: 'medium', icon: Equal },
    {
        value: 'low',
        icon: ChevDown,
        class: '!stroke-blue-600',
    },
    { value: 'lowest', icon: ChevUp2, class: '!stroke-blue-600 rotate-180' },
];

const statuses = [
    {
        value: 'all',
    },
    { value: 'pending', class: 'bg-amber-400' },
    { value: 'backlog', class: 'bg-gray-500' },
    { value: 'complete', class: 'bg-success-600' },
];

const selectedStatus = ref('All');
const selectedPriority = ref('All');

const basedropItem = computed(() =>
    props.isStatus
        ? {
              title: 'status',
              selection: selectedStatus.value,
              items: statuses.filter((e) =>
                  !props.value ? e : e.value === props.value
              ),
          }
        : {
              title: 'priority',
              selection: selectedPriority.value,
              items: priorities.filter((e) =>
                  !props.value ? e : e.value === props.value
              ),
          }
);

function onClick(item) {
    if (props.value) return;
    console.log(item.value);
    props.isStatus
        ? (selectedStatus.value = item.value)
        : (selectedPriority.value = item.value);

    emit('update', item.value);
}
</script>

<template>
    <div
        v-for="pr in basedropItem.items"
        :key="pr.value"
        class="flex items-center text-start text-sm leading-5 text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out font-inter cursor-default"
        :class
        @click="onClick(pr)"
    >
        <div
            v-if="isStatus && pr.class"
            class="px-2 py-1 rounded-[198px]"
            :class="pr.class"
        ></div>
        <component v-if="pr.icon" :is="pr.icon" :class="pr.class" />
        <span class="capitalize">{{ pr.value }}</span>
    </div>
</template>
