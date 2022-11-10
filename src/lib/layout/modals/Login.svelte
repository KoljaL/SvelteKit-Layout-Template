<script lang="ts">
	// import { getContext } from 'svelte';
	// const { close } = getContext('simple-modal');
	// TODO close has no type https://github.com/flekschas/svelte-simple-modal/issues/88

	import { confObj } from '$lib/functions/stores';

	// import { get } from 'svelte/store';
	import { preferences } from '$admin/functions/stores';

	export let callbackFCN = () => {};
	let value: string = '123';
	export let rememberme: boolean;

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
					$confObj.set('password', data.data.password);
					$confObj.set('rememberme', rememberme || false);
					$confObj = $confObj;
					// close();
					callbackFCN();
				} else {
					errorMsg = 'wrong password';
				}
			});
	}
	$: errorMsg = '';
</script>

<fieldset>
	<legend>Login</legend>
	<form>
		<ul>
			<li>
				<label for="password">Password</label>
				<input id="password" type="password" bind:value />
			</li>
			<li class="inline">
				<label for="store">
					remember me
					<span class="switch">
						<input type="checkbox" name="store" id="store" bind:checked={rememberme} />
						<span class="switchSlider" />
					</span>
				</label>
			</li>
			<li>
				<input type="submit" on:click|preventDefault={onSubmit} value="Okay" />
				<span class="error">{errorMsg}</span>
				{$preferences.theme}
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
