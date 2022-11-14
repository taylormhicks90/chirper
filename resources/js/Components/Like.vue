<script setup>

import { Link } from '@inertiajs/inertia-vue3';

import {format} from 'friendly-numbers';

const props = defineProps(['chirp']);

const liked = props.chirp.likes.length > 0;
</script>

<template>
  <div>
    <Link v-if="liked" :href="route('chirps.likes.destroy',[chirp.id, chirp.likes[0].id])" method="delete" as="button" @click="liked = !liked"
          type="button" class="bg-blue-500 text-white px-2 rounded-lg" preserve-scroll>
        <i class="fa-duotone fa-thumbs-up me-2"></i> {{format(chirp.likes_count)}} Likes
    </Link>
    <Link v-else :href="route('chirps.likes.store',chirp.id)" method="post" as="button" type="button" @click="liked = !liked"
          class="bg-gray-500 text-white px-2 rounded-lg" preserve-scroll>
        <i class="fa-duotone fa-thumbs-up me-2"></i> {{format(chirp.likes_count)}} Likes
    </Link>
  </div>
</template>

