<script lang="ts">
	import { onMount } from 'svelte';
	import { base } from '$app/paths';
	import { page } from '$app/stores';
</script>

<nav>

	<h2>Navigation</h2>


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
		padding:.5rem;
	}

	h2,h3{
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
