require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import MainApp from './components/Main.vue';
import CalendarApp from './components/Calendar.vue';
import Notifications from "vt-notifications";

Vue.use(VueRouter);
Vue.use(Notifications);

const Calendar = CalendarApp
const Activities = { template: '<div>Activities</div>' }

const routes = [
    { 
        path: '/entry',
        name: 'Entry',
        component: Calendar
    },
    { 
        path: '/events',
        name: 'Events',
        component: Activities
    },    
]

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router,
    components: {
        MainApp
    }
});
