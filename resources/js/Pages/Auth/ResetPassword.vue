<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <form @submit.prevent="submit" class="space-y-4">
            <FormInput
                id="email"
                v-model="form.email"
                :form
                label="Email"
                autofocus
                type="email"
            />

            <FormInput
                id="password"
                v-model="form.password"
                :form
                label="Password"
                type="password"
            />

            <FormInput
                id="password_confirmation"
                v-model="form.password_confirmation"
                :form
                label="Confirm password"
                type="password"
            />

            <div class="flex items-center justify-end">
                <Btn
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </Btn>
            </div>
        </form>
    </GuestLayout>
</template>
