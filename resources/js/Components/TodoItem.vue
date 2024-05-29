<script setup>
import { computed } from "vue";

import CheckCircle from "./Icons/CheckCircle.vue";
import FlipBack from "./Icons/FlipBack.vue";
import PencilLine from "./Icons/PencilLine.vue";
import Trash from "./Icons/Trash.vue";
import { priorityEnum, statusEnum } from "@/util";
import ClockForward from "./Icons/ClockForward.vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    item: {
        required: true,
        // default: {
        //     id: "1234dsf",
        //     title: "Fish project",
        //     description: "Fish project",
        //     createdAt: "Mar 25th 2024",
        //     status: "pending",
        //     priority: "high",
        // },
    },
});

function toStatus() {
    switch (props.item.status) {
        case statusEnum.PENDING:
            return {
                status: statusEnum.BACKLOG,
                icon: FlipBack,
            };
        default:
            return {
                status: statusEnum.PENDING,
                icon: ClockForward,
            };
    }
}

const todoActions = computed(() =>
    [
        {
            title: "Mark as done",
            icon: CheckCircle,
            action: () => {},
            class: "text-success-600",
            hidden: props.item.status === statusEnum.COMPLETE,
        },
        {
            title: `Move to ${toStatus().status}`,
            icon: toStatus().icon,
            action: () => {},
        },
        {
            title: "Edit todo",
            icon: PencilLine,
            action: () => {},
            hidden: props.item.status === statusEnum.COMPLETE,
        },
        {
            title: "Delete todo",
            icon: Trash,
            action: () => {},
            class: "text-red-600",
        },
    ].filter((e) => !e.hidden)
);
</script>

<template>
    <div
        class="p-4 border border-gray-100 rounded-[10px] flex justify-between"
    >
        <section class="space-y-2 font-medium font-inter text-gray-500">
            <div class="text-gray-900 text-base">{{ item.title }}</div>
            <div class="text-xs">{{ item.createdAt }}</div>
            <div class="text-sm font-normal">
                {{ item.description }}
            </div>

            <section class="flex gap-x-2">
                <BaseIndicator
                    v-for="(indicator, i) in [item.status, item.priority]"
                    :isStatus="i === 0"
                    :value="indicator"
                    class="space-x-1 px-[6px] py-[3px] rounded-[99px] !bg-gray-50 text-xs"
                />
            </section>
        </section>

        <!-- actions -->
        <Dropdown align="right" width="48">
            <template #trigger>
                <button
                    type="button"
                    class="py-1 px-2 inline-flex text-sm rounded-lg text-gray-500 hover:bg-gray-50"
                >
                    <DotsHorizontal />
                </button>
            </template>

            <template #content>
                <button
                    type="button"
                    v-for="item in todoActions"
                    :key="item.title"
                    :href="route('profile.edit')"
                    class="flex items-center space-x-2 font-medium py-3 px-4 text-sm text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 w-full"
                    :class="item.class"
                >
                    <component :is="item.icon" />
                    <span>{{ item.title }}</span>
                </button>
            </template>
        </Dropdown>
    </div>
</template>
