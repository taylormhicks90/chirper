<script setup>

import {Link, useForm} from '@inertiajs/inertia-vue3';

import {format} from 'friendly-numbers';
import {reactive} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['chirp', 'hasLiked']);

const state = reactive({liked: !!props.hasLiked});
const form = useForm();

const toggleLike = () => {
    return form.post(route('chirp.toggle', props.chirp.id), { preserveScroll:true, onSuccess: () => state.liked = !state.liked });
}
console.log(props);
</script>

<template>
  <div>
    <button @click="toggleLike"
          type="button" :class="(props.hasLiked ? 'bg-blue-500' : 'bg-gray-500') +' text-white px-2 rounded-lg'">
        <i class="fa-duotone fa-thumbs-up me-2"></i> {{format(chirp.chirp_likes_count)}} Likes
    </button>
  </div>
</template>

