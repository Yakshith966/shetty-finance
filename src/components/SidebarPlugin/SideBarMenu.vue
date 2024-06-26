<template>
  <ul class="side-menu md-list nav md-theme-default">
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'Dashboard' }"
      @click.prevent="handleNavigation('Dashboard')"
    >
      <router-link to="/dashboard" class="m-0"
        ><i class="md-icon md-icon-font md-theme-default">dashboard</i
        ><label class="w-100 my-auto"> Dashboard</label></router-link
      >
    </li>


    <li class="p-0">
      <a
        href="javascript:void(0)"
        class="m-0 side-bar-item"
        style="padding-top: 6px; padding-bottom: 6px"
        type="button"
        data-toggle="collapse"
        data-target="#collapseExample24"
        aria-expanded="false"
        aria-controls="collapseExample24"
        @click.prevent="handleNavigation('Reports')"
      >
        <i class="md-icon md-icon-font md-theme-default">library_books</i>
        <label class="my-auto w-100">Reports</label
        ><i class="mdi mdi-chevron-down nav-arrow my-auto"></i
        ><i class="mdi mdi-chevron-up nav-arrow my-auto"></i>
      </a>
      <ul class="collapse side-sub-menu level-2" id="collapseExample24">
        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Bird Ratio' }"
          @click.prevent="handleNavigation('Bird Ratio')"
        >
          <router-link
            class="m-0"
            to="/birdratio"
            style="padding-top: 6px; padding-bottom: 6px"
            >Bird ratio</router-link
          >
        </li>
        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Group wise weight' }"
          @click.prevent="handleNavigation('Group wise weight')"
        >
          <router-link
            class="m-0"
            to="/groupwiseweight"
            style="padding-top: 6px; padding-bottom: 6px"
            >Group wise weight</router-link
          >
        </li>
        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Pen wise weight' }"
          @click.prevent="handleNavigation('Pen wise weight')"
        >
          <router-link
            class="m-0"
            to="/penwiseweight"
            style="padding-top: 6px; padding-bottom: 6px"
            >Pen wise weight</router-link
          >
        </li>
        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Weekly report' }"
          @click.prevent="handleNavigation('Weekly report')"
        >
          <a
            class="m-0"
            href="javascript:void(0)"
            style="padding-top: 6px; padding-bottom: 6px"
            >Weekly report</a
          >
        </li>
      </ul>
    </li>
        <li class="p-0">
      <a
        href="javascript:void(0)"
        class="m-0 side-bar-item"
        style="padding-top: 6px; padding-bottom: 6px"
        type="button"
        data-toggle="collapse"
        data-target="#collapseExample2"
        aria-expanded="false"
        aria-controls="collapseExample2"
        @click.prevent="handleNavigation('Settings', 'collapseExample2')"
      >
        <i class="md-icon md-icon-font md-theme-default">settings</i>
        <label class="my-auto w-100">Settings</label
        ><i class="mdi mdi-chevron-down nav-arrow my-auto"></i
        ><i class="mdi mdi-chevron-up nav-arrow my-auto"></i>
      </a>
      <ul class="collapse side-sub-menu" id="collapseExample2">
        <li class="">
          <a
            href="javascript:void(0)"
            class="m-0 side-bar-item"
            style="padding-top: 6px; padding-bottom: 6px"
            type="button"
            data-toggle="collapse"
            data-target="#collapseExample22"
            aria-expanded="false"
            aria-controls="collapseExample22"
           
          >
            <label class="w-100">Master</label
            ><i class="mdi mdi-chevron-down nav-arrow my-auto"></i
            ><i class="mdi mdi-chevron-up nav-arrow my-auto"></i>
          </a>
          <ul class="collapse side-sub-menu" id="collapseExample22" style="">
            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Trial Group' }"
              @click.prevent="handleNavigation('Trial Group')"
            >
              <router-link class="m-0 py-2" to="/trialgroup"
                >-Trial Group</router-link
              >
            </li>
            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Ingredient' }"
              @click.prevent="handleNavigation('Ingredient')"
            >
              <router-link class="m-0 py-2" to="/feedingredient"
                >-Ingredient</router-link
              >
            </li>
          </ul>
        </li>
        <li class="">
          <router-link
            to="/usermanagement"
            class="m-0 side-bar-item"
            style="padding-top: 10px; padding-bottom: 10px"
          >
            <label class="w-100 my-auto"> User Management</label>
          </router-link>
        </li>
      </ul>
    </li>
  </ul>
</template>
<script>
export default {
  data() {
    return {
      activeItem: "",
    };
  },
  mounted() {},
  methods: {
    handleNavigation(item) {
      this.activeItem = item;
    },
    dynamicClass(id) {
      return document.getElementById(id).classList.contains("show")
        ? "mdi-chevron-up"
        : "mdi-chevron-down";
    },
  },
};
</script>
<style>
.side-menu {
  list-style-type: none;
  padding: 0;
}

.side-bar-item {
  color: #fff;
  padding: 6px 6px;
  border-radius: 3px;
  cursor: pointer;
}

.side-bar-item:hover {
  background-color: grey;
}

.side-bar-item a {
  color: inherit;
  text-decoration: none;
  display: flex;
  align-items: center;
}

.side-bar-item.active,
.side-bar-item.active:hover {
  background-color: #4caf50;
}
.side-bar-sub-item {
  color: #fff;
  /* padding: 10px 27px; */
  border-radius: 1px;
  cursor: pointer;
}
.side-bar-sub-item:hover {
  background-color: grey;
}
.side-sub-menu {
  list-style-type: none;
  padding-left: 5%;
  background-color: #3c693d;
}
/* .side-sub-menu  li {
  border-left: 2px dotted;
  color: whitesmoke;
} */
.submenu-list-design {
  border-left: 1px dotted;
  color: rgba(245, 245, 245, 0.696);
}


.side-sub-menu .side-bar-item.active {
  background-color: #1a3d1b;
}

i {
  font-size: 20px;
  margin-right: 15px;
}
a[aria-expanded="true"] .mdi-chevron-down {
  display: none;
}
a[aria-expanded="false"] .mdi-chevron-up {
  display: none;
}
</style>