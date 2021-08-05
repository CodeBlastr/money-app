import AuthorizedComponent from './authorized.vue';
import DashboardRoutes from './dashboard/dashboard.routes';
import SetupRoutes from './setup/setup.routes';

export default {
    path: '',
    name: 'home',
    component: AuthorizedComponent,
    meta: {
        requiresAuth: true,
    },
    children: [
        DashboardRoutes,
        SetupRoutes
    ]
};
