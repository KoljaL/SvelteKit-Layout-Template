<script lang="ts">
	import { confObj,ContentComponent, TableRows } from '$lib/functions/stores';
	import DataTable from '../DataTable.svelte';
	import EmptyComponent from '../EmptyComponent.svelte';

  	 
 
	function changeState(child:any) {
    $ContentComponent = child
  }


	let databases: Promise<any> | undefined = undefined;
	$: if ($confObj.get('password') !== '') {
		databases = getDatabases();
	} else {
		databases = undefined;
	}

	let tables: Promise<any> | undefined = undefined;
	$: if ($confObj.get('database') !== '') {
		getTables($confObj.get('database'));
	} else {
		tables = undefined;
	}

	let rows: Promise<any> | undefined = undefined;
	$: if ($confObj.get('table') !== '') {
		getTables($confObj.get('table'));
	} else {
		rows = undefined;
	}

	async function getDatabases() {
		const body = {
			password: $confObj.get('password')
		};
		let result = await myFetch('getDatabases', body);
		if (result.databases) {
			return result.databases;
		}
	}

	async function getTables(database: string) {
		$confObj.set('database', database);
		// $confObj = $confObj;
		const body = {
			password: $confObj.get('password'),
			database: $confObj.get('database')
		};
		let result = await myFetch('getTables', body);
		if (result.tables) {
			tables = result.tables;
		}
	}

	async function getRows(table: string) {
		$confObj.set('table', table);
		// $confObj = $confObj;
		const body = {
			password: $confObj.get('password'),
			database: $confObj.get('database'),
			table: $confObj.get('table')
		};
		let result = await myFetch('getRows', body);
		if (result.rows) {
			$TableRows = result.rows
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
	$: $confObj = $confObj;
</script>

<button on:click={() => changeState(DataTable)}>DataTable</button>

<button on:click={() => changeState(EmptyComponent)}>EmptyComponent</button>

{#await databases then databases}
	{#if databases !== undefined}
		<h2>DB-Explorer</h2>
		<details open>
			<summary><h3>Databases</h3></summary>
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
			<summary><h3>Table</h3></summary>
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
</style>
