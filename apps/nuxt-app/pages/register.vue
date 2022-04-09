<script setup lang="ts">
import {ref} from "@vue/reactivity";
import {RuntimeConfig} from "@nuxt/schema";
import {useCookie, useFetch, useRouter, useRuntimeConfig, useState,} from "#app";
import {IUser} from "~/types/IUser";
import Navbar from "~/components/layout/navbar.vue";
import {useStorage} from "@vueuse/core";

const router = useRouter()
const config: RuntimeConfig = useRuntimeConfig();
const email = ref(null)
const password = ref(null)
const passwordConfirmation = ref(null)
const name = ref(null)
let csrfCookie = useCookie('XSRF-TOKEN')
const loggedInUser = () => useState<IUser | null>('loggedInUser', () => null)
const testState = useState('testState', () => 'initial value is set')

function postRegisterForm() {
  registerUser<IUser>().then(user => {
    useState('loggedInUser').value = user
    useStorage('loggedInUser', user)
    router.push('/dashboard')
  })
}

const { data: csrfResponse, error: csrfError } = await useFetch(
  `https://dev.jurassicjs.eu/api/v1/csrf-cookie`,
  {
    server: false,
    method: 'GET',
    mode: 'cors',
    headers: {'Content-Type': 'application/json'},
    credentials: 'include'
  }
)

async function registerUser<TResponse>(): Promise<TResponse> {
  return await fetch(`${config.CUSTOM_API_URL}/auth/register`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': csrfCookie.value,
      'XDEBUG_SESSION': 'PHPSTORM'
    },
    body:  JSON.stringify({name: name.value, email: email.value, password: password.value, password_confirmation: passwordConfirmation.value})
  })
    .then(data => data.json())
    .then((data) => data as TResponse);
}

</script>

<template>
  <div>
    <navbar/>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
        <div>
          <img class="mx-auto h-24 w-auto" src="~/public/img/logo_clear.png" alt="full stack jack logo" />
          <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign up</h2>
          <p class="mt-2 text-center text-sm text-gray-600">

          </p>
        </div>
        <form v-on:submit.prevent class="mt-8 space-y-6" action="#" method="POST">
          <input type="hidden" name="remember" value="true">
          <div class="rounded-md shadow-sm -space-y-px">
            <div>
              <label for="email-address" class="sr-only">Name</label>
              <input v-model="name" id="user-name" name="name" type="text" required
                     class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                     placeholder="Name">
            </div>
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input v-model="email" id="email-address" name="email" type="email" autocomplete="email" required
                     class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                     placeholder="Email address">
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input v-model="password" id="password" name="password" type="password" autocomplete="current-password"
                     required
                     class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                     placeholder="Password">
            </div>
            <div>
              <label for="password" class="sr-only">Confirm Password</label>
              <input v-model="passwordConfirmation" id="password_confirmation" name="password_confirmation" type="password"
                     required
                     class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                     placeholder="Confirm Password">
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox"
                     class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
              <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
            </div>

            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your password? </a>
            </div>
          </div>

          <div>
            <button @click="postRegisterForm"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <!-- Heroicon name: solid/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                    clip-rule="evenodd"/>
            </svg>
          </span>
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
