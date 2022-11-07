<script lang="ts">
	// import { onMount } from 'svelte';
	// import { base } from '$app/paths';
	// import { page } from '$app/stores';
	import { fade } from 'svelte/transition';

	// modals
	import { openFormModal,openDialogModal } from '$lib/functions/stores';


	// FORM MODAL
	import Form from './modals/Form.svelte';
	let isopenFormModal: boolean;
	openFormModal.subscribe((value) => {
		isopenFormModal = value;
	});
	function toggleFormModal() {
		openFormModal.update((n) => !n);
	}

	// DIALOG MODAL
	import Dialog from './modals/Dialog.svelte';
	let isopenDialogModal: boolean;
	openDialogModal.subscribe((value) => {
		isopenDialogModal = value;
	});
	function toggleDialogModal() {
		openDialogModal.update((n) => !n);
	}
	 
</script>

{#if isopenFormModal}
	<div transition:fade class="modal" on:click|self={toggleFormModal} on:keydown|self={toggleFormModal}>
		<Form />
	</div>
{/if}



{#if isopenDialogModal}
<div transition:fade class="modal" on:click|self={toggleDialogModal} on:keydown|self={toggleDialogModal}>
	<Dialog />
	</div>
{/if}
 
<nav>
	<h2>Navigation</h2>

	<ul>
		<li on:click={toggleDialogModal} on:keydown={toggleDialogModal}>Dialog</li>
		<li on:click={toggleFormModal} on:keydown={toggleFormModal}>Form</li>
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
	.modal {
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
	}
	nav {
		flex-shrink: 0;
		width: var(--sidebar-width);
		height: calc(var(--main-height) - 1px);
		border-right: 1px solid var(--border-color);
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

	:global(.medium nav) {
		overflow: hidden;
		position: absolute;
		width: 0;
		transform: translateX(calc(var(--sidebar-width) * -1));
	}

	:global(.medium.noSidebar nav) {
		width: var(--sidebar-width);
		transform: translateX(0);
		position: absolute;
		height: calc(var(--main-height) - 1px);
		transition: transform 1s;
	}
</style>
