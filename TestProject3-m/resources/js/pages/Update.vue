<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from "../layouts/MainLayout.vue";
import CustomButton from "../components/CustomButton.vue";

const props = defineProps({
    ad: {
        required: true,
        type: Object,
    },
    categories: {
        required: true,
        type: Object
    },
})

const form = useForm({
    id: props.ad.id,
    title: props.ad.title,
    description: props.ad.title,
    email: props.ad.email,
    category_id: props.ad.category_id,
    user_id: props.ad.user_id,
});

const update = () => {
    form.patch('/edit');
}
</script>
<template>
    <Head title="Actualitzar"></Head>
    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <div class="bg-green-200 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit w-2/3 md:w-1/2 p-2">
                <h2 class="text-2xl md:text-5xl text-green-800 font-extrabold border-b-2 border-green-800 capitalize">Edita {{ props.ad.title }}:</h2>
                <form @submit.prevent="update">
                    <div class="md:grid md:grid-cols-2 flex flex-col mt-5 w-full md:gap-4">
                        <div>
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" v-model="form.title"
                                class="bg-white rounded-lg border-green-800 border-2 p-0.5 ms-2" required>
                        </div>
                        <div>
                            <label for="email">Correu de contacte:</label>
                            <input type="email" id="email" name="email" v-model="form.email"
                                class="bg-white rounded-lg border-green-800 border-2 p-0.5 ms-2" required>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="description">Descripció:</label>
                            <textarea name="description" id="description" v-model="form.description"
                                class="bg-white rounded-lg border-green-800 border-2 p-0.5 ms-2" required></textarea>
                        </div>
                        <div class="md:mt-5">
                            <label for="category">Categoria:</label>
                            <select id="category" name="category" required v-model="form.category_id" class="bg-white rounded-lg border-green-800 border-2 p-0.5 ms-2">
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