<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed, onMounted, provide, reactive, ref } from 'vue';
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
            expanded: expanded[category] || !groupedTodos[category]?.length,
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

defineOptions({ layout: AuthenticatedLayout });
</script>

<template>
    <div>
        <Head title="Dashboard" />

        <section>
            <div class="space-y-8">
                <section class="md:flex md:justify-between">
                    <UserCard
                        @click="router.visit('profile')"
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

                <!-- category accordions -->
                <Accords
                    :filteredData
                    :categoriesData
                    @toggleAccordion="toggleAccordion"
                />
            </div>
        </section>
    </div>
</template>
