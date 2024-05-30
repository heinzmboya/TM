<script setup>
import { computed } from 'vue';
import ChevUp2 from '@/Components/Icons/ChevUp2.vue';
import Equal from '@/Components/Icons/Equal.vue';
import ChevDown from '@/Components/Icons/ChevDown.vue';
import { groupBy, priorityEnum } from '@/util';

const props = defineProps({
    data: {
        default: null,
    },
});

const cardItems = computed(() => {
    const priorityCount = groupBy(props.data.pending.todos, 'priority');

    return [
        {
            title: 'Pending',
            count: props.data?.pending?.todos?.length || 0,
            colors: 'bg-amber-50',
            details: [
                {
                    count: priorityCount[priorityEnum.HIGHEST]?.length || 0,
                    component: ChevUp2,
                },
                {
                    count: priorityCount[priorityEnum.MEDIUM]?.length || 0,
                    component: Equal,
                },
                {
                    count: priorityCount[priorityEnum.LOW]?.length || 0,
                    component: ChevDown,
                    class: '!stroke-blue-600',
                },
            ],
        },
        {
            title: 'Complete',
            count: props.data.complete.todos.length || 0,
            colors: 'bg-success-50',
        },
        {
            title: 'Backlog',
            count: props.data.backlog.todos.length || 0,
            colors: 'bg-gray-50',
        },
    ];
});
</script>

<template>
    <div class="flex space-x-3">
        <section
            v-for="card in cardItems"
            :key="card.title"
            :class="card.colors"
            class="w-[110px] h-[106px] rounded-[10px] p-3 text-gray-900"
        >
            <p class="text-sm text-gray-500 font-medium">{{ card.title }}</p>
            <p class="text-[32px] font-bold">{{ card.count }}</p>

            <div v-if="card.details" class="flex justify-between">
                <section
                    v-for="detail in card.details"
                    :key="detail.title"
                    class="flex items-center"
                >
                    <component :is="detail.component" :class="detail.class" />
                    <span class="text-xs font-medium">{{ detail.count }}</span>
                </section>
            </div>
        </section>
    </div>
</template>
