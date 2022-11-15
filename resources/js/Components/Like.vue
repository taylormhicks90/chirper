<script setup>

import {Link, useForm} from '@inertiajs/inertia-vue3';

import {format} from 'friendly-numbers';
import {reactive} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['chirp']);

const state = reactive({liked: props.chirp.likes.length > 0});
const form = useForm();

const toggleLike = function (){
  if(state.liked){
    form.delete(route('chirps.like.delete',props.chirp.id),{preserveScroll:true, onSuccess: function () { state.liked=!state.liked}});
  }else{
    form.patch(route('chirps.like.store',props.chirp.id),{preserveScroll:true, onSuccess: function (){ state.liked=!state.liked}});
  }
};
</script>

<template>
  <div>
    <PrimaryButton @click="toggleLike"
          :class="(state.liked? 'bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150' : '')">
      <i class="fa-duotone fa-thumbs-up mr-2"></i> <span>{{format(chirp.likes_count)}} {{chirp.likes_count === 1?'Like':'Likes'}}</span>
    </Primarybutton>
  </div>
</template>

