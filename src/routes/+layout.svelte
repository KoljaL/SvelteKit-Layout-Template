<script>
	import { page } from '$app/stores';
	import { onMount } from 'svelte';
	export let get;
	console.log($page);
	// import appCSS from '$lib/layout/css/latex.css';
	// import adminCSS from '$admin/layout/css/admin.css';

	// $: adminCSSTAG = document.getElementById('adminCSS') || '';
	// $: console.log(adminCSSTAG);
	$: queryParam = new URLSearchParams(location.search).get('id');
	$: console.log(queryParam);
	let CSS;

	onMount(async () => {
		// if ($page.url.pathname.includes('admin')) {
		// 	console.log('ADMIN');
		// 	CSS = import('$admin/layout/css/admin.css');
		// } else {
		// 	console.log('APP');
		// 	CSS = import('$lib/layout/css/latex.css');
		// }
	});

	$: console.log(get);
</script>

<slot />
