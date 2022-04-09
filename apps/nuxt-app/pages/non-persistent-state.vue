<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import ActionButton from "~/components/elements/ActionButton.vue";
import YouAreHere from "~/components/elements/YouAreHere.vue";
import {useLoggedIn} from "~/composables/useLoggedIn";
import {useState} from "#app";

const newStateValue = ref('')
const {user} = useLoggedIn()
const testState = useState('testState', () => 'unset')

function updateTestState() {
  testState.value = newStateValue.value
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
      </div>
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 place-content-center grid-rows-1 grid">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <input v-model="newStateValue"
                 class=" border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text"
                 placeholder="enter new state value" aria-label="state value">
        </h2>

        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0 mt-5">
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
