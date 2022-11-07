<script lang="ts">
	import { openDialogModal } from '$lib/functions/stores';
	function closeDialogModal() {
		openDialogModal.update((n) => false);
	}
</script> 

<div class="buttons">
	<input type="submit" value="Cancel" class="cancel" on:click|preventDefault={closeDialogModal} />
</div>

<style>
  h2 {
		font-size: 2rem;
		text-align: center;
	}
	
	input {
		width: 100%;
	}
	
	.buttons {
		display: flex;
		justify-content: space-between;
	}
</style>
 

