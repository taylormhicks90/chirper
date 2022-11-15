<script setup>

import {Link, useForm} from '@inertiajs/inertia-vue3';

import {format} from 'friendly-numbers';
import {reactive} from "vue";
import {Inertia } from "@inertiajs/inertia";

const props = defineProps(['chirp']);

const state = reactive({liked: props.chirp.likes.length > 0});
const form = useForm();

const toggleLike = function (){
  if(state.liked){
    form.delete(route('chirps.like',props.chirp.id),{preserveScroll:true, onSuccess: function () { state.liked=!state.liked}});
  }else{
    form.patch(route('chirps.like',props.chirp.id),{preserveScroll:true, onSuccess: function (){ state.liked=!state.liked}});
  }
};
</script>

<template>
  <div>
    <button @click="toggleLike"
          type="button" :class="(state.liked? 'bg-blue-500' : 'bg-gray-500') +' text-white px-2 rounded-lg'">
        <i class="fa-duotone fa-thumbs-up me-2"></i> {{format(chirp.likes_count)}} Likes
    </button>
  </div>
</template>

