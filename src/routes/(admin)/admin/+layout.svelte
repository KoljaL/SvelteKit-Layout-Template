<script lang="ts">
	// This can be false if you're using a fallback (i.e. SPA mode)
	export const prerender = false;
	// styles
	import '$admin/layout/css/admin.css';
	// page layouts
	import Meta from '$admin/layout/Meta.svelte';
	import Header from '$admin/layout/Header.svelte';
	import Footer from '$admin/layout/Footer.svelte';
	import Sidebar from '$admin/layout/Sidebar.svelte';
	// Svelte stuff
	import { fade } from 'svelte/transition';
	import { onMount } from 'svelte';
	// import type { SvelteComponentTyped } from "svelte";

	// add class to <body>
	import watchMedia from '$lib/functions/matchMedia';
	export const media = watchMedia({
		small: '(max-width: 349px)',
		medium: '(min-width: 350px) and (max-width: 649px)',
		large: '(min-width: 650px)'
	});
	// has to be called, to write classNames in <body>
	let mediaSize = $media.classNames;

	// $: console.info('%cconfObj', 'color:limegreen', $confObj);
	// $: console.info('%cconfObj', 'color:limegreen', window.localStorage.getItem('ConfigHolder'));
</script>

<!-- ADD META INFORMATION TO HTML HEAD -->
<Meta meta />

<!-- PAGE HEADER -->
<Header />
<!-- PAGE BODY -->
<main>
	<Sidebar />
	<article>
		<slot />
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
