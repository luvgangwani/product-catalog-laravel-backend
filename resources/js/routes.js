import Home from './components/Home';
import PageNotFound from './components/Errors/PageNotFound';
import Register from './components/Auth/Register';
import Login from './components/Auth/Login';
import ProductsAdmin from './components/Admin/ProductsAdmin';
import CategoriesAdmin from './components/Admin/CategoriesAdmin';
import UsersAdmin from './components/Admin/UsersAdmin';

export default [

	{
		path: '/',
		component: Home
	},
	{
		path: '/admin/login',
		component: Login
	},
	{
		path: '/admin/products',
		component: ProductsAdmin,
		redirect: localStorage.getItem('accessToken') === "null" ? '/admin/login' : '/admin/products'
	},
	{
		path: '/admin/categories',
		component: CategoriesAdmin,
		redirect: localStorage.getItem('accessToken') === "null" ? '/admin/login' : '/admin/categories'
	},
	{
		path: '/admin/users',
		component: UsersAdmin,
		redirect: localStorage.getItem('accessToken') === "null" ? '/admin/login' : '/admin/users'
	},
	{
		path: '/user/register',
		component: Register
	},
	{
		path: '*',
		component: PageNotFound
	},

]