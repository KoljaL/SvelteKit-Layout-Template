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
	import EmptyComponent from '$lib/layout/EmptyComponent.svelte';
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

 
</script>

<!-- ADD META INFORMATION TO HTML HEAD -->
<Meta meta />

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
