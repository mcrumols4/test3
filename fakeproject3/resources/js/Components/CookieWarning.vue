<script setup>
import { onMounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";

const cookiesAccepted = ref(false);

if (localStorage.getItem("cookies") === "true") {
    cookiesAccepted.value = true;
}

const acceptCookies = () => {
    cookiesAccepted.value = true;
    localStorage.setItem("cookies", "true");
}
</script>

<template>
    <div v-if="!cookiesAccepted">
        <div class="bg-gray-700 w-full justify-center align-middle flex flex-row p-5 fixed bottom-0">
            <div class="mx-20 align-middle">
                <h2 class="text-white font-extrabold text-xl mb-2">Avís de cookies</h2>
                <p class="text-white font-medium mt-2">Aquesta web no fa servir cookies</p>
            </div>
            <div class="mx-20 align-middle">
                <button @click="acceptCookies" class="px-4 py-2 bg-slate-300 font-bold rounded my-2">Acceptar</button>
            </div>
        </div>
    </div>
</template>