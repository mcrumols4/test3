<script setup>
import Navbar from '@/Components/Navbar.vue';
import CookieWarning from '@/Components/CookieWarning.vue';
</script>

<template>
    <Navbar />
    <main class="my-10">
        <slot />
    </main>
    <CookieWarning />
</template>