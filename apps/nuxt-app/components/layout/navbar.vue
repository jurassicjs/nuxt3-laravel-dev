<script setup lang="ts">
import {useLoggedIn} from "~/composables/useLoggedIn";

const {user} = useLoggedIn()

function logout() {
  const {logout} = useLoggedIn()
  logout()
}

</script>

<template>
  <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <nuxt-link to="/">
            <span class="sr-only">Workflow</span>
              <img class="h-24 w-auto" src="~/public/img/logo_short.png"/>
            </nuxt-link>
        </div>
        <div class="-mr-2 -my-2 md:hidden">
          <button type="button"
                  class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                  aria-expanded="false">
            <span class="sr-only">Open menu</span>
            <!-- Heroicon name: outline/menu -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>
        </div>
        <nav class="hidden md:flex space-x-10">

          <nuxt-link to="/served-by-nuxt">
            <span class="text-base font-medium text-gray-500 hover:text-gray-900">
              Served by Nuxt Api
            </span>
          </nuxt-link>

          <nuxt-link to="/state-examples">
            <span class="text-base font-medium text-gray-500 hover:text-gray-900">
              State in Nuxt
            </span>
          </nuxt-link>

          <nuxt-link to="/dashboard">
            <span class="text-base font-medium text-gray-500 hover:text-gray-900">
                Dashboard
            </span>
          </nuxt-link>
        </nav>

        <div v-if="user" class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          <div to="/login" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
            {{user.name}}
          </div>
          <div @click="logout"
                     class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
            logout
          </div>
        </div>

        <div v-else class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          <nuxt-link to="/login" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> Sign
            in
          </nuxt-link>
          <nuxt-link to="/register"
                     class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
            Sign up
          </nuxt-link>
        </div>

        <a href="https://github.com/jurassicjs/nuxt3-laravel-dev" target="_blank">
          <img class="h-24 w-auto sm:h-10" src="~/public/img/github-logo.png"/>
        </a>
      </div>
    </div>

  </div>
</template>
<script lang="ts">
import FloatDrop from "~/components/layout/float-drop";
import SolutionDrop from "~/components/layout/solution-drop";

export default {
  components: {SolutionDrop, FloatDrop}
}
</script>
