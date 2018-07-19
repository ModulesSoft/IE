import Home from './components/Home.vue';
import Categories from './components/Categories.vue';
// import PageNotFound from './components/PageNotFound.vue';
import Product from './components/Product.vue';
import Cart from './components/Cart.vue';

export const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/product/:id', component: Product, name: 'product' },
    { path: '/search/:keyword', component: Categories, name: 'categories' },
    { path: '/cart', component: Cart, name: 'cart' },
    // { path: "*", component: PageNotFound }
];