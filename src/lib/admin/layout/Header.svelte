<script lang="ts">
	import { goto } from '$app/navigation';
	import ColorMode from './ColorMode.svelte';
	import Logo from './svg/dbLogo.svelte';
	import Logout from './svg/logout.svelte';
	import Home from './svg/home.svelte';
	import Menu from './svg/menu.svelte';
	import { passwordST, remembermeST } from '$admin/functions/stores';

	function toggleSidebar() {
		document.body.classList.toggle('noSidebar');
	}

	function logout() {
		// empty stores
		passwordST.set('');
		remembermeST.set('');

		// empty localStorage
		let localItems = window.localStorage;
		for (var key in localItems) {
			if (localItems.hasOwnProperty(key)) {
				// console.log(key.slice(0, 5));
				if (key.slice(0, 5) === 'PRFX_') {
					window.localStorage.removeItem(key);
				}
			}
		}
		// location.reload()
		home();
	}

	function home() {
		goto('/');
	}
</script>

<header>
	<div class="left">
		<div class="logo">
			<Logo />
		</div>
		<div class="pagename">DB Editor</div>
	</div>
	<div class="breadcrumb">
		<span class="showDatabase" />
		<span class="showTable" />
		<span class="showInfo" />
	</div>

	<div class="right">
		<span class="home SVGicon" on:click={home} on:keydown={home}>
			<Home />
		</span>
		<span class="logout SVGicon" on:click={logout} on:keydown={logout}>
			<Logout />
		</span>
		<span class="toggleSidebar SVGicon" on:click={toggleSidebar} on:keydown={toggleSidebar}>
			<Menu />
		</span>
		<span class="colorMode SVGicon">
			<ColorMode />
		</span>
	</div>
</header>

<style>
	header .left {
		display: flex;
		flex-direction: row;
		align-items: end;
	}
	header .logo {
		cursor: pointer;
		width: calc(var(--header-height) - 10px);
		height: calc(var(--header-height) - 10px);
		margin-top: 5px;
		margin-bottom: 5px;
	}

	header .pagename {
		margin-left: 1rem;
		padding-bottom: 0.5rem;
		font-size: 2rem;
	}

	header {
		flex-shrink: 0;
		height: var(--header-height);
		background-color: var(--bg-header);
		padding-inline: 1rem;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
	}

	header .SVGicon {
		width: 24px;
		height: 24px;
		stroke: var(--text-color);
		fill: var(--text-color);
		cursor: pointer;
	}

	header .SVGicon:hover {
		stroke: var(--blue);
		fill: var(--blue);
	}

	header .right {
		display: flex;
		flex-direction: row;
		align-items: end;
		gap: 1rem;
		height: 24px;
	}

	.toggleSidebar {
		display: none;
	}

	:global(.medium .toggleSidebar, .small .toggleSidebar) {
		display: inline !important;
	}

	header .breadcrumb {
		min-width: max-content;
		align-self: end;
		margin-bottom: 3px;
	}

	header .showDatabase {
		color: var(--blue);
	}

	header .showTable {
		color: var(--green);
		padding-left: 1rem;
	}

	header .showInfo {
		color: var(--text-color);
	}
</style>
