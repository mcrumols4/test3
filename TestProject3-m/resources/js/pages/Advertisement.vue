<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from "../layouts/MainLayout.vue";
import CustomButton from "../components/CustomButton.vue";

const props = defineProps({
    ad: {
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
    <Head :title="props.ad.title"></Head>
    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <div class="bg-green-200 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit w-1/2 p-2">
                <h2 class="text-4xl font-bold capitalize">{{ props.ad.title }}</h2>
                <div class="flex flex-row w-full justify-between border-b-2 border-green-800">
                    <div class="flex">
                        <p>{{ props.date }}</p>
                        <p class="ms-5">{{ props.hour }}</p>
                    </div>
                    <p>{{ props.ad.email }}</p>
                </div>
                <p>{{ props.ad.description }}</p>
            </div>
        </div>
    </MainLayout>
</template>
