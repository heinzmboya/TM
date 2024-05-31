<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Password</h2>
        </header>

        <form
            @submit.prevent="updatePassword"
            class="mt-6 space-y-6 font-inter"
        >
            <FormInput
                ref="currentPasswordInput"
                id="current_password"
                v-model="form.current_password"
                :form
                label="Current Password"
                type="password"
            />

            <FormInput
                ref="passwordInput"
                id="password"
                v-model="form.password"
                :form
                label="New Password"
                type="password"
            />

            <FormInput
                id="password_confirmation"
                v-model="form.password_confirmation"
                :form
                label="New Password"
                type="password"
            />

            <div class="flex items-center gap-4">
                <section class="flex justify-between w-full">
                    <div />
                    <Btn
                        type="submit"
                        :disabled="form.processing || !form.isDirty"
                    >
                        Save changes
                    </Btn>
                </section>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
