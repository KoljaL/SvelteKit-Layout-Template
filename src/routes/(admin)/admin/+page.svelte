<script lang="ts">
	import Login from '$admin/layout/modals/Login.svelte';
	import { writable } from 'svelte/store';
	import Modal, { bind } from 'svelte-simple-modal';
	import { passwordST, ContentComponent, TableRows } from '$admin/functions/stores';

	const loginModal = writable(null);
	if (!$passwordST) {
		loginModal.set(bind(Login, { loggedIn }));
	}

	function loggedIn() {
		loginModal.set(null);
	}

	// $: console.info('%cconfObj', 'color:limegreen', $confObj);
	// $: console.info('%cconfObj', 'color:limegreen', window.localStorage.getItem('ConfigHolder'));
</script>

<!-- LOGIN MODAL -->
<Modal show={$loginModal} closeOnEsc={false} closeOnOuterClick={false} closeButton={false} styleWindow={{ backgroundColor: 'transparent', 'max-width': 'max-content' }} styleBg={{ background: 'rgba(0, 0, 0, 0.95)' }} />

<!-- PAGE CONTENT -->
<div class="center">
	<h2>a wonderfull Startpage :-)</h2>

	{#if $ContentComponent}
		<!-- {$ContentComponent.name} -->
		<svelte:component this={$ContentComponent} />
	{/if}
</div>

<style>
	.center {
		width: max-content;
		margin-inline: auto;
	}
</style>
