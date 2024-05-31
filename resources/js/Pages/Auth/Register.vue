<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="space-y-4">
            <FormInput
                id="name"
                v-model="form.name"
                :form
                label="Name"
                autofocus
            />

            <FormInput
                id="email"
                v-model="form.email"
                :form
                label="Email"
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

            <Btn type="submit" class="w-full" :disabled="form.processing">
                Create account
            </Btn>

            <div class="text-center">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-500 hover:text-gray-900 font-medium"
                >
                    Already have an account?
                    <span class="text-primary-600">Login</span>
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
