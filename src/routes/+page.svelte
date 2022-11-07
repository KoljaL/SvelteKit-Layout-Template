<script lang="ts">
	import Login from '../lib/layout/modals/Login.svelte';
	import { writable } from 'svelte/store';
	import Modal, { bind } from 'svelte-simple-modal';
	let errorMsg: string = '';

	const loginModal = writable(null);
	const showLogin = () => {
		loginModal.set(bind(Login, { title: 'Login', text: errorMsg, callbackFCN }));
	};

	const callbackFCN = (password: string) => { 
		fetch('http://localhost:9999/API?login', {
			method: 'POST',
			// mode: 'same-origin',
			mode: 'cors',
			// credentials: 'same-origin',
			headers: {
				'Content-Type': 'application/json',
				  'Access-Control-Allow-Origin':'*',
				Accept: 'application/json'
			},
			body: JSON.stringify({
				password: password
			})
		})
			.then((response) => response.json())
			.then((data) => {
				console.log(data);
			});

		if (password === '123') {
			loginModal.set(null);
		} else {
			errorMsg = 'wrong password';
			showLogin();
		}
	};
	showLogin();
</script>

<!-- LOGIN MODAL -->
<Modal
	show={$loginModal}
	closeOnEsc={false}
	closeOnOuterClick={false}
	closeButton={false}
	styleWindow={{ backgroundColor: 'transparent', 'max-width': 'max-content' }}
	styleBg={{ background: 'rgba(0, 0, 0, 0.95)' }}
/>

<!-- PAGE CONTENT -->
<div class="center">
	<h2>a wonderfull Startpage :-)</h2>
</div>

<style>
	.center {
		width: max-content;
		margin-inline: auto;
	}
</style>
