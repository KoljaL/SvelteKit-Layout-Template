<script>
	// @ts-nocheck
	import { get, readable } from 'svelte/store';
	//https://svelte.dev/repl/ff08194b4de6407b8f96f29bf7c3f463?version=3.48.0
	import { TableRows } from '$admin/functions/stores';
	import { createTable, Subscribe, Render } from 'svelte-headless-table';
	import { addSortBy, addColumnOrder } from 'svelte-headless-table/plugins';

	const data = TableRows;

	const table = createTable(data, {
		sort: addSortBy({ disableMultiSort: true })
	});

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

	const { headerRows, rows, tableAttrs, tableBodyAttrs, pluginStates } = table.createViewModel(columns);
	$: {
		headerRows, rows, tableAttrs, tableBodyAttrs, data, table, columns;
		// console.log(columns);
	}
</script>

<!-- {JSON.stringify($TableRows)} -->

{#if data}
	<table {...$tableAttrs}>
		<thead>
			{#each $headerRows as headerRow (headerRow.id)}
				<Subscribe rowAttrs={headerRow.attrs()} let:rowAttrs>
					<tr {...rowAttrs}>
						{#each headerRow.cells as cell (cell.id)}
							<Subscribe attrs={cell.attrs()} let:attrs props={cell.props()} let:props>
								<th {...attrs} on:click={props.sort.toggle}>
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
{/if}

<style>
	th {
		color: var(--blue);
		cursor: pointer;
	}

	th:hover {
		color: var(--blue);
		filter: brightness(1.4);
	}
</style>
