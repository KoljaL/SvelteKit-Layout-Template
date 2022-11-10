<script lang="ts">
	// This can be false if you're using a fallback (i.e. SPA mode)
	export const prerender = false;
	// styles
	import '../style.css';
	// page layouts
	import Meta from '../lib/layout/Meta.svelte';
	import Header from '../lib/layout/Header.svelte';
	import Footer from '../lib/layout/Footer.svelte';
	import Sidebar from '../lib/layout/Sidebar.svelte';
	// Svelte stuff
	import { fade } from 'svelte/transition';
	import { onMount } from 'svelte';
	// import type { SvelteComponentTyped } from "svelte";

	import { ContentComponent } from '$lib/functions/stores';

	// add class to <body>
	import watchMedia from '../lib/functions/matchMedia';
	export const media = watchMedia({
		small: '(max-width: 349px)',
		medium: '(min-width: 350px) and (max-width: 649px)',
		large: '(min-width: 650px)'
	});
	// has to be called, to write classNames in <body>
	let mediaSize = $media.classNames;

	//
	// login modal
	import Login from '../lib/layout/modals/Login.svelte';
	import { writable } from 'svelte/store';
	import Modal, { bind } from 'svelte-simple-modal';
	import { confObj } from '$lib/functions/stores';
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

<!-- ADD META INFORMATION TO HTML HEAD -->
<Meta meta />
<Modal show={$loginModal} closeOnEsc={false} closeOnOuterClick={false} closeButton={false} styleWindow={{ backgroundColor: 'transparent', 'max-width': 'max-content' }} styleBg={{ background: 'rgba(0, 0, 0, 0.95)' }} />

<!-- PAGE HEADER -->
<Header />
<!-- PAGE BODY -->
<main>
	<Sidebar />
	<article>
		<svelte:component this={$ContentComponent} />

		<!-- <slot /> -->
	</article>
</main>

<!-- PAGE FOOTER -->
<Footer />

<!-- STYLESHEET -->
<style>
	main {
		flex-grow: 1;
		width: 100%;
		display: flex;
		flex-direction: row;
		border: 1px solid var(--border-color);
		border-radius: var(--page-radius);
		/* max-height: var(--main-height); */
	}

	article {
		width: 100%;
	}
</style>
