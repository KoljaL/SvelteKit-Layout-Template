<script lang="ts">
	export let title = 'title';
	export let text = 'text';
	import { getContext } from 'svelte';
	export let onCancel = () => {};
	export let onOkay = () => {};

	const { close } = getContext('simple-modal');

	function _onCancel() {
		onCancel();
		close();
	}

	function _onOkay() {
		onOkay();
		close();
	}

	// $: onChange(value);
</script>

<fieldset>
	<legend>{title}</legend>
	<div>{text}</div>
	<form>
		<ul>
			<li>
				<input type="submit"  on:click|preventDefault={_onOkay} value="Okay" />
				<input type="submit"  on:click|preventDefault={_onCancel} value="Cancel" class="cancel" /> 
			</li>
		</ul>
	</form>
</fieldset>
