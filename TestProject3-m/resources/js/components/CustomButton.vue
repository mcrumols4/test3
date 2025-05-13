<script setup>
import { Link } from "@inertiajs/vue3"

const props = defineProps({
    link: {
        required: true,
        type: String
    }
});
</script>
<template>
    <Link :href="props.link" class="bg-green-800 rounded-lg shadow-md text-white w-1/2 md:w-1/4 p-2 text-center hover:bg-white hover:text-green-800 hover:shadow-sm transition-all duration-200 ease-in-out cursor-pointer"><slot /></Link>
</template>