<script>
  /**
	 * @type {any}
	 */
   export let onClose;
</script>

<div on:click={onClose} on:keydown={onClose}>Custom Close Button</div>

<style>
  div {
    color: var(--text-color);
    position: absolute;
    top: 0;
    right: 0;
  }
</style>