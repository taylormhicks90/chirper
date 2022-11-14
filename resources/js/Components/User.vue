<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import {format} from 'friendly-numbers';

dayjs.extend(relativeTime);

const props = defineProps(['user']);

</script>

<template>
  <div class="p-6 flex space-x-2">
    <div class="flex-1">
      <div class="flex justify-between items-center">
        <div>
          <Link :href="route('users.show',user.id)">{{user.name }}</Link>
          <small class="ml-2 text-sm text-gray-600"> Joined {{ dayjs(user.created_at).fromNow() }}</small>
        </div>
        <Link :href="route('users.show',user.id)" as="button" type="button" class="bg-indigo-50 px-2 rounded-lg">View</Link>
      </div>
      <span>{{format(user.chirps_count)}} Chirps</span>
    </div>
  </div>
</template>
