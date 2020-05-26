import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

const API_BASE_URL = process.env.MIX_API_BASE_URL;

export const store = new Vuex.Store({
	state: {

		isLoading: false,
		user: null,
		error: null,
		successMessage: null,

	},

	getters: {
		user: (state) => state.user,
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

			if (localStorage.getItem('accessToken') != "null")
				localStorage.setItem('accessToken', null);

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

		logout: async (context) => {
			
			context.state.isLoading = true;

			await context.commit('logout');
		}
	}
})