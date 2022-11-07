<script lang="ts">
	// import { onMount } from 'svelte';
	// import { base } from '$app/paths';
	// import { page } from '$app/stores';
	import { fade } from 'svelte/transition';

	import Form from './modals/Form.svelte';
	import Dialog from './modals/Dialog.svelte';
	import CloseButton from './modals/CloseButton.svelte';
	import { writable } from 'svelte/store';
	import Modal, { bind } from 'svelte-simple-modal';

	const modal = writable(null);
	const showForm = () => modal.set(bind(Form, { message: ""}));


	const showDialog = () => modal.set(bind(Dialog, { title: 'Confirm', text: 'Delete row 3?',onCancel,onOkay }));
 	const onCancel = () => {
		console.log('cancel')
	};
	const onOkay = () => {
		console.log('okay')
		};
</script>

<!-- 
	styleWindow={{ backgroundColor: 'var(--bg-main); border: 1px solid var(--border-color);' }} 
	closeButton={CloseButton}
	-->

<Modal show={$modal} styleWindow={{ backgroundColor: 'transparent', 'max-width':'max-content' }} />

<nav>
	<h2>Navigation</h2>
	<ul>
		<li><a href="/#" on:click={showForm}>Form</a></li>
		<li><a href="/#" on:click={showDialog}>Dialog</a></li>
	</ul>
 
	<h3>Catrgorie 1</h3>
	<ul>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
	</ul>

	<h3>Catrgorie 1</h3>
	<ul>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
	</ul>
</nav>

<style>
	/* .modal {
		position: absolute;
		top: 0;
		left: 0;
		width: 100vw;
		height: 100vh;
		background: var(--bg-footer);
		opacity: 0.95;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: center;
		z-index: 100;
	} */
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

	h2,
	h3 {
		margin-bottom: 0;
		border-bottom: 1px solid var(--border-color);
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
