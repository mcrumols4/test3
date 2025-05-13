<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import MainLayout from "../layouts/MainLayout.vue";
import CustomButton from "../components/CustomButton.vue";
</script>
<template>
    <Head title="Inici"></Head>
    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <div class="bg-green-200 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit w-2/3 md:w-1/2 p-2">
                <p>Hola, benvingut a la pàgina d'anuncis d'en Mateo, disfruta l'estància!</p>
                <p>Aquesta web et permet:</p>
                <ul class="ms-10">
                    <li class="list-disc">Veure anuncis</li>
                    <li class="list-disc">Crear anuncis</li>
                </ul>
                <p>Gràcies per visitar :)</p>
            </div>

            <CustomButton link="/ads" class="mt-10">Veure anuncis!</CustomButton>
        </div>
    </MainLayout>
</template>
