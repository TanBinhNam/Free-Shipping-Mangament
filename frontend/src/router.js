import { createRouter, createWebHistory } from 'vue-router'

import TheContainer from './components/TheContainer.vue'
import FreeShip from './components/FreeShip/FreeShip.vue'
import List from './components/FreeShip/List.vue'
import Create from './components/FreeShip/Create.vue'
import History from './components/FreeShip/History.vue'
import Edit from './components/FreeShip/Edit.vue'

const routes = [
    {
        path: '/',
        redirect: '/free_shipping',
        component: TheContainer,
        children: [
            {
              path: 'free_shipping',
              name: 'FreeShip',
              component: FreeShip,
              children: [
                {
                    path: '/free_shipping',
                    component: List,
                },
                {
                    path: '/free_shipping/create',
                    component: Create, 
                },
                {
                    path: '/free_shipping/history',
                    component: History, 
                },
                {
                    path: '/free_shipping/:id/edit',
                    component: Edit, 
                },
            ],
            },
        ],
    },
]


const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router
