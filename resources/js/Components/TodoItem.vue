<script setup>
const emit = defineEmits(["update:checked"]);

const props = defineProps({
    item: {
        default: {
            id: "1234dsf",
            title: "Fish project",
            description: "Fish project",
            createdAt: "Mar 25th 2024",
            status: "pending",
            priority: "high",
        },
    },
});
</script>

<template>
    <div class="p-4 border border-gray-100 rounded-[10px]">
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
    </div>
</template>
