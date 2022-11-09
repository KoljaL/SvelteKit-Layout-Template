<script>
	// @ts-nocheck

	import { confObj, TableRows } from '$lib/functions/stores';
	console.log($TableRows);
	  import { Datatable } from 'svelte-simple-datatables'
      let rows
</script>

<h2>Data Table</h2> 
<!-- {JSON.stringify($TableRows)} -->

<Datatable {$TableRows} bind:dataRows={rows}>
  {console.log($rows)}

    <thead>
        <th data-key="id">ID</th>

        <!-- Function that will be used for sorting and filtering -->
        <th data-key="(row) => row.first_name + ' ' + row.last_name">User</th>

        <th data-key="email">Email</th>
        <th data-key="ip_address">IP Adress</th>
    </thead>
    <tbody>
    {#if rows}
        {#each $rows as row}
            <tr>
                <td>{row.id}</td>

                <!-- This allows for example to concatenate values -->
                <td>{row.first_name} {row.last_name}</td>

                <td>{row.email}</td>
                <td>{row.ip_address}</td>
            </tr>
        {/each}
    {/if}
    </tbody>
</Datatable>
