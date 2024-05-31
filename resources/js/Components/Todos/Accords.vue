<script setup>
defineProps({
    filteredData: {
        default: null,
    },
    categoriesData: {
        default: null,
    },
});
defineEmits(['toggleAccordion']);
</script>

<template>
    <section v-if="filteredData.show">
        <TodoItem
            v-for="todo in filteredData.result"
            :key="todo.id"
            :todo
            class="my-4"
        />
        <span v-if="!filteredData.result.length" class="text-gray-600 text-sm"
            >0 filter result</span
        >
    </section>
    <section v-else>
        <div
            v-for="cat in categoriesData"
            :key="cat.title"
            class="border-b last:border-0 border-gray-300"
        >
            <!-- category title -->
            <div
                class="flex justify-between items-center py-3 cursor-default group"
                @click="$emit('toggleAccordion', cat.title)"
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

            <!-- expanding section -->
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
</template>
