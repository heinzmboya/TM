<script setup>
import { inject, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

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
    console.log(form.errors);
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

        <Modal :show="todoModal.showing" @close="closeModal" maxWidth="md">
            <div class="">
                <!-- header -->
                <div
                    class="flex justify-between items-center py-3 px-4 border-b"
                >
                    <p class="font-semibold text-xl">New Todo</p>

                    <Btn
                        class="hover:!bg-gray-100 bg-transparent !text-gray-900 !rounded-full !p-2"
                        @click="closeModal"
                    >
                        <Close />
                    </Btn>
                </div>

                <form @submit.prevent="submit">
                    <!-- body -->
                    <div class="p-4 space-y-3 font-inter">
                        <!-- drops -->
                        <section class="sm:flex gap-x-3">
                            <div class="w-full">
                                <span class="text-xs">Status</span>
                                <BaseDrop
                                    addModalLabel="Select status"
                                    :isStatus="true"
                                    width="w-full"
                                    v-model="form.status"
                                />
                            </div>

                            <div class="w-full">
                                <span class="text-xs">Priority</span>
                                <BaseDrop
                                    addModalLabel="Select priority"
                                    width="w-full"
                                    v-model="form.priority"
                                />
                            </div>
                        </section>

                        <!-- title -->
                        <FormInput
                            id="title"
                            v-model="form.title"
                            :form
                            label="Todo title"
                            autofocus
                        />

                        <!-- editor -->
                        <FormInput
                            id="description"
                            v-model="form.description"
                            :form
                            label="Todo description"
                        />
                    </div>

                    <!-- footer -->
                    <div
                        class="flex justify-end items-center gap-x-3 py-3 px-4"
                    >
                        <Btn
                            @click="todoModal.showing = false"
                            class="!bg-gray-50 hover:!bg-gray-100 !text-gray-900 !font-medium"
                        >
                            Cancel
                        </Btn>
                        <Btn type="submit" :disabled="form.processing">
                            {{ todoModal.editTodo ? 'Update' : 'Create' }} todo
                        </Btn>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>
