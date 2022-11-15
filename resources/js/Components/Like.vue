<script setup>

import {Link, useForm} from '@inertiajs/inertia-vue3';

import {format} from 'friendly-numbers';
import {reactive} from "vue";
import {Inertia } from "@inertiajs/inertia";

const props = defineProps(['chirp']);

const state = reactive({liked: !!props.chirp.chirp_likes.find(user => user.id === props.chirp.user_id)});
const form = useForm();

const toggleLike = () => {
    return form.post(route('chirp.toggle', props.chirp.id), { preserveScroll:true, onSuccess: () => state.liked = !state.liked });
}
</script>

<template>
  <div>
    <button @click="toggleLike"
          type="button" :class="(state.liked ? 'bg-blue-500' : 'bg-gray-500') +' text-white px-2 rounded-lg'">
        <i class="fa-duotone fa-thumbs-up me-2"></i> {{format(chirp.chirp_likes.length)}} Likes
    </button>
  </div>
</template>

