<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    publication: {
        required: true,
        type: Object,
    },
    date: {
        required: true,
        type: String,
    },
    hour: {
        required: true,
        type: String,
    }
});
</script>

<template>

    <Head>{{ props.publication.title }}</Head>

    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <div class="bg-gray-200 rounded-lg shadow-md min-h-fit w-1/2 p-2">
                <h2 class="text-4xl font-bold capitalize">{{ props.publication.title }}</h2>
                <div class="flex flex-row w-full justify-between border-b-2 border-green-800">
                    <div class="flex">
                        <p>{{ props.date }}</p>
                        <p class="ms-5">{{ props.hour }}</p>
                    </div>
                    <p>{{ props.publication.email }}</p>
                </div>
                <p>{{ props.publication.description }}</p>
            </div>
        </div>
    </MainLayout>
</template>