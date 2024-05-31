<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <FormInput
                id="email"
                v-model="form.email"
                :form
                label="Email"
                type="email"
                autofocus
            />

            <FormInput
                id="password"
                v-model="form.password"
                :form
                label="Password"
                type="password"
                autofocus
                labelClass="mt-4"
            />

            <div class="flex justify-end mt-2">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm text-gray-500 hover:text-gray-900 font-medium float-right"
                >
                    Forgot your password?
                    <span class="text-primary-600">Reset</span>
                </Link>
            </div>

            <Btn type="submit" class="w-full my-4" :disabled="form.processing">
                Login
            </Btn>

            <div class="text-center">
                <Link
                    :href="route('register')"
                    class="text-sm text-gray-500 hover:text-gray-900 font-medium"
                >
                    Don't have an account?
                    <span class="text-primary-600">Register</span>
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
