<script lang="ts">

	export let message:string = 'dd'

	import { openDialogModal } from '$lib/functions/stores';
	function returnCancel() {
		openDialogModal.update((n) => false);
	}
	function returnOkay() {
		openDialogModal.update((n) => false);
	}

</script> 

<fieldset>
	<legend>{message}</legend>
	<form> 
		<ul>
			<li>
				<input type="submit" value="Okay" on:click|preventDefault={returnOkay} />
				<input type="submit" value="Cancel" class="cancel" on:click|preventDefault={returnCancel} />
			</li>
		</ul>
	</form>
</fieldset>
 

