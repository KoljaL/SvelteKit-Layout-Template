// import { Writable } from 'svelte/store'
import { writable as internal, get } from 'svelte/store'

declare type Updater<T> = (value: T) => T
declare type StoreDict<T> = { [key: string]: Writable<T> }

/* eslint-disable @typescript-eslint/no-explicit-any */
const stores: StoreDict<any> = {}

export function writableLocal<T> (key: string, initialValue: T): Writable<T> {
	const browser = typeof localStorage != 'undefined'

	function updateStorage (key: string, value: T) {
		if (!browser) return

		if (window.localStorage.getItem('PRFX_rememberme') && window.localStorage.getItem('PRFX_rememberme') === 'true') {
			key = key.slice(0, 5) !== 'PRFX_' ? 'PRFX_' + key : key

			localStorage.setItem(key, JSON.stringify(value))
		}
	}

	if (!stores[key]) {
		const store = internal(initialValue, set => {
			if (key.slice(0, 5) !== 'PRFX_') {
				key = 'PRFX_' + key
			}
			const json = browser ? localStorage.getItem(key) : null

			if (json) {
				set(<T>JSON.parse(json))
			}

			if (browser) {
				const handleStorage = (event: StorageEvent) => {
					if (event.key === key) set(event.newValue ? JSON.parse(event.newValue) : null)
				}
				window.addEventListener('storage', handleStorage)
				return () => window.removeEventListener('storage', handleStorage)
			}
		})

		const { subscribe, set } = store

		stores[key] = {
			set (value: T) {
				// console.log('SET: ', key)
				updateStorage(key, value)
				set(value)
			},
			update (updater: Updater<T>) {
				// console.log('UPDATE: ', key)
				const value = updater(get(store))
				updateStorage(key, value)
				set(value)
			},
			subscribe
		}
	}

	return stores[key]
}
