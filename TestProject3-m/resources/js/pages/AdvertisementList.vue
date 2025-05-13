<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from "../layouts/MainLayout.vue";
import CustomButton from "../components/CustomButton.vue";
import { ref } from "vue";
import axios from "axios";
import { watch } from "vue";

const props = defineProps({
    ads: {
        required: true,
        type: Object,
    },
    categories: {
        required: true,
        type: Object,
    },
});

const filteredAds = ref(props.ads.data);
const selectedCategory = ref("all");
const nOfAds = ref(5);
const page = ref(1);
const totalPages = ref(props.ads.last_page);

const openAd = (id) => {
    window.location.href = "/ad/" + id;
}

const reloadAds = () => {
    axios.get("/ads/filter", {
        params: {
            category: selectedCategory.value,
            number: nOfAds.value,
            page: page.value,
        }
    }).then((response) => {
        filteredAds.value = response.data.data;
        totalPages.value = response.data.last_page;
    })
}


watch(nOfAds, () => {
    page.value = 1;
    reloadAds();
});
</script>
<template>

    <Head title="Anuncis"></Head>
    <MainLayout>
        <div class="flex flex-col w-full h-full justify-between items-center">
            <div class="bg-green-200 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit w-2/3 md:w-1/2 p-2">
                <h2 class="text-2xl md:text-5xl text-green-800 font-extrabold">Anuncis:</h2>
            </div>

            <div class="w-2/3 md:w-1/2 border-2 border-emerald-500 min-h-fit p-2 mt-5 rounded-lg shadow-md">
                <h2 class="text-3xl text-green-800 font-bold">Filtres:</h2>
                <div class="flex flex-col md:flex-row justify-start items-start md:items-center">
                    <div>
                        <label for="categoryselector" class="font-bold me-1">Categoria:</label>
                        <select id="categoryselector" name="categoryselector" @change="reloadAds"
                            v-model="selectedCategory" class="text-sm">
                            <option value="all">Tots els classificats</option>
                            <option v-for="(category, index) in categories" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div class="md:ms-10">
                        <label for="quantity" class="font-bold me-1">Quantitat:</label>
                        <select id="quantity" name="quantity" @change="reloadAds"
                            v-model="nOfAds">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="md:ms-10">
                        <label for="page" class="font-bold me-1">Pàgina:</label>
                        <select id="page" name="page" @change="reloadAds"
                            v-model="page">
                            <option v-for="(page, index) in totalPages" :value="index+1">{{ index+1 }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <p class="font-bold mt-5 text-left w-1/2">Mostrant {{ filteredAds.length }} anuncis...</p>
            <div class="w-2/3 md:w-1/2 mt-2">
                <div v-for="(ad, index) in filteredAds"
                    @click="openAd(ad.id)"
                    class="bg-green-100 rounded-lg shadow-md border-b-4 border-green-800 min-h-fit p-2 mb-2 capitalize cursor-pointer">
                    <h3 class="text-xl font-bold">{{ ad.title }}</h3>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
