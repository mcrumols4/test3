<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>

    <Head>Inici</Head>

    <MainLayout>
        <div class="flex flex-col justify-center align-middle">
            <p class="text-6xl font-bold m-5">Benvingut,</p>
            <p class="font-medium text-2xl m-5">Aquesta és una web on veure o publicar anuncis classificats</p>
            <div class="">
                <p class="mb-5 text-xl m-5">Accedir als anuncis classificats</p>
                <Link :href="route('publications.index')"
                    class="p-2 rounded bg-red-900 text-white text-lg font-bold m-5">Accedeix...</Link>
            </div>
        </div>
    </MainLayout>
</template>