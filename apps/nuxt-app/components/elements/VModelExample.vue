<script setup lang="ts">

const newStateValue = ref('')

</script>

<template>
  <div class="bg-gray-50 grid grid-cols-2">
    <figure class="bg-slate-100 rounded-xl p-8 dark:bg-slate-800">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 place-content-center grid-rows-1 grid">
        <h2 class="text-3xl font-extrabold tracking-tight text-black-900 sm:text-4xl">
          <div class=" text-lg text-indigo-600">v-model example</div>
          <div class=" text-orange-600 mb-5 py-20">Test State Is: <span class="text-green-600">{{
              newStateValue
            }}</span></div>
          <input v-model="newStateValue"
                 class=" border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                 type="text"
                 placeholder="enter new state value" aria-label="state value">
        </h2>
      </div>

    </figure>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 place-content-center grid-rows-1 grid bg-slate-100 ml-1 rounded">
      <div class="text-xl font-extrabold tracking-tight text-gray-600 sm:text-4xl">
        <figure class="rounded-xl flex">
          <div class="flex">
                <pre>
          <code class="language-javascript">
const newStateValue = ref('')
        </code>
        </pre>

          </div>
        </figure>
        <img class="mx-auto h-50 w-auto"
             src="~/public/img/vModelTemplateExample.png"
             alt="full stack jack logo"
        />
      </div>
    </div>

  </div>
</template>

