<script setup>
import { computed, ref } from "vue";
import ChevUp2 from "@/Components/Icons/ChevUp2.vue";
import Equal from "@/Components/Icons/Equal.vue";
import ChevDown from "@/Components/Icons/ChevDown.vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    type: {
        default: "priority",
    },
    isStatus: {
        default: false,
    },
    width: {
        default: "w-[195px]",
    },
    label: {
        default: "",
    },
});

const priorities = [
    {
        value: "all",
    },
    { value: "highest", icon: ChevUp2 },
    { value: "high", icon: ChevDown, class: "!stroke-red-600 rotate-180" },
    { value: "medium", icon: Equal },
    {
        value: "low",
        icon: ChevDown,
        class: "!stroke-blue-600",
    },
    { value: "lowest", icon: ChevUp2, class: "!stroke-blue-600 rotate-180" },
];

const statuses = [
    {
        value: "all",
    },
    { value: "pending", class: "bg-amber-400" },
    { value: "backlog", class: "bg-gray-500" },
    { value: "complete", class: "bg-success-600" },
];

const selectedStatus = ref("All");
const selectedPriority = ref("All");

const basedropItem = computed(() =>
    props.isStatus
        ? {
              title: "status",
              selection: selectedStatus.value,
              items: statuses,
          }
        : {
              title: "priority",
              selection: selectedPriority.value,
              items: priorities,
          }
);

function onClick(item) {
    console.log(item);
    if (props.isStatus) return (selectedStatus.value = item.value);
    selectedPriority.value = item.value;
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
                <span
                    class="w-full text-start text-gray-900"
                    v-if="label"
                    >{{ label }}</span
                >
                <template v-else>
                    <span>{{ basedropItem.title }}:</span>
                    <span
                        class="w-full text-start font-inter capitalize text-gray-900"
                        >{{ basedropItem.selection }}</span
                    >
                </template>
                <ChevDown class="flex-shrink-0" />
            </button>
        </template>

        <template #content>
            <BaseIndicator :isStatus />
            <!-- <div
                v-for="pr in basedropItem.items"
                :key="pr.value"
                class="flex items-center space-x-2 w-full px-4 py-2 text-start text-sm leading-5 text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out font-inter cursor-default"
                @click="onClick(pr)"
            >
                <div
                    v-if="isStatus && pr.class"
                    class="px-2 py-1 rounded-[198px]"
                    :class="pr.class"
                ></div>
                <component v-if="pr.icon" :is="pr.icon" :class="pr.class" />
                <span class="capitalize">{{ pr.value }}</span>
            </div> -->
        </template>
    </Dropdown>
</template>
