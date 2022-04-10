<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import YouAreHere from "~/components/elements/YouAreHere.vue";
import {useLoggedIn} from "~/composables/useLoggedIn";
import useClientAuth from "~/middleware/useClientAuth";
// import {definePageMeta} from "nuxt3/dist/pages/runtime";

const router = useRouter()
const loading = ref(true)


// definePageMeta({
//   middleware: ["auth"]
//
// })
// show middleware behavior // discuss debugging.

const isAuth = useClientAuth()

if (!isAuth) {

router.push('/login')

} else {
  loading.value = false
}

const {user} = useLoggedIn()

</script>
<template>
  <div v-if="!loading">
    <navbar/>
    <div class="h-48">
    </div>

    <YouAreHere/>

    <div class="bg-gray-50">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <span class="block text-indigo-600">Welcome {{ user.name }}. You are logged in. </span>
        </h2>
      </div>
    </div>

  </div>
</template>
