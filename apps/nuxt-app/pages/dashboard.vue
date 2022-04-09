<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import ActionButton from "~/components/elements/ActionButton.vue";
import {useState} from "#app";
import YouAreHere from "~/components/elements/YouAreHere.vue";
import { useStorage } from '@vueuse/core'

const state = useStorage('my-store', { hello: 'hi', greeting: 'Hello' })


const testState = useState('testState')

function updateTestState() {
  testState.value = 'dashboard updated value is now set'
}

</script>
<template>
  <div>
    <navbar/>
    <div class="h-48">
    </div>


    <YouAreHere/>


    <div class="bg-gray-50">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <span class="block text-indigo-600">TestState Is: {{ testState }}</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
          <ActionButton
            actionClasses="bg-emerald-600"
            title="Update State"
            action-link="fake"
            @action="updateTestState"
          />
        </div>
      </div>
    </div>
  </div>

</template>
