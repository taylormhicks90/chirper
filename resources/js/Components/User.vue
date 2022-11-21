<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {format} from 'friendly-numbers';
import PrimaryButton from "@/Components/PrimaryButton.vue";

dayjs.extend(relativeTime);

const props = defineProps(['user']);

</script>

<template>
    <div class="flex p-6">
      <div class="">
          <Link :href="route('users.show',user.id)">{{user.name }}</Link>
          <small class="ml-2 text-sm text-gray-600"> Joined {{ dayjs(user.created_at).fromNow() }}</small><br/>
          <span>{{format(user.chirps_count)}} Chirps</span>
      </div>
      <div class="ml-auto my-auto">
        <Link :href="route('users.show',user.id)" class="" ><PrimaryButton>View</PrimaryButton></Link>
      </div>
    </div>

</template>
