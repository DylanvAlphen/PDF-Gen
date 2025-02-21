import { createRouter, createWebHistory } from 'vue-router'
import CertificateForm from '../views/CertificateForm.vue'

const routes = [{ path: '/', component: CertificateForm }]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
