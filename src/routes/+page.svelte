<script lang="ts">
	import Login from '../lib/layout/modals/Login.svelte';
	import { writable } from 'svelte/store';
	import Modal, { bind } from 'svelte-simple-modal';
	import { confObj } from '$lib/functions/stores';
 

	const loginModal = writable(null);

	if ($confObj.get('password') === '') {
		loginModal.set(bind(Login, { callbackFCN }));
	}else{
		getDatabases()
	}

	function callbackFCN(){
			loginModal.set(null);
		getDatabases()
	};

	function getDatabases(){
		// console.log('getDatabases')
	}


	$: console.info('confObj',$confObj);
	$: console.info('ConfigHolder',window.localStorage.getItem('ConfigHolder'));
</script>

<!-- LOGIN MODAL -->
<Modal
	show={$loginModal}
	closeOnEsc={false}
	closeOnOuterClick={false}
	closeButton={false}
	styleWindow={{ backgroundColor: 'transparent', 'max-width': 'max-content' }}
	styleBg={{ background: 'rgba(0, 0, 0, 0.95)' }}
/>

<!-- PAGE CONTENT -->
<div class="center">
	<h2>a wonderfull Startpage :-)</h2>
</div>

<style>
	.center {
		width: max-content;
		margin-inline: auto;
	}
</style>
