<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Chirp from '@/Components/Chirp.vue';

defineProps(['user', 'chirps']);

</script>

<template>
  <Head title="{{user.name}}"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ user.name }}'s Chirps
      </h2>
    </template>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        <Chirp
            v-for="chirp in chirps"
            :key="chirp.id"
            :chirp="chirp"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
