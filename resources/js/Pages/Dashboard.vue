<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, provide, reactive, ref } from 'vue';
import { statusEnum, groupBy } from '@/util';

const props = defineProps({
    todos: {
        default: null,
    },
});

const todoModal = reactive({
    showing: false,
    editTodo: null,
});

provide('todoModal', todoModal);

const searchTerm = ref('');
const statusFilter = ref('all');
const priorityFilter = ref('all');

const expanded = reactive({
    [statusEnum.PENDING]: false,
    [statusEnum.BACKLOG]: false,
    [statusEnum.COMPLETE]: false,
});

const categoriesData = computed(() => {
    const groupedTodos = groupBy(props.todos, 'status');

    const result = {};

    for (const category of Object.values(statusEnum)) {
        result[category] = {
            title: category,
            expanded: expanded[category],
            todos: groupedTodos[category],
        };
    }

    return result;
});

const filteredData = computed(() => {
    const { todos } = props;
    const search = searchTerm.value.toLowerCase();
    const status = statusFilter.value;
    const priority = priorityFilter.value;

    const result = todos.filter((todo) => {
        const matchesSearchTerm =
            !search || todo.title.toLowerCase().includes(search);
        const matchesStatusFilter = status === 'all' || todo.status === status;
        const matchesPriorityFilter =
            priority === 'all' || todo.priority === priority;
        return (
            matchesSearchTerm && matchesStatusFilter && matchesPriorityFilter
        );
    });

    return {
        result,
        show: search || status !== 'all' || priority !== 'all',
    };
});

function toggleAccordion(category) {
    expanded[category] = !expanded[category];
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="space-y-8">
            <!-- <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            </template> -->
            <section class="md:flex md:justify-between">
                <UserCard
                    :showEmail="true"
                    imgClass="w-[72px] h-[72px]"
                    nameClass="font-semibold text-xl"
                    emailClass="text-base"
                    class="space-x-2 pl-0"
                />

                <Analytics :data="categoriesData" />
            </section>

            <!-- todos -->
            <section class="flex justify-between items-center">
                <p class="text-[32px] font-bold text-gray-900">Todos</p>

                <AddEditTodo />
            </section>

            <!-- inputs -->
            <section class="md:flex md:gap-x-4 md:space-y-0 space-y-4">
                <TodoSearch v-model="searchTerm" />

                <BaseDrop
                    v-model="statusFilter"
                    :isStatus="true"
                    width="md:w-[191px] w-full"
                />
                <BaseDrop v-model="priorityFilter" />
            </section>

            <!-- accords -->
            <section v-if="filteredData.show">
                <TodoItem
                    v-for="todo in filteredData.result"
                    :key="todo.id"
                    :todo
                    class="my-4"
                />
                <span
                    v-if="!filteredData.result.length"
                    class="text-gray-600 text-sm"
                    >0 filter result</span
                >
            </section>
            <section v-else>
                <div
                    v-for="cat in categoriesData"
                    :key="cat.title"
                    class="border-b last:border-0 border-gray-300"
                >
                    <div
                        class="flex justify-between items-center py-3 cursor-default group"
                        @click="toggleAccordion(cat.title)"
                    >
                        <p
                            class="text-xl font-medium group-hover:text-primary-600 capitalize"
                        >
                            {{ cat.title }}
                        </p>
                        <ChevDown
                            class="transform origin-center transition duration-200 ease-out"
                            :class="{ '!rotate-180': cat.expanded }"
                        />
                    </div>

                    <section
                        class="transition-all duration-500 ease-in-out grid"
                        :class="
                            cat.expanded
                                ? 'grid-rows-[1fr] opacity-100'
                                : 'grid-rows-[0fr] opacity-0'
                        "
                    >
                        <div :class="!cat.expanded && 'overflow-hidden'">
                            <TodoItem
                                v-for="todo in cat.todos"
                                :key="todo.id"
                                :todo
                                class="my-4"
                            />
                            <span
                                v-if="!cat.todos?.length"
                                class="text-gray-400 text-xs"
                                >No available todos</span
                            >
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
