<script setup>
import { onMounted } from "vue";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3"
import CustomButton from "../components/CustomButton.vue";

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
    <header class="min-h-[98px] bg-green-800 flex items-center justify-between px-2">
        <Link href="/" class="flex justify-start w-1/5 items-center hover:border-b-2 border-white">
            <div class="min-w-[50px] min-h-[50px] bg-gray-300"></div>
            <h1 class="text-xl md:text-4xl text-white font-bold ms-2">Anuncis Mateo</h1>
        </Link>
        <div class="w-1/2 lg:w-1/3 flex justify-end">
            <CustomButton link="/ads" class="!bg-green-600 hover:!bg-white mx-8 lg:mx-4">Anuncis</CustomButton>
            <CustomButton link="/dashboard" class="!bg-green-600 hover:!bg-white">Entra</CustomButton>
        </div>
    </header>
    <main class="p-2">
        <slot />
    </main>
    <div v-if="!cookiesAccepted" class="bg-black/80 absolute min-w-full min-h-full z-40 start-0 top-0 flex justify-center items-center">
        <div class="w-1/2 min-h-[180px] bg-green-200 border-b-4 rounded-lg shadow-md border-b-green-800 p-4">
            <h2 class="text-green-800 text-4xl font-extrabold">Avís de cookies</h2>
            <p>Aquesta web no fa servir cookies pero et mostro un avís perque soc bona gent! :)</p>
            <br>
            <div class="inline-flex justify-end w-full">
                <CustomButton @click="acceptCookies">Ok</CustomButton>
            </div>
        </div>
    </div>
</template>