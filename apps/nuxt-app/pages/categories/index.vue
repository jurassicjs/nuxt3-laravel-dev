<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import CategoryCard from "~/components/elements/CategoryCard.vue";
import {useAsyncData} from "#app";

const { data: rows, error } = await useAsyncData('categories', () => $fetch('/api/categories'))

</script>

<template>
  <div v-if="rows">
    <Navbar></Navbar>
    <div aria-label="group of cards" tabindex="0" class="focus:outline-none py-8 w-full">
      <div  v-for="row in rows" class="lg:flex items-center justify-center w-full">
          <div v-for="category in row"  aria-label="card 1" class="focus:outline-none lg:w-4/12 lg:m-7 lg:mb-0 mb-7 bg-white dark:bg-gray-800  p-6 shadow rounded">
            <CategoryCard :tags="category.tags">
              <template v-slot:icon>
                <img class="h-8" :src="category.image" alt="nuxt 3 logo">
<!--                {{category.image}}-->
              </template>
              <template v-slot:title>
                <div class="mt-5">
                  {{category.title}}
                </div>
              </template>
              <template v-slot:message >
                {{category.message}}
              </template>
            </CategoryCard>
          </div>

        </div>

   </div>
   </div>
</template>
