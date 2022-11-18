<script lang="ts">
	// import { getContext } from 'svelte';
	// const { close } = getContext('simple-modal');
	// TODO close has no type https://github.com/flekschas/svelte-simple-modal/issues/88
	// import { confObj } from '$lib/functions/stores';
	// import { onMount } from 'svelte';
	// import { get } from 'svelte/store';

	export let loggedIn = () => {};

	import { passwordST, remembermeST } from '$admin/functions/stores';
	// export let rememberme: boolean;
	// rememberme = $remembermeST == 'true' ? true : false;
	let value: string = $passwordST || '1234';
	value = value.replace(/^"|"$/g, '');
	let again: string = $remembermeST ? 'again' : '';

	if ($passwordST) {
		// console.log($passwordST);
		// console.log(passwordST);
		console.log(value);
		onSubmit();
	}

	function onSubmit() {
		fetch('http://localhost:9999/API?login', {
			method: 'POST',
			// mode: 'same-origin',
			// credentials: 'same-origin',
			mode: 'cors',
			headers: {
				'Content-Type': 'application/json',
				'Access-Control-Allow-Origin': '*',
				Accept: 'application/json'
			},
			body: JSON.stringify({
				password: value
			})
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.data.login === true) {
					// console.log(value);
					if ($remembermeST) {
						window.localStorage.setItem('PRFX_rememberme', 'true');
					} else {
						window.localStorage.setItem('PRFX_rememberme', 'false');
					}
					passwordST.set(value);
					loggedIn();
				} else {
					errorMsg = 'wrong password';
				}
			});
	}
	$: errorMsg = '';

	// DEBUG
	// $: console.log($remembermeST);
	// $: console.log($passwordST);
	// $: console.log('PRFX_rememberme', window.localStorage.getItem('PRFX_rememberme'));
	// $: console.log('PRFX_password', window.localStorage.getItem('PRFX_password'));
</script>

<fieldset>
	<legend>Login</legend>
	<form>
		<ul>
			<li>
				<label for="password">Password</label>
				<input id="password" type="text" bind:value />
			</li>
			<li class="inline">
				<label for="store">
					remember me {again}
					<span class="switch">
						<input type="checkbox" name="store" id="store" bind:checked={$remembermeST} />
						<span class="switchSlider" />
					</span>
				</label>
			</li>
			<li>
				<input type="submit" on:click|preventDefault={onSubmit} value="Okay" />
				<span class="error">{errorMsg}</span>
			</li>
		</ul>
	</form>
</fieldset>

<style>
	.error {
		color: var(--red);
		text-align: center;
		padding-left: 1rem;
	}
</style>
