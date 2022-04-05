
<script setup lang="ts">
import {ILinkMethod} from "~/types/order";
import {PropType} from "@vue/runtime-core";

const props = defineProps({
  actionLink:  {
    type: Object as PropType<ILinkMethod>,
    required: true
  },
  actionClasses:  {
    required: true
  },
  title:  {
    required: true
  }
})
</script>

<template>
  <div class="inline-flex rounded-md shadow m-2" v-if="actionLink"
       @click="$emit('action',  actionLink.url,actionLink.method, actionLink.action)">
    <a href="#"
       class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white  hover:bg-indigo-700"
       :class="actionClasses"
    >
      {{ title }} </a>
  </div>
</template>
