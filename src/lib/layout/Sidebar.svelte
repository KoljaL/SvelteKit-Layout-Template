<script lang="ts">
	import { onMount } from 'svelte';
	import { fly } from 'svelte/transition';

	import { base } from '$app/paths';
	import { page } from '$app/stores';
	//   import { writable } from 'svelte/store';
	import { bind } from 'svelte-simple-modal';
	// import { modal } from '../functions/stores.js';
	// import Form from './modals/form.svelte';
	// let opening = false;
	// let opened = false;
	// let closing = false;
	// let closed = false;

	// const showPopupWithProps = () => {
	// 	modal.set(bind(Form, { message: "It's a customized popup!" }));
	// };

  import { writable } from 'svelte/store';
  import Modal from 'svelte-simple-modal';
  const modal = writable(null);
	import Popup from './modals/form.svelte';
	import Popup1 from './modals/form1.svelte';
  // const showModal = () => modal.set(Popup);

		const showModal = () => {
		modal.set(bind(Popup, { message: "It's a customized 0!" }));
	};

			const showModal1 = () => {
		modal.set(bind(Popup1, { message: "It's a customized 1!" }));
	};

</script>
<Modal show={$modal}></Modal>

<nav>
	<h2>Navigation</h2>
	<!-- <button on:click={showPopupWithProps}>Show</button> -->

  <button on:click={showModal}>Show modal</button>
  <button on:click={showModal1}>Show modal</button>

	<h3>Catrgorie 1</h3>
	<ul>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
		<li><a href="/#">Item</a></li>
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
