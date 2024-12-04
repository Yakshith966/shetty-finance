import { defineComponent, h, onMounted, ref, resolveComponent } from 'vue'
import { RouterLink, useRoute } from 'vue-router'

import { cilExternalLink } from '@coreui/icons'
import { CBadge, CSidebarNav, CNavItem, CNavGroup, CNavTitle } from '@coreui/vue'
import store  from '../stores/store'
// import nav from '@/_nav.js'

import simplebar from 'simplebar-vue'
import 'simplebar-vue/dist/simplebar.min.css'

async function getNavItems() {
  try {
    // Call your API here
    const response = await axios.get('/get-sidebar-menu');
    const navData = response.data.sidebarMenuList;

    // console.log('API Response:', navData);

    // Transform the data into the required format
    const transformedNavData = navData.map(item => ({
      component: item.component || 'CNavItem',
      name: item.name,
      to: item.slug,
      icon: item.icon || '',
      permissions: item.permissions[0],
      // items: item.items || [], // Include sub-items if any
    }));
    store.commit("setSubMenus", transformedNavData )

    return transformedNavData;
  } catch (error) {
    // console.error('Error fetching navigation data:', error);
    // Return a default set of navigation items in case of an error
    return [
      {
        component: 'CNavItem',
        name: 'Dashboard',
        to: '/dashboard',
        icon: 'cil-speedometer',
      },
    ];
  }
}

const normalizePath = (path) =>
  decodeURI(path)
    .replace(/#.*$/, '')
    .replace(/(index)?\.(html)$/, '')

const isActiveLink = (route, link) => {
  if (link === undefined) {
    return false
  }

  if (route.hash === link) {
    return true
  }

  const currentPath = normalizePath(route.path)
  const targetPath = normalizePath(link)

  return currentPath === targetPath
}

const isActiveItem = (route, item) => {
  if (isActiveLink(route, item.to)) {
    return true
  }

  if (item.items) {
    return item.items.some((child) => isActiveItem(route, child))
  }

  return false
}

const AppSidebarNav = defineComponent({
  name: 'AppSidebarNav',
  components: {
    CNavItem,
    CNavGroup,
    CNavTitle,
  },
  setup() {
    const route = useRoute()
    const firstRender = ref(true)
    const navItems = ref([]) // Reactive variable for navigation items

    onMounted(async () => {
      firstRender.value = false
      navItems.value =  store.getters.getSubMenus;
      // await getNavItems();
      navItems.value = await getNavItems()
    })

    const handleSubMenuClick = (permissions) => {
      if (permissions) {
        store.commit("setsubmenuPermissions", permissions)
      }
    };

    const renderItem = (item) => {
      if (item.items) {
        return h(
          CNavGroup,
          {
            as: 'div',
            compact: true,
            ...(firstRender.value && {
              visible: item.items.some((child) => isActiveItem(route, child)),
            }),
          },
          {
            togglerContent: () => [
              h(resolveComponent('CIcon'), {
                customClassName: 'nav-icon',
                name: item.icon,
              }),
              item.name,
            ],
            default: () => item.items.map((child) => renderItem(child)),
          },
        )
      }

      if (item.href) {
        return h(
          resolveComponent(item.component),
          {
            href: item.href,
            target: '_blank',
            rel: 'noopener noreferrer',
            onClick: () => handleSubMenuClick(item.permissions),
          },
          {
            default: () => [
              item.icon
                ? h(resolveComponent('CIcon'), {
                    customClassName: 'nav-icon',
                    name: item.icon,
                  })
                : h('span', { class: 'nav-icon' }, h('span', { class: 'nav-icon-bullet' })),
              item.name,
              item.external && h(resolveComponent('CIcon'), {
                class: 'ms-2',
                name: cilExternalLink,
                size: 'sm'
              }),
              item.badge &&
                h(
                  CBadge,
                  {
                    class: 'ms-auto',
                    color: item.badge.color,
                    size: 'sm',
                  },
                  {
                    default: () => item.badge.text,
                  },
                ),
            ],
          },
        )
      }

      return item.to
        ? h(
            RouterLink,
            {
              to: item.to,
              custom: true,
              onClick: () => handleSubMenuClick(item.permissions),
            },
            {
              default: (props) =>
                h(
                  resolveComponent(item.component),
                  {
                    active: props.isActive,
                    as: 'div',
                    href: props.href,
                    onClick: () => {
                      props.navigate();
                      handleSubMenuClick(item.permissions); // Handle submenu click
                    },
                  },
                  {
                    default: () => [
                      item.icon
                        ? h(resolveComponent('CIcon'), {
                            customClassName: 'nav-icon',
                            name: item.icon,
                          })
                        : h('span', { class: 'nav-icon' }, h('span', { class: 'nav-icon-bullet' })),
                      item.name,
                      item.badge &&
                        h(
                          CBadge,
                          {
                            class: 'ms-auto',
                            color: item.badge.color,
                            size: 'sm',
                          },
                          {
                            default: () => item.badge.text,
                          },
                        ),
                    ],
                  },
                ),
            },
          )
        : h(
            resolveComponent(item.component),
            {
              as: 'div',
              onClick: () => handleSubMenuClick(item.permissions),
            },
            {
              default: () => item.name,
            },
          )
    }

    return () =>
      h(
        CSidebarNav,
        {
          as: simplebar,
        },
        {
          default: () =>
            navItems.value && navItems.value.length > 0
              ? navItems.value.map((item) => renderItem(item))
              : '' // Fallback content
        },
      )
  },
})

export { AppSidebarNav }
