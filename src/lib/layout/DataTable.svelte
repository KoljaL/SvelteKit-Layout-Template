<script>
	// @ts-nocheck
	import { readable } from 'svelte/store';
	//https://svelte.dev/repl/ff08194b4de6407b8f96f29bf7c3f463?version=3.48.0
	import { confObj, TableRows } from '$lib/functions/stores';
	import { createTable, Subscribe, Render } from 'svelte-headless-table';
	import { addSortBy, addColumnOrder } from 'svelte-headless-table/plugins';

	$: $TableRows = $TableRows;
	$: console.log($TableRows);
	// const table = createTable($TableRows);

	const data = readable($TableRows);
	// const data = readable([
	// 	{
	// 		id: 1,
	// 		date: '2022-10-24 00:00:00',
	// 		WZ_TR: '16.04',
	// 		WZ_HK1_VL: '51.76',
	// 		WZ_HK1_RL: '39.04',
	// 		WZ_HK2_VL: '46.89',
	// 		WZ_HK2_RL: '34.35'
	// 	},
	// 	{
	// 		id: 1,
	// 		date: '2022-10-24 00:00:00',
	// 		WZ_TR: '16.04',
	// 		WZ_HK1_VL: '51.76',
	// 		WZ_HK1_RL: '39.04',
	// 		WZ_HK2_VL: '46.89',
	// 		WZ_HK2_RL: '34.35'
	// 	}
	// ]);

	const table = createTable(data);

	const columns = table.createColumns([
		table.column({
			header: 'id',
			accessor: 'id'
		}),
		table.column({
			header: 'date',
			accessor: 'date'
		}),
		table.column({
			header: 'WZ_HK1_RL',
			accessor: 'WZ_HK1_RL'
		}),
		table.column({
			header: 'WZ_HK1_VL',
			accessor: 'WZ_HK1_VL'
		}),
		table.column({
			header: 'WZ_HK2_RL',
			accessor: 'WZ_HK2_RL'
		}),
		table.column({
			header: 'WZ_HK2_VL',
			accessor: 'WZ_HK2_VL'
		}),
		table.column({
			header: 'WZ_TR',
			accessor: 'WZ_TR'
		})
	]);

	const { headerRows, rows, tableAttrs, tableBodyAttrs } = table.createViewModel(columns);
	$: {
		headerRows, rows, tableAttrs, tableBodyAttrs, data, table, columns;
		console.log(columns);
	}
</script>

<h2>Data Table</h2>
<!-- {JSON.stringify($TableRows)} -->
<table {...$tableAttrs}>
	<thead>
		{#each $headerRows as headerRow (headerRow.id)}
			<Subscribe rowAttrs={headerRow.attrs()} let:rowAttrs>
				<tr {...rowAttrs}>
					{#each headerRow.cells as cell (cell.id)}
						<Subscribe attrs={cell.attrs()} let:attrs>
							<th {...attrs}>
								<Render of={cell.render()} />
							</th>
						</Subscribe>
					{/each}
				</tr>
			</Subscribe>
		{/each}
	</thead>
	<tbody {...$tableBodyAttrs}>
		{#each $rows as row (row.id)}
			<Subscribe rowAttrs={row.attrs()} let:rowAttrs>
				<tr {...rowAttrs}>
					{#each row.cells as cell (cell.id)}
						<Subscribe attrs={cell.attrs()} let:attrs>
							<td {...attrs}>
								<Render of={cell.render()} />
							</td>
						</Subscribe>
					{/each}
				</tr>
			</Subscribe>
		{/each}
	</tbody>
</table>
