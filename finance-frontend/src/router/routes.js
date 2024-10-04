import { createRouter, createWebHistory } from 'vue-router';
import MonthlyChecklist from '@/Pages/MonthlyChecklist.vue';

const routes = [
  { path: '/', redirect: '/checklist' },
  { path: '/checklist', component: MonthlyChecklist, name: 'checklist' },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
