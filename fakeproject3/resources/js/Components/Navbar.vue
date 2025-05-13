<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-gray-200 flex flex-row p-5 justify-between">
        <div class="align-middle content-center">
            <h1 class="text-xl font-medium">Anuncis Classificats</h1>
        </div>
        <Link :href="route('dashboard')" class="bg-gray-800 text-white rounded px-4 py-2 font-semibold">Entra</Link>
    </div>
</template>