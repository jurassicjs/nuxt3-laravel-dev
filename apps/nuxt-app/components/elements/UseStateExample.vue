<script setup lang="ts">

import SimpleButton from "~/components/elements/SimpleButton.vue";

const newStateValue = ref(null)
const dynamicTestState = useState('dynamicTestState', () => 'unset')

function updateTestState() {
  debugger
  dynamicTestState.value = newStateValue.value
}

</script>

<template>
  <div class="bg-gray-50 grid grid-cols-2 mt-5">
    <figure class="bg-slate-100 rounded-xl p-8 dark:bg-slate-800 mr-3 ml-5">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 place-content-center grid-rows-1 grid">
        <h2 class="text-3xl font-extrabold tracking-tight text-black-900 sm:text-4xl">
          <div class=" text-lg text-indigo-600">useState example (dynamic)</div>
          <div class=" text-orange-600 mb-5 py-20">State Is: <span class="text-green-600">{{
              dynamicTestState
            }}</span></div>


          <input v-model="newStateValue"
                 class=" border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                 type="text"
                 placeholder="enter new state value" aria-label="state value"
          >
          <SimpleButton title="Update persistent State" color="bg-green-600" @pressed="updateTestState"/>


        </h2>
      </div>
    </figure>

    <div
      class="max-w-3l mx-auto py-6 px-4 sm:px-6 lg:py-6 place-content-center grid-rows-1 grid bg-slate-100 ml-1  mr-5 rounded">
      <div class="">
        <figure class="rounded-xl flex">
          <div class="">
                <pre>
          <code class="language-javascript">
import ActionButton from "~/components/elements/ActionButton.vue";

const newStateValue = ref(null)
const dynamicTestState = useState('dynamicTestState', () => 'unset')

function updateTestState() {
  debugger
  dynamicTestState.value = newStateValue.value
}
        </code>
        </pre>

          </div>
        </figure>
        <img class="mx-auto h-50 w-auto"
             src="~/public/img/useStateExample.png"
             alt="full stack jack logo"
        />
      </div>
    </div>
  </div>
</template>

