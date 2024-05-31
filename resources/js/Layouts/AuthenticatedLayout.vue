<template>
    <div>
        <div class="h-screen bg-white scroller overflow-y-auto">
            <nav class="border-b border-gray-100">
                <BaseHeader />
            </nav>

            <!-- Page Content -->
            <main class="max-w-[954px] mx-auto p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
<style>
.scroller {
    scrollbar-width: none;
}
</style>
