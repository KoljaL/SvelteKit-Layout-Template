<script lang="ts">
	// import { onMount } from 'svelte';
	// import { base } from '$app/paths';
	// import { page } from '$app/stores';
	// import { fade } from 'svelte/transition';
	import { writable } from 'svelte/store';

	import Modal, { bind } from 'svelte-simple-modal';
	import Form from './modals/Form.svelte';
	import Dialog from './modals/Dialog.svelte';
	const modal = writable(null);
	const showForm = () => modal.set(bind(Form, { message: '' }));
	const showDialog = () =>
		modal.set(bind(Dialog, { title: 'Confirm', text: 'Delete row 3?', onCancel, onOkay }));
	const onCancel = () => {
		console.log('cancel');
	};
	const onOkay = () => {
		console.log('okay');
	};

	import DatabaseExplorer from './modals/DatabaseExplorer.svelte';

	let ContentComponent: any = null;
	function handleChange(ev: any) {
		ContentComponent = ev.detail.state;
		console.log(ev);
	}
</script>

<Modal show={$modal} styleWindow={{ backgroundColor: 'transparent', 'max-width': 'max-content' }} />

<nav>
	<h2>Navigation</h2>
	<ul>
		<li><a href="/#" on:click={showForm}>Form</a></li>
		<li><a href="/#" on:click={showDialog}>Dialog</a></li>
	</ul>

	<DatabaseExplorer on:change={handleChange} />
</nav>

<style>
	nav {
		flex-shrink: 0;
		width: var(--sidebar-width);
		height: calc(var(--main-height));
		border-right: 1px solid var(--border-color);
		border-top-left-radius: var(--page-radius);
		border-bottom-left-radius: var(--page-radius);
		background-color: var(--bg-sidebar);
		z-index: 10;
		position: relative;
		padding: 0.5rem;
	}

	:global(.medium nav, .small nav) {
		overflow: hidden;
		position: absolute;
		width: 0;
		transform: translateX(calc(var(--sidebar-width) * -1));
	}

	:global(.medium.noSidebar nav, .small.noSidebar nav) {
		width: var(--sidebar-width);
		transform: translateX(0);
		position: absolute;
		height: calc(var(--main-height) - 2px);
		transition: transform 1s;
	}
</style>
