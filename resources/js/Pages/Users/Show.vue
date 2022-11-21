<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Chirp from '@/Components/Chirp.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { TailwindPagination } from 'laravel-vue-pagination';
import {ref} from "vue";

const props = defineProps(['user']);
const chirps = ref({});

const fetchChirps = async (page = 1) => {
  const response = await fetch(route('user.chirps',props.user.id) + `?page=${page}`);
  chirps.value = await response.json();
}
fetchChirps();
</script>

<template>
  <Head :title="user.name"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ user.name }}'s Chirps
      </h2>
    </template>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <Chirp
            v-for="chirp in chirps.data"
            :key="chirp.id"
            :chirp="chirp"
        />

      </div>

      <div class="mt-6 flex">
        <TailwindPagination
            :data="chirps"
            :limit="1"
            @pagination-change-page="fetchChirps"
            class="mx-auto"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
