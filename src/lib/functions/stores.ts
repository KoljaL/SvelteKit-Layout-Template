import { writable } from 'svelte/store'
import { persist, persistBrowserSession, createSessionStorage, createLocalStorage, addSerializableClass } from '@macfja/svelte-persistent-store'
import { SvelteComponentTyped } from 'svelte'

// MODALS
export const openFormModal = writable(false)
export const openDialogModal = writable(false)

// ContentComponent  Writable<SvelteComponentTyped>
export const ContentComponent: SvelteStore<any> = writable()
export const TableRows = writable()

//https://chasingcode.dev/blog/svelte-persist-state-to-localstorage/

export class ConfigHolder {
	constructor () {
		// ;(this.rememberme = ''), (this.password = '')
		this.rememberme = ''
		this.password = ''
		this.database = ''
		this.table = ''
		this.column = ''
		this.row = ''
	}

	erase () {
		Object.entries(this).forEach(element => {
			this[element[0]] = ''
		})
	}
	set (key, value) {
		this[key] = value
		if (this.rememberme === '') {
			// console.log('rememberme')
			window.localStorage.removeItem('ConfigHolder')
			// console.log('ConfigHolder',window.localStorage.getItem('ConfigHolder'))
		}
	}
	get (key) {
		return this[key]
	}
}

// Register the class
addSerializableClass(ConfigHolder)
export let confObj = persist(writable(new ConfigHolder()), createLocalStorage(), 'ConfigHolder')
