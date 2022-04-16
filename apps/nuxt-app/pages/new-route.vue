<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
const { data, error } = await useAsyncData('count', () => $fetch('/api/count'))

</script>

<template>
  <navbar/>
  <div class="flex py-60 flex-col h-screen my-auto items-center bgimg bg-cover">
    <h3 class="text-white">heading</h3>
    <button class="mt-2 bg-white text-black font-bold py-1 px-8 rounded m-2">
      Page visits: {{ data }}
    </button>
  </div>
</template>
