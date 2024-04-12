<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    works: {
        type: Array,
        default: () => []
    },
});

</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 w-full gap-2 ml-auto mr-auto mt-8 lg:grid-cols-3 xl:grid-cols-4 mt-6 lg:gap-8">
                <div class="" v-for="(item, index) in works" :key='index'>
                    <img :src=item.url alt="Image" class="w-full h-auto">
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel
    </footer>
</template>