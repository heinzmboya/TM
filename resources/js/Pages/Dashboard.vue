<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';
import { statusEnum, groupBy } from '@/util';

const props = defineProps({
    todos: {
        default: null,
    },
});

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
            <section class="flex justify-between">
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

                <AddTodo />
            </section>

            <!-- inputs -->
            <section class="flex gap-x-4">
                <div class="relative w-full">
                    <div
                        class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none"
                    >
                        <SearchIcon />
                    </div>

                    <input
                        type="text"
                        class="border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                        placeholder="Search todos..."
                    />
                </div>

                <BaseDrop :isStatus="true" width="w-[191px]" />
                <BaseDrop />
            </section>

            <!-- accords -->
            <section>
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
                                :item="todo"
                                class="my-4"
                            />
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
