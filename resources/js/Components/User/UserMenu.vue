<template>
    <div class="flex items-center ms-6">
        <!-- Settings Dropdown -->
        <div class="ms-3 relative">
            <Dropdown align="right" width="48">
                <template #trigger>
                    <span class="inline-flex rounded-md">
                        <UserCard />
                    </span>
                </template>

                <template #content>
                    <UserCard :showEmail="true" />
                    <DropdownLink
                        :href="route('profile.edit')"
                        class="flex items-center space-x-2"
                    >
                        <UserLogo />
                        <span>Profile</span>
                    </DropdownLink>
                    <DropdownLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="flex items-center space-x-2 text-red-600"
                    >
                        <LogoutLogo />
                        <span>Logout</span>
                    </DropdownLink>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
