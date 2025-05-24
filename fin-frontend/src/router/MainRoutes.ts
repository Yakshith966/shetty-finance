const MainRoutes = [
    {
      path: '/main',
      meta: {
        requiresAuth: true
      },
      redirect: '/main',
      component: () => import('@/layouts/full/FullLayout.vue'),
      children: [
        {
          name: 'Dashboard',
          path: '/',
          component: () => import('@/views/dashboard/index.vue')
        },
        {
          name: 'LoanManagement',
          path: '/loan-management',
          component: () => import('@/views/components/LoanManagement.vue')
        },
        {
          name: 'LoanCreate',
          path: '/loan-create',
          component: () => import('@/views/components/LoanForm.vue')
        },
        {
          name: 'Typography',
          path: '/ui/typography',
          component: () => import('@/views/components/Typography.vue')
        },
        {
          name: 'Shadow',
          path: '/ui/shadow',
          component: () => import('@/views/components/Shadow.vue')
        },
        {
          name: 'Icons',
          path: '/icons',
          component: () => import('@/views/pages/Icons.vue')
        },
        {
          name: 'Starter',
          path: '/sample-page',
          component: () => import('@/views/pages/SamplePage.vue')
        },
      ]
    }
  ];
  
  export default MainRoutes;
  