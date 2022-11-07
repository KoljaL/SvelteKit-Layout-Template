<script lang="ts">
	export let title: string;
	export let text: string;
	export let callbackFCN = (value: string) => {};
	let value: string = '123';

	function onSubmit() {
		callbackFCN(value);
	}
</script>

<fieldset>
	<legend>{title}</legend>
	<form>
		<ul>
			<li>
				<input type="password" bind:value />
			</li>
			<li>
				<input type="submit" on:click|preventDefault={onSubmit} value="Okay" />
        <span class="error">{text}</span>
			</li>
		</ul>
	</form>
</fieldset>

<style>
	.error {
		color: var(--red);
		text-align: center;
    padding-left:1rem;
	}
</style>
