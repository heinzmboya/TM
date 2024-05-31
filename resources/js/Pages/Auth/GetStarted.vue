<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Get started" />

        <section class="space-y-4">
            <p class="font-semibold text-2xl">Create Account</p>
            <p class="text-gray-500 text-sm">
                Create an account to start managing your tasks.
            </p>

            <Btn
                type="submit"
                class="w-full !bg-gray-100 !text-gray-900 py-4 !text-lg !font-medium flex justify-center gap-x-3"
                :disabled="form.processing"
            >
                <Google /> <span>Continue with Google</span>
            </Btn>
            <Btn
                type="submit"
                class="w-full !text-lg !font-medium py-4"
                :disabled="form.processing"
            >
                <Link :href="route('register')"> Continue with Email </Link>
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
        </section>
    </GuestLayout>
</template>
