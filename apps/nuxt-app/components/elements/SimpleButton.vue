<script setup lang="ts">

const props = defineProps({
  title:  {
    required: true
  },
  color:  {
    required: true
  }
})
</script>

<template>
  <div class="inline-flex rounded-md shadow m-2"
       @click.prevent="$emit('pressed')">
    <a href="#"
       class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white  hover:bg-indigo-700"
       :class="color">

      {{ title }} </a>
  </div>
</template>
