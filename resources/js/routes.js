//Staff Routes
import Welcome from './components/welcomeComponent.vue'
import Create from './components/CreateComponent.vue'
import Edit from './components/EditComponent.vue'

// Departments 
import Departments from './components/DepartmentsComponent.vue'

export default {
    mode: 'history',
    // base: '/laravel_veu_demo/',
    fallback :true,
    routes : [
        {
            path: '/',
            component : Welcome,
            name: 'Welcome'
        },
        {
            path: '/Create',
            component: Create,
        },
        {
            name: 'edit',
            path: '/edit/:id',
            component: Edit,
        },
        {
            path: '/departments',
            component: Departments,
        },
    ]
}