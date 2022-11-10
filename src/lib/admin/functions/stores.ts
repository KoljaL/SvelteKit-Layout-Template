import { writable } from './local-storage-store'

export const preferences = writable('preferences', {
	theme: 'dark',
	pane: '50%'
})
