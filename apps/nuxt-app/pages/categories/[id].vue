<script setup lang="ts">
import {RuntimeConfig} from "@nuxt/schema";
import {useRoute, useRuntimeConfig} from "nuxt3/app";
import Navbar from "~/components/layout/navbar.vue";
import {IOrderResponse} from "~/types/order";
import ActionButton from "~/components/elements/ActionButton.vue";

const config: RuntimeConfig = useRuntimeConfig();
const route = useRoute()
const orderId = route.params.id

const {data: count} = await useAsyncData('count', () => $fetch('/api/count'))


let {data}  =  useAsyncData(
  'order',
  (): Promise<IOrderResponse> => $fetch(
    `${config.CUSTOM_API_URL}/order/${route.params.id}/find`),
  {server: false}
)

const action = async function (url: string, method: string) {
  data.value = await $fetch(url, {method: method}).then((val) => val)
}
</script>
<template>
  <navbar/>
  <div class="h-48">
  </div>
<!--  <span class="block text-indigo-600">Status: {{ route}}</span>-->
<!--  <span class="block text-indigo-600">Status: {{ config.CUSTOM_API_URL}}</span>-->
<!--  <span class="block text-indigo-600">TEST: {{ config.TEST_URL}}</span>-->
  <div class="bg-gray-50" v-if="data">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
      <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
        <span class="block">Order: {{ orderId }}</span>
        <span class="block text-indigo-600">Status: {{ data.order.status }}</span>

        <span class="block text-indigo-600">Count: {{ count }}</span>
      </h2>
      <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
        <ActionButton
          v-if="data.actionLinks['payLink']"
          actionClasses="bg-emerald-600"
          title="Pay"
          :action-link="data.actionLinks['payLink']"
          @action="action"
        />
        <ActionButton
          v-if="data.actionLinks['cancelLink']"
          actionClasses="bg-rose-600"
          title="Cancel"
          :action-link="data.actionLinks['cancelLink']"
          @action="action"
        />
        <ActionButton
          v-if="data.actionLinks['rebateLink']"
          actionClasses="bg-sky-600"
          title="Rebate"
          :action-link="data.actionLinks['rebateLink']"
          @action="action"/>
      </div>
    </div>
  </div>
</template>
