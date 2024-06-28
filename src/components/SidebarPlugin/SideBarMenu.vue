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
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'Experimentinfo' }"
      @click.prevent="handleNavigation('Experimentinfo')"
    >
      <router-link to="/experimentinfo" class="m-0"
        ><md-icon>add_circle</md-icon>
        <label class="w-100 my-auto"> Experiment Info</label></router-link
      >
    </li>
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'Prestarter' }"
      @click.prevent="handleNavigation('Prestarter')"
    >
      <router-link to="/prestarter" class="m-0"
        ><md-icon>calculate</md-icon>
        <label class="w-100 my-auto"> Feed Formula</label></router-link
      >
    </li>
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'Feedformula' }"
      @click.prevent="handleNavigation('Feedformula')"
    >
      <router-link to="/feedformula" class="m-0"
        ><md-icon>start</md-icon>
        <label class="w-100 my-auto"> Broiler Nutrition Details</label></router-link
      >
    </li>
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'Datascreenentry' }"
      @click.prevent="handleNavigation('Datascreenentry')"
    >
      <router-link to="/Datascreenentry" class="m-0"
        ><md-icon>table_view</md-icon>
        <label class="w-100 my-auto"> Day wise Entry</label></router-link
      >
    </li>
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'BaseFeedFormula' }"
      @click.prevent="handleNavigation('BaseFeedFormula')"
    >
      <router-link to="/BaseFeedFormula" class="m-0"
        ><md-icon>functions</md-icon><label class="w-100 my-auto"> Base Feed Formula</label></router-link
      >
    </li>
    <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'bodyweightview' }"
      @click.prevent="handleNavigation('bodyweightview')"
    >
      <router-link to="/bodyweightview" class="m-0"
        ><md-icon>visibility</md-icon>
        <label class="w-100 my-auto"> Body Weight View</label></router-link
      >
    </li>
    <!-- <li
      class="side-bar-item pl-1"
      :class="{ active: activeItem === 'Dashboard' }"
      @click.prevent="handleNavigation('Dashboard')"
    >
      <router-link to="/dashboard" class="m-0"
        ><i class="md-icon md-icon-font md-theme-default">dashboard</i
        ><label class="w-100 my-auto"> Dashboard</label></router-link
      >
    </li> -->

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
        <!-- //--- -->
        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Bird Ratio' }"
          @click.prevent="handleNavigation('Bird Ratio')"
        >
          <router-link
            class="m-0"
            to="/birdratio"
            style="padding-top: 6px; padding-bottom: 6px"
            >Bird Ratio</router-link
          >
        </li>

        <!-- //// -->
        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Groupwise weight' }"
          @click.prevent="handleNavigation('Groupwise weight')"
        >
          <router-link
            class="m-0"
            to="/groupwiseweight"
            style="padding-top: 6px; padding-bottom: 6px"
            >Groupwise Weight</router-link
          >
        </li>

        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Mortal Details' }"
          @click.prevent="handleNavigation('Mortal Details')"
        >
          <router-link
            class="m-0"
            to="/mortaldetails"
            style="padding-top: 6px; padding-bottom: 6px"
            >Mortal Details</router-link
          >
        </li>

        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Penwise weight' }"
          @click.prevent="handleNavigation('Penwise weight')"
        >
          <router-link
            class="m-0"
            to="/penwiseweight"
            style="padding-top: 6px; padding-bottom: 6px"
            >Penwise Weight</router-link
          >
        </li>

        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Weekly report' }"
          @click.prevent="handleNavigation('Weekly report')"
        >
          <router-link
            class="m-0"
            to="/weeklyreport"
            style="padding-top: 6px; padding-bottom: 6px"
            >Weekly Report</router-link
          >
        </li>

        <li
          class="side-bar-item"
          :class="{ active: activeItem === 'Weight on 5th week' }"
          @click.prevent="handleNavigation('Weight on 5th week')"
        >
          <router-link
            class="m-0"
            to="/weight5thweek"
            style="padding-top: 6px; padding-bottom: 6px"
            >Weight 5th Week</router-link
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
              :class="{ active: activeItem === 'Batch Master' }"
              @click.prevent="handleNavigation('Batch Master')"
            >
              <router-link class="m-0 py-2" to="/batchmaster"
                >-Batch Master</router-link
              >
            </li>

            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Crate Master' }"
              @click.prevent="handleNavigation('Crate Master')"
            >
              <router-link class="m-0 py-2" to="/cratemaster"
                >-Crate Master</router-link
              >
            </li>

            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Feeder' }"
              @click.prevent="handleNavigation('Feeder')"
            >
              <router-link class="m-0 py-2" to="/feeder">-Feeder</router-link>
            </li>

            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Feeder Drum' }"
              @click.prevent="handleNavigation('Feeder Drum')"
            >
              <router-link class="m-0 py-2" to="/feederdrummaster"
                >-Feeder Drum</router-link
              >
            </li>

            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Feed Ingredient' }"
              @click.prevent="handleNavigation('Feed Ingredient')"
            >
              <router-link class="m-0 py-2" to="/feedingredient"
                >-Feed Ingredient</router-link
              >
            </li>

            <li
              class="side-bar-sub-item submenu-list-design"
              :class="{ active: activeItem === 'Trial Group' }"
              @click.prevent="handleNavigation('Trial Group')"
            >
              <router-link class="m-0 py-2" to="/trialgroup"
                >-Trial Group</router-link
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