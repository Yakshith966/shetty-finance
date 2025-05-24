import { createRouter, createWebHistory } from 'vue-router';
import MainRoutes from './MainRoutes';
import AuthRoutes from './AuthRoutes';
import store from '@/stores/store';

export const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    ...MainRoutes,
    ...[AuthRoutes], 
    {
      path: '/:pathMatch(.*)*',
      component: () => import('@/views/pages/Error404.vue')
    }
  ]
});

// 🔒 Global navigation guard
router.beforeEach((to, from, next) => {
  const token = store.getters.getToken;

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!token) {
      return next('/auth/login');
    }
  }

  if (to.path === '/auth/login' && token) {
    return next('/');
  }

  next();
});
