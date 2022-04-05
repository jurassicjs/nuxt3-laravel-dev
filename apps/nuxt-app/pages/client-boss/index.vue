<script setup lang="ts">
import {RuntimeConfig} from "@nuxt/schema";
import {useFetch} from "nuxt3/app";
import {ref} from 'vue'

let status = ref('testing')
let error = ref(null)
let isLoading = ref(false)
const userId: string = '123'
const config: RuntimeConfig = useRuntimeConfig();
const {data} = useFetch('https://dev.jurassicjs.eu/api/order/client-boss/23432', {server: false})

const cancel = async (id: string) => {
  isLoading.value = true;
  try {
    status.value = await $fetch(`https://dev.jurassicjs.eu/api/order/${id}/cancel`, {method: 'post'});

    isLoading.value = false;
  } catch (e) {
    error.value = e;
  }
};

const pay = async (id: string) => {
  isLoading.value = true;
  try {
    status.value = await $fetch(`https://dev.jurassicjs.eu/api/order/${id}/pay`, {method: 'post'});

    isLoading.value = false;
  } catch (e) {
    error.value = e;
  }
};


</script>

<template>

  <div v-if="isLoading"> Loading  . . . </div>
  status: {{status}}
  <div v-if="data">
    <div v-if="data.status === 'pending'">
      <button class="button" @click="cancel(data.id)">cancel</button>
    </div>
    <div v-if="data.status === 'pending'">
      <button class="button" @click="pay(data.id)">pay</button>
    </div>
  </div>


</template>
