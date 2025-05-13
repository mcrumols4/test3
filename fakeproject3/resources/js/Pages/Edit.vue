<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from "../layouts/MainLayout.vue";
import CustomButton from "../components/CustomButton.vue";

const props = defineProps({
    publication: {
        required: true,
        type: Object,
    },
    categories: {
        required: true,
        type: Object
    },
})

const form = useForm({
    id: props.publication.id,
    title: props.publication.title,
    description: props.publication.title,
    email: props.publication.email,
    category_id: props.publication.category_id,
    user_id: props.publication.user_id,
});

const update = () => {
    form.patch('/edit');
}
</script>
<template>
    <Head title="Actualitzar"></Head>
    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <div class="bg-gray-200 rounded-lg shadow-md border-b-4 border-gray-800 min-h-fit w-2/3 md:w-1/2 p-2">
                <h2 class="text-2xl md:text-5xl text-gray-800 font-extrabold border-b-2 border-gray-800 capitalize">Edita {{ props.publication.title }}:</h2>
                <form @submit.prevent="update">
                    <div class="md:grid md:grid-cols-2 flex flex-col mt-5 w-full md:gap-4">
                        <div>
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" v-model="form.title"
                                class="bg-white rounded-lg border-gray-800 border-2 p-0.5 ms-2" required>
                        </div>
                        <div>
                            <label for="email">Correu de contacte:</label>
                            <input type="email" id="email" name="email" v-model="form.email"
                                class="bg-white rounded-lg border-gray-800 border-2 p-0.5 ms-2" required>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="description">Descripció:</label>
                            <textarea name="description" id="description" v-model="form.description"
                                class="bg-white rounded-lg border-gray-800 border-2 p-0.5 ms-2" required></textarea>
                        </div>
                        <div class="md:mt-5">
                            <label for="category">Categoria:</label>
                            <select id="category" name="category" required v-model="form.category_id" class="bg-white rounded-lg border-gray-800 border-2 p-0.5 ms-2">
                                <option v-for="category in props.categories" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full inline-flex justify-end mt-5">
                        <CustomButton type="submit">
                            Edita l'anunci
                        </CustomButton>
                    </div>
                </form>
            </div>
        </div>
    </MainLayout>
</template>