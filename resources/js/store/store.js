import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

const API_BASE_URL = process.env.MIX_API_BASE_URL;

export const store = new Vuex.Store({
	state: {

		isLoading: false,
		user: null,
		categories: null,
		products: null,
		error: null,
		successMessage: null,

	},

	getters: {
		user: (state) => state.user,
		categories: (state) => state.categories,
		products: (state) => state.products,
		error: (state) => state.error,
		isLoading: (state) => state.isLoading,
		successMessage: (state) => state.successMessage
	},

	mutations: { // mutations change the state but do not return any state values unlike getters where state values are returned

		login: (state, { user, access_token, message }) => {

			state.user = user;
			state.error = null; // remove any error messages
			state.isLoading = false; // stop loading
			state.successMessage = message

			localStorage.setItem('accessToken', access_token);
		},

		getUserByUserId: (state, { data, message }) => {
			state.user = data;
			state.error = null;
			state.isLoading = false;
			state.successMessage = message
		},

		addCategory: (state, { data, message }) => {
			state.isLoading = false;
			state.categories = [...state.categories, data]
			state.successMessage = message
			state.error = null;
		},

		getAllCategories: (state, { data }) => {

			state.categories = data;
			state.isLoading = false;

		},

		getAllProducts: (state, { data }) => {
			state.products = data;
			state.isLoading = false;
		},

		logout:(state) => {

			localStorage.setItem('accessToken', null);

			state.user = null;
			state.error = null;
			state.successMessage = null;
			state.isLoading = false;

		},

		error: (state, { response }) => {

			state.error = response.data.message;
			state.isLoading = false; // stop loading
			state.user = null;
			state.successMessage = null;

			/* if (localStorage.getItem('accessToken') != "null")
				localStorage.setItem('accessToken', null); */

		}

	},

	actions: {
		login: async (context, payload) => {

			context.state.isLoading = true;

			const { username, password } = payload;

			await axios
			.post(
				`${API_BASE_URL}/users/login`,
				{
					username,
					password
				},
				{
					headers: {
						'Accept': 'application/json'
				}
			})
			.then(response => {
				context.commit('login', response.data);
			})
			.catch(error => {
				context.commit('error', error);
			});

		},

		getUserByUserId: async (context) => {

			context.state.isLoading = true;

			await axios
					.post(
						`${API_BASE_URL}/users/getUserById`,
						{},
						{
							headers: {
								'Accept': 'application/json',
								'Authorization': `Bearer ${localStorage.getItem('accessToken')}` 
							}
						}
					)
					.then(response => {
						context.commit('getUserByUserId', response.data);
					})
					.catch(error => {
						context.commit('error', error);
					})

		},

		getAllCategories: async (context) => {

			context.state.isLoading = true;

			await axios
					.get(
						`${API_BASE_URL}/categories`,
						{
							headers: {
								'Accept': 'application/json'
							}
						}
					)
					.then(response => {
						context.commit('getAllCategories', response.data);
					})
					.catch(error => {
						context.commit('error', error);
					})
		},

		getAllProducts: async (context) => {
			context.state.isLoading = true;

			await axios
					.get(
						`${API_BASE_URL}/products`,
						{
							headers: {
								'Accept': 'application/json'
							}
						}
					)
					.then(response => {
						context.commit('getAllProducts', response.data);
					})
					.catch(error => {
						context.commit('error', error)
					})
		},

		addCategory: async (context, { category_name, category_url, parent_id}) => {

			context.state.isLoading = true;

			await axios
					.post(
						`${API_BASE_URL}/categories/store`,
						{
							category_name,
							category_url,
							parent_id
						},
						{
							headers: {
								'Accept' : 'application/json',
								'Authorization': `Bearer ${localStorage.getItem('accessToken')}`
							}
						}
					)
					.then(response => {
						context.commit('addCategory', response.data)
					})
					.catch(error => {
						context.commit('error', error)
					});

		},

		logout: async (context) => {
			
			context.state.isLoading = true;

			await context.commit('logout');
		}
	}
})