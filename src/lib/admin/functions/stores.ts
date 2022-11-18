import { writableLocal } from './writableLocal'
import { writable } from 'svelte/store'

import { SvelteComponentTyped } from 'svelte'

export const passwordST = writableLocal('PRFX_password', '')
export const remembermeST = writableLocal('PRFX_rememberme', '')
export const databaseST = writableLocal('PRFX_database', '')
export const tableST = writableLocal('PRFX_table', '')

// MODALS
export const openFormModal = writable(false)
export const openDialogModal = writable(false)

// ContentComponent  or <any>
export const ContentComponent: SvelteStore<any> = writable()
export const TableRows = writable()
