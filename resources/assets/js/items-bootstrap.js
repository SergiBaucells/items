// Register components
Vue.component('items-example', require('./components/ItemsExampleComponent.vue'));
Vue.component('users', require('./components/Users.vue'));

import { config } from './config/items'

window.acacha_items = {}
window.acacha_items.config = config