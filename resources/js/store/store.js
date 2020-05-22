import Vue from 'vue';
import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

const API_BASE_URL = process.env.MIX_API_BASE_URL;

export const store = new Vuex.Store({
	state: {

		isLoading: false,
		user: null,
		error: null

	},

	mutations: { // mutations change the state but do not return any state values unlike getters where state values are returned

		login: (state, { user }) => {

			state.user = user;
			state.isLoading = false; // stop loading
		},

		error: (state, { response }) => {

			state.error = response.data.message;
			state.isLoading = false; // stop loading

		}

	},

	actions: {
		login: (context, payload) => {

			context.state.isLoading = true;

			const { username, password } = payload;

			axios
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

		}
	}
})