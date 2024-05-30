<script setup>
import { inject, onMounted, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['update:checked']);
const form = useForm({
    status: null,
    priority: null,
    title: '',
    description: '',
});
const todoModal = inject('todoModal');

const openModal = () => {
    form.reset();
    todoModal.editTodo = null;
    todoModal.showing = true;
};
const closeModal = () => {
    todoModal.showing = false;
};

function submit() {
    if (!form.status) form.status = 'pending';
    if (!form.priority) form.priority = 'low';

    todoModal.editTodo
        ? form.patch(`dashboard/${todoModal.editTodo.id}`, form)
        : form.post(route('dashboard'));

    todoModal.showing = false;
}

watch(
    () => todoModal.editTodo,
    (val) => {
        if (!val) return;

        const { status, priority, title, description } = todoModal.editTodo;
        form.status = status;
        form.priority = priority;
        form.title = title;
        form.description = description;
    }
);
</script>

<template>
    <div>
        <Btn class="!font-medium !rounded-lg" @click="openModal">
            + Add todo
        </Btn>

        <Modal :show="todoModal.showing" @close="closeModal" maxWidth="sm">
            <div class="">
                <!-- header -->
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

                <form @submit.prevent="submit">
                    <!-- body -->
                    <div class="p-4 space-y-3 font-inter">
                        <!-- drops -->
                        <section class="flex gap-x-3">
                            <div class="w-full">
                                <span class="text-xs">Status</span>
                                <BaseDrop
                                    label="Select status"
                                    :isStatus="true"
                                    width="w-full"
                                    v-model="form.status"
                                />
                            </div>

                            <div class="w-full">
                                <span class="text-xs">Priority</span>
                                <BaseDrop
                                    label="Select priority"
                                    width="w-full"
                                    v-model="form.priority"
                                />
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
                </form>

                <!-- footer -->
                <div class="flex justify-end items-center gap-x-3 py-3 px-4">
                    <Btn
                        @click="todoModal.showing = false"
                        class="!bg-gray-50 hover:!bg-gray-100 !text-gray-900 !font-medium"
                    >
                        Cancel
                    </Btn>
                    <Btn
                        @click="submit"
                        type="submit"
                        :disabled="form.processing"
                    >
                        {{ todoModal.editTodo ? 'Update' : 'Create' }} todo
                    </Btn>
                </div>
            </div>
        </Modal>
    </div>
</template>
