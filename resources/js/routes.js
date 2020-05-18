import Home from './components/Home';
import PageNotFound from './components/Errors/PageNotFound';
import Register from './components/Auth/Register';
import Login from './components/Auth/Login';

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
		path: '/user/register',
		component: Register
	},
	{
		path: '*',
		component: PageNotFound
	},

]