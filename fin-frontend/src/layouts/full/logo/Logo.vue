<script setup>
import Logo from "@/assets/images/logos/Shetty_Finance.png";

</script>
<template>
  <div class="logo">
      <RouterLink to="/">
          <img :src="Logo" alt="logo" height="80px" width="200px"/>
      </RouterLink>
  </div>
</template>
