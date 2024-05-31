<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { avatar } from '@/util';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile</h2>
        </header>

        <!-- Avatar -->
        <div class="relative inline-block">
            <img
                class="inline-block w-[100px] h-[100px] rounded-full"
                :src="$page.props.auth.user?.avatar || avatar"
                alt="Image Description"
            />
            <span class="absolute bottom-0 end-0 p-0.1 rounded-full bg-white">
                <Camera class="h-8 w-8" />
            </span>
        </div>
        <!-- End Avatar -->

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6 font-inter"
        >
            <FormInput
                id="name"
                v-model="form.name"
                :form
                label="Name"
                autofocus
            />

            <FormInput id="email" v-model="form.email" :form label="Email" />

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

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
