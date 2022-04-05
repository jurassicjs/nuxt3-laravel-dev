<script setup lang="ts">
import {useAsyncData} from "nuxt3/app";
import {RuntimeConfig} from "@nuxt/schema";
import {useFetch} from "nuxt3/app";
//

const config: RuntimeConfig = useRuntimeConfig();
const apiUrl = config.API_BASE_URL
const url = `${apiUrl}/votes`


// const {data}  = await useAsyncData('count', () => $fetch('https://dev.jurassicjs.eu/api/votes'), {server: false})
// const {data: data2}  = await useAsyncData('count', () => $fetch(url), {server: false}).catch((e) => { console.log('error:' + e)})


const { data } = await useFetch('https://dev.jurassicjs.eu/api/votes', {server:false})
const { data: whatever } = await useFetch('https://dev.jurassicjs.eu/api/votes', {server:false})
// const { data: dude } = await useFetch(`${url}`, {server:false})
//todo: see why this does not work

// import api from '~/utils/api'
//
// const {data} = await api.get('/votes')


</script>

<template>
<nuxt-link to="client-boss">To Client Boss</nuxt-link>
<nuxt-link to="server-boss">To Server Boss</nuxt-link>


</template>
