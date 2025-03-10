<script setup>
import { RouterLink } from 'vue-router'

// import { logo } from '@/assets/icons/logo.jpg'
import { sygnet } from '@/assets/brand/sygnet'
import { AppSidebarNav } from '@/components/AppSidebarNav.js'
import { useSidebarStore } from '@/stores/sidebar.js'

const sidebar = useSidebarStore()
</script>

<template>
  <CSidebar
    class="border-end"
    colorScheme="dark"
    position="fixed"
    :unfoldable="sidebar.unfoldable"
    :visible="sidebar.visible"
    @visible-change="(value) => sidebar.toggleVisible(value)"
  >
    <CSidebarHeader class="border-bottom">
      <RouterLink custom to="/dashboard" v-slot="{ href, navigate }">
        <CSidebarBrand v-bind="$attrs" as="a" :href="href" @click="navigate" style="text-decoration: none !important; margin-top: 10px;">
          <h5><span style="color: orange; font-size: 25px;">S</span> <span style="font-size: 18px; padding-bottom: 20px;">FINANCE</span></h5>
          <CIcon custom-class-name="sidebar-brand-narrow" :icon="sygnet" :height="32" />
        </CSidebarBrand>
      </RouterLink>
      <CCloseButton class="d-lg-none" dark @click="sidebar.toggleVisible()" />
    </CSidebarHeader>
    <AppSidebarNav />
    <CSidebarFooter class="border-top d-none d-lg-flex">
      <CSidebarToggler @click="sidebar.toggleUnfoldable()" />
    </CSidebarFooter>
  </CSidebar>
</template>
