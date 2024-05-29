<script setup>
import { ref } from "vue";
import { priorityEnum, statusEnum } from "@/util";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    status: null,
    priority: null,
    title: "",
    description: "",
});

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    item: {
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

const showCreateModal = ref(false);

const closeModal = () => {
    showCreateModal.value = false;
};
</script>

<template>
    <div>
        <button
            type="button"
            class="text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-3 focus:outline-none"
            @click="showCreateModal = true"
        >
            + Add todo
        </button>

        <!-- modal -->
        <Modal :show="showCreateModal" @close="closeModal" maxWidth="sm">
            <div class="">
                <div
                    class="flex justify-between items-center py-3 px-4 border-b"
                >
                    <p class="font-semibold text-xl">New Todo</p>
                    <button
                        type="button"
                        class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-overlay="#hs-basic-modal"
                    >
                        <span class="sr-only">Close</span>
                        <svg
                            class="flex-shrink-0 size-4"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- middle -->
                <div class="p-4 space-y-3 font-inter">
                    <!-- drops -->
                    <section class="flex gap-x-3">
                        <div class="w-full">
                            <span class="text-xs">Status</span>
                            <BaseDrop label="Select status" :isStatus="true" width="w-full" />
                        </div>

                        <div class="w-full">
                            <span class="text-xs">Priority</span>
                            <BaseDrop label="Select priority" width="w-full" />
                        </div>
                    </section>

                    <!-- title -->
                    <section>
                        <div>
                            <InputLabel
                                class="text-sm"
                                for="title"
                                value="Todo title"
                            />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="title"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </div>
                    </section>

                    <!-- editor -->
                    <section>
                        <div>
                            <InputLabel
                                class="text-sm"
                                for="desc"
                                value="Todo description"
                            />

                            <TextInput
                                id="desc"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                required
                                autofocus
                                autocomplete="desc"
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.description"
                            />
                        </div>
                    </section>
                </div>
                <div class="flex justify-end items-center gap-x-3 py-3 px-4">
                    <button
                        type="button"
                        class="py-3 px-4 inline-flex text-sm font-medium rounded-md bg-gray-50 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        class="py-3 px-4 text-sm font-semibold rounded-md bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none"
                    >
                        Create todo
                    </button>
                </div>
            </div>
        </Modal>
    </div>
</template>
