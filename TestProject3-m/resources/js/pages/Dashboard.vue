<script setup>
import { Head, useForm, Link } from '@inertiajs/vue3';
import MainLayout from "../layouts/MainLayout.vue";
import CustomButton from "../components/CustomButton.vue";
import { ref } from 'vue';
import axios from "axios";


const props = defineProps({
    categories: {
        required: true,
        type: Object
    },
    ads: {
        required: true,
        type: Object,
    }
})

const filteredAds = ref(props.ads);

const form = useForm({
    title: "Vendo opel corsa",
    description: "Barato, nuevo y bonito...",
    email: "ejemplo@dominio.com",
    category_id: null,
    user_id: props.user_id,
});

const createAd = () => {
    form.post('/create');
}

const deleteAd = (id) => {
    axios.delete('/delete/' + id).then((response) => {
        filteredAds.value = response.data;
    })
}
</script>

<template>
    <Head title="Dashboard" />
    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <a href="/logout" aria-label="log out" class="mb-2 bg-green-800 rounded-lg shadow-md text-white w-1/2 md:w-1/4 p-2 text-center hover:bg-white hover:text-green-800 hover:shadow-sm transition-all duration-200 ease-in-out cursor-pointer">Surt</a>
            <div class="bg-green-200 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit w-2/3 md:w-1/2 p-2">
                <h2 class="text-2xl md:text-5xl text-green-800 font-extrabold border-b-2 border-green-800">Crear anunci:</h2>
                <form @submit.prevent="createAd">
                    <div class="md:grid md:grid-cols-2 flex flex-col mt-5 w-full md:gap-4">
                        <div>
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" v-model="form.title"
                                class="bg-white rounded-lg border-green-800 border-2 p-0.5" required>
                        </div>
                        <div>
                            <label for="email">Correu de contacte:</label>
                            <input type="email" id="email" name="email" v-model="form.email"
                                class="bg-white rounded-lg border-green-800 border-2 p-0.5" required>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="description">Descripció:</label>
                            <textarea name="description" id="description" v-model="form.description"
                                class="bg-white rounded-lg border-green-800 border-2 p-0.5" required></textarea>
                        </div>
                        <div class="md:mt-5">
                            <label for="category">Categoria:</label>
                            <select id="category" name="category" required v-model="form.category_id" class="bg-white rounded-lg border-green-800 border-2 p-0.5">
                                <option v-for="category in props.categories" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full inline-flex justify-end mt-5">
                        <CustomButton type="submit">
                            Crea un anunci
                        </CustomButton>
                    </div>
                </form>
            </div>
            <div class="bg-green-200 rounded-lg shadow-md border-b-4 border-green-800 min-h-[400px] w-2/3 md:w-1/2 p-2 mt-5 overflow-y-scroll max-h-[400px]">
                <h2 class="text-2xl md:text-5xl text-green-800 font-extrabold border-b-2 border-green-800 mb-2">Els meus anuncis:</h2>
                <div v-for="(ad, index) in filteredAds"
                    class="bg-green-100 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit p-2 mb-2 capitalize cursor-pointer flex flex-row justify-between">
                    <h3 class="md:text-xl font-bold max-w-[80px] md:max-w-none overflow-clip">{{ ad.title }}</h3>
                    <div class="flex flex-row justify-end">
                        <Link :href="'/edit/' + ad.id" class="me-2 text-blue-800">Edita</Link>
                        <div @click="deleteAd(ad.id)" class="text-red-700">Esborra</div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
