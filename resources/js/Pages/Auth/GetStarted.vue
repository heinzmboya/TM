<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});
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
                class="!bg-gray-100 !text-gray-900 py-4 !text-lg !font-medium w-full"
            >
                <a href="/auth/redirect" class="flex justify-center gap-x-3">
                    <Google /> <span>Continue with Google</span>
                </a>
            </Btn>

            <Btn class="w-full !text-lg !font-medium py-4">
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
