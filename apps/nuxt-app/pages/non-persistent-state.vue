<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import YouAreHere from "~/components/elements/YouAreHere.vue";
import VModelExample from "~/components/elements/VModelExample.vue";

const vModelExampleValue = ref('')

</script>
<!--<script lang="ts">-->
<!--import Prism from '~/plugins/prism'-->

<!--export default {-->
<!--  mounted() {-->
<!--    Prism.highlightAll()-->
<!--  }-->
<!--}-->
<!--</script>-->


<template>
  <div>
    <navbar/>
    <div class="h-48">
    </div>

    <YouAreHere/>

<VModelExample/>

    <div class="bg-gray-50">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <span class="block text-indigo-600">Test State Is: {{ vModelExampleValue }}</span>
        </h2>
      </div>
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 place-content-center grid-rows-1 grid">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <input v-model="vModelExampleValue"
                 class=" border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text"
                 placeholder="enter new state value" aria-label="state value">
        </h2>
      </div>
    </div>


    <div class="flex justify-center">
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
  </div>
</template>
