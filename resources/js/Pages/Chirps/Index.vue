<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Chirp from '@/Components/Chirp.vue';
import { TailwindPagination } from 'laravel-vue-pagination';
import { useForm, Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const chirps = ref({});

const fetchChirps = async (page = 1) => {
  const response = await fetch(route('chirps.fetch') + `?page=${page}`);
  chirps.value = await response.json();
}

const form = useForm({
  message: '',
});

fetchChirps();
</script>

<template>
  <Head title="Chirps" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Chirps
      </h2>
    </template>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <form @submit.prevent="form.post(route('chirps.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
        <InputError :message="form.errors.message" class="mt-2" />
        <PrimaryButton class="mt-4">Chirp</PrimaryButton>
      </form>

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
