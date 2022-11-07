<script lang="ts">
	// import { onMount } from 'svelte';
	// import { base } from '$app/paths';
	// import { page } from '$app/stores';
	import { fade } from 'svelte/transition';

	// // modals
	// import { openFormModal,openDialogModal } from '$lib/functions/stores';
	// // FORM MODAL
	// import Form from './modals/Form.svelte';
	// let isopenFormModal: boolean;
	// openFormModal.subscribe((value) => {
	// 	isopenFormModal = value;
	// });
	// function toggleFormModal() {
	// 	openFormModal.update((n) => !n);
	// }
	// // DIALOG MODAL
	// import Dialog from './modals/Dialog.svelte';
	// let isopenDialogModal: boolean;
	// openDialogModal.subscribe((value) => {
	// 	isopenDialogModal = value;
	// });
	// function toggleDialogModal() {
	// 	openDialogModal.update((n) => !n);
	// }

	import Form from './modals/Form.svelte';
	import Dialog from './modals/Dialog.svelte';
	import { writable } from 'svelte/store';
	import Modal from 'svelte-simple-modal';
	const modal = writable(null);
	const showModal = () => modal.set(Form);
	const showModalDialog = () => modal.set(Dialog);
</script>

<!-- {#if isopenFormModal}
	<div transition:fade class="modal" on:click|self={toggleFormModal} on:keydown|self={toggleFormModal}>
		<Form />
	</div>
{/if}



{#if isopenDialogModal}
<div transition:fade class="modal" on:click|self={toggleDialogModal} on:keydown|self={toggleDialogModal}>
	<Dialog message={'test'} />
	</div>
{/if} -->

<nav>
	<h2>Navigation</h2>
	<ul>
		<Modal show={$modal}><li><a href="/#" on:click={showModal}>Form</a></li></Modal>
		<Modal show={$modal}><li><a href="/#" on:click={showModalDialog}>Dialog</a></li></Modal>
	</ul>

	<!-- <ul>
		<li><a href="/#" on:click={toggleDialogModal} on:keydown={toggleDialogModal}>Dialog</a></li>
		<li><a href="/#" on:click={toggleFormModal} on:keydown={toggleFormModal}>Form</a></li>
	</ul> -->

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
