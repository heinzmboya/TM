<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white sm:rounded-lg space-y-6">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">OAuth</h2>
                    </header>
                    <Btn
                        :disabled="$page.props.auth.user.google_id"
                        type="submit"
                        class="!bg-gray-100 !text-gray-900 py-4 !text-base !font-medium"
                    >
                        <a
                            href="/auth/redirect"
                            class="flex justify-center gap-x-3"
                        >
                            <Google /> <span>Continue with Google</span>
                        </a>
                    </Btn>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
