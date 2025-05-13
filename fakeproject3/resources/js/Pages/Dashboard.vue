<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from "axios";

const props = defineProps({
    categories: {
        required: true,
        type: Object
    },
    publications: {
        required: true,
        type: Object,
    }
});

const filteredPublications = ref(props.publications);

const form = useForm({
    title: "Vendo opel corsa",
    description: "Barato, nuevo y bonito...",
    email: "ejemplo@dominio.com",
    category_id: null,
    user_id: props.user_id,
});

const deletePublication = (id) => {
    axios.delete(route('publications.destroy', id)).then((response) => {
        filteredPublications.value = response.data;
    })
}

const Publicate = () => {
    form.post(route('publications.store'));
}
</script>

<template>

    <Head title="Dashboard" />

    <MainLayout>
        <div class="flex flex-col md:grid grid-cols-2">
            <div class="p-5">
                <h2 class="text-2xl md:text-5xl text-gray-800 font-extrabold border-b-2 border-gray-800">Publicar
                    anunci:</h2>
                <form @submit.prevent="Publicate" class="flex flex-col w-full">
                    <label for="name" class="my-2">Titol:</label>
                    <input type="text" id="name" name="name" v-model="form.title"
                        class="bg-white rounded-lg border-gray-800 border-2 p-0.5 my-2" required>
                    <label for="description" class="my-2">Descripció:</label>
                    <textarea name="description" id="description" v-model="form.description"
                        class="bg-white rounded-lg border-gray-800 border-2 p-0.5 my-2" required></textarea>
                    <label for="email" class="my-2">Correu de contacte:</label>
                    <input type="email" id="email" name="email" v-model="form.email"
                        class="bg-white rounded-lg border-gray-800 border-2 p-0.5 my-2" required>
                    <label for="category" class="my-2">Categoria:</label>
                    <select id="category" name="category" required v-model="form.category_id"
                        class="bg-white rounded-lg border-gray-800 border-2 p-0.5 my-2">
                        <option v-for="category in props.categories" :value="category.id">{{ category.name }}
                        </option>
                    </select>
                    <button type="submit" class="my-5 bg-gray-800 text-white text-lg font font-semibold rounded">
                        Publicar
                    </button>
                </form>
            </div>
            <div class="p-5">
                <div
                    class="bg-gray-200 rounded-lg shadow-md border-b-4 border-gray-800 min-h-[400px] w-full md:w-full p-2 mt-5 overflow-y-scroll">
                    <h2 class="text-2xl md:text-5xl text-gray-800 font-extrabold border-b-2 border-gray-800 mb-2">Els
                        meus anuncis:</h2>
                    <div v-for="(publication, index) in filteredPublications"
                        class="bg-gray-100 rounded-lg shadow-md border-b-4 border-gray-800 min-h-fit p-2 mb-2 capitalize cursor-pointer flex flex-row justify-between">
                        <h3 class="md:text-xl font-bold max-w-[80px] md:max-w-none overflow-clip">{{ publication.title }}</h3>
                        <div class="flex flex-row justify-end">
                            <Link :href="route('publications.edit', publication.id)" class="me-2 text-blue-800">Edita</Link>
                            <div @click="deletePublication(publication.id)" class="text-red-700">Esborra</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
