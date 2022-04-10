<script setup lang="ts">
import Navbar from "~/components/layout/navbar.vue";
import YouAreHere from "~/components/elements/YouAreHere.vue";
import VModelExample from "~/components/elements/VModelExample.vue";
import DynamicStateExample from "~/components/elements/DynamicStateExample.vue";

</script>
<script lang="ts">
import Prism from '~/plugins/prism'

export default {
  mounted() {
    Prism.highlightAll()
  }
}
</script>


<template>
  <div>
    <navbar/>
    <YouAreHere/>

    <VModelExample/>

    <DynamicStateExample/>

  </div>
</template>
