<script setup>
import {format} from 'friendly-numbers';
import {reactive} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import axios from "axios";

const props = defineProps(['chirp']);
const state = reactive({chirp: props.chirp,});

const toggleLike = async function (){
    axios.patch(route('chirps.like',state.chirp.id)).then((response)=>{state.chirp = response.data})
};

</script>

<template>
  <div>
    <PrimaryButton @click="toggleLike"
          :class="(state.chirp.liked? 'bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150' : '')">
      <i class="fa-duotone fa-thumbs-up mr-2"></i> <span>{{format(state.chirp.like_counter?.count ?? 0)}} {{state.chirp.like_counter?.count === 1?'Like':'Likes'}}</span>
    </Primarybutton>
  </div>
</template>

