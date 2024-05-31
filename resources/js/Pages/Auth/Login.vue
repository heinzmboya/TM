<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
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

        <div class="mb-[18px] flex space-x-3">
            <Link :href="route('get-started')">
                <LeftArrow />
            </Link>
            <p class="font-semibold text-2xl">Login using your email</p>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
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
            />

            <div class="flex justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="text-sm text-gray-500 hover:text-gray-900 font-medium float-right"
                >
                    Forgot your password?
                    <span class="text-primary-600">Reset</span>
                </Link>
            </div>

            <Btn type="submit" class="w-full" :disabled="form.processing">
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
