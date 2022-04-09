<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import ActionButton from "~/components/elements/ActionButton.vue";
import {useState} from "#app";
const testState = useState('testState', () => 'initial value is set')

function updateTestState() {
  testState.value = 'updated value is now set'
}


</script>
<template>
  <div>
    <navbar/>
    <div class="h-48">
    </div>
    <div class="bg-gray-50">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <span class="block text-indigo-600">TestStateIs: {{ testState }}</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
          <ActionButton
            actionClasses="bg-emerald-600"
            title="Update State"
            action-link="fake"
            @action="updateTestState"
          />
        </div>
        <nuxt-link to="/dashboard">
          go to dash
        </nuxt-link>
      </div>
    </div>
  </div>

</template>
