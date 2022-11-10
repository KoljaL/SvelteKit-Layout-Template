<script lang="ts">
	import Login from '../lib/layout/modals/Login.svelte';
	import { writable } from 'svelte/store';
	import Modal, { bind } from 'svelte-simple-modal';
	import { confObj } from '$lib/functions/stores';
	import EmptyComponent from '$lib/layout/EmptyComponent.svelte';

	const loginModal = writable(null);
	if ($confObj.get('password') === '') {
		loginModal.set(bind(Login, { callbackFCN }));
	}

	function callbackFCN() {
		loginModal.set(null);
	}

	$: console.info('%cconfObj', 'color:limegreen', $confObj);
	$: console.info('%cconfObj', 'color:limegreen', window.localStorage.getItem('ConfigHolder'));
</script>

<!-- LOGIN MODAL -->
<Modal show={$loginModal} closeOnEsc={false} closeOnOuterClick={false} closeButton={false} styleWindow={{ backgroundColor: 'transparent', 'max-width': 'max-content' }} styleBg={{ background: 'rgba(0, 0, 0, 0.95)' }} />

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
