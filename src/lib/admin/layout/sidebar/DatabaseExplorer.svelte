<script lang="ts">
	// import { ContentComponent, TableRows } from '$lib/functions/stores';
	import { SvelteComponentTyped } from 'svelte';

	import DataTable from '../DataTable.svelte';
	import EmptyComponent from '../EmptyComponent.svelte';
	import { passwordST, databaseST, tableST, ContentComponent, TableRows } from '$admin/functions/stores';

	function changeState(child: any) {
		$ContentComponent = child;
	}

	let databases: Promise<any> | undefined = undefined;
	// $: if ($passwordST) {
	// 	databases = getDatabases();
	// } else {
	// 	databases = undefined;
	// }

	let tables: Promise<any> | undefined = undefined;
	// $: if ($databaseST) {
	// 	getTables($databaseST);
	// } else {
	// 	tables = undefined;
	// }

	let rows: Promise<any> | undefined = undefined;
	// $: if ($tableST) {
	// 	getRows($tableST);
	// } else {
	// 	rows = undefined;
	// }

	async function getDatabases() {
		const body = {
			password: $passwordST
		};
		let result = await myFetch('getDatabases', body);
		if (result.databases) {
			databases = result.databases;
		}
	}

	async function getTables(database: string) {
		databaseST.set(database);
		const body = {
			password: $passwordST,
			database: $databaseST
		};
		let result = await myFetch('getTables', body);
		if (result.tables) {
			tables = result.tables;
			$ContentComponent = EmptyComponent;
		}
	}

	async function getRows(table: string) {
		tableST.set(table);
		const body = {
			password: $passwordST,
			database: $databaseST,
			table: $tableST
		};
		let result = await myFetch('getRows', body);
		if (result.rows) {
			$TableRows = result.rows;
			console.log('$TableRows', $TableRows);
			$ContentComponent = DataTable;
			// return result.tables;
		}
	}

	/**
	 *
	 * myFetch()
	 *
	 */
	async function myFetch(slug: string, body: any) {
		return fetch('http://localhost:9999/API?' + slug, {
			method: 'POST',
			// mode: 'same-origin',
			// credentials: 'same-origin',
			mode: 'cors',
			headers: {
				'Content-Type': 'application/json',
				'Access-Control-Allow-Origin': '*',
				Accept: 'application/json'
			},
			body: JSON.stringify(body)
		})
			.then((response) => response.json())
			.then((res) => {
				console.info('%cmyFetch_' + slug, 'color:limegreen', res);
				return res;
			})
			.catch((error) => {
				console.error('Error:', error);
			});
	}
	// $: $confObj = $confObj;
	$: {
		// console.log('contentComonent', $ContentComponent);
		// console.log('databases', databases);
	}
	// $: databases = databases;
</script>

<!-- <button on:click|preventDefault={() => changeState(DataTable)}>DataTable</button>
<button on:click|preventDefault={() => changeState(EmptyComponent)}>EmptyComponent</button> -->

<h2 on:click={() => getDatabases()} on:keypress={() => getDatabases()}>DB-Explorer</h2>

{#await databases then databases}
	{#if databases !== undefined}
		<details open>
			<summary><h4>Databases</h4></summary>
			<ul>
				{#each databases as data}
					<li>
						<a href="/#" on:click|preventDefault={() => getTables(data.file)}>{data.name}</a>
					</li>
				{/each}
			</ul>
		</details>
	{/if}
{/await}

{#await tables then tables}
	{#if tables !== undefined}
		<details open>
			<summary><h4>Table</h4></summary>
			<ul>
				{#each tables as data}
					<li>
						<a href="/#" on:click|preventDefault={() => getRows(data.name)}>{data.name}</a>
					</li>
				{/each}
			</ul>
		</details>
	{/if}
{/await}

<style>
	h2 {
		cursor: pointer;
	}
</style>
