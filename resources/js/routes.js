import Home from './components/Home';
import PageNotFound from './components/Errors/PageNotFound';
import Register from './components/Auth/Register';
import Login from './components/Auth/Login';
import ProductsAdmin from './components/Admin/ProductsAdmin';
import CategoriesAdmin from './components/Admin/CategoriesAdmin';
import UsersAdmin from './components/Admin/UsersAdmin';

export default [

	{
		path: '/admin',
		component: Home
	},
	{
		path: '/admin/login',
		component: Login
	},
	{
		path: '/admin/products',
		component: ProductsAdmin
	},
	{
		path: '/admin/categories',
		component: CategoriesAdmin
	},
	{
		path: '/admin/users',
		component: UsersAdmin
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