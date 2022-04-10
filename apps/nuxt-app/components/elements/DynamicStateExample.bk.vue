<script setup lang="ts">

import ActionButton from "~/components/elements/ActionButton.vue";

const newStateValue = ref(null)
const dynamicTestState = useState('dynamicTestState', () => 'unset')

function updateTestState() {
  dynamicTestState.value = newStateValue.value
}

</script>

<template>
  <div class="bg-gray-50 grid grid-cols-2 mt-3">
    <figure class="bg-slate-100 rounded-xl p-8 dark:bg-slate-800">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 place-content-center grid-rows-1 grid">
        <h2 class="text-3xl font-extrabold tracking-tight text-black-900 sm:text-4xl">
          <div class=" text-lg text-indigo-600">useState example (dynamic)</div>
          <div class=" text-orange-600 mb-5 py-20">Test State Is: <span class="text-green-600">{{
              dynamicTestState
            }}</span></div>
          <input v-model="newStateValue"
                 class=" border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                 type="text"
                 placeholder="enter new state value" aria-label="state value">
        </h2>
        <ActionButton
          actionClasses="bg-emerald-600"
          title="Update persistent State"
          action-link="fake"
          @action.prevent="updateTestState"
        />
      </div>
    </figure>

    <div class="place-content-center grid-rows-1 grid bg-slate-100 ml-1 rounded">
      <div class=" font-extrabold tracking-tight text-gray-600">
        <figure class="rounded-xl flex">
          <div class="flex">
                <pre>
          <code class="language-javascript">
import {useState} from "#app";

const newStateValue = ref('')

const testState = useState('testState', () => 'unset')

function updateTestState() {
  testState.value = newStateValue.value
}
        </code>
        </pre>

          </div>
        </figure>
        <div>
        </div>
      </div>
    </div>

  </div>
</template>

