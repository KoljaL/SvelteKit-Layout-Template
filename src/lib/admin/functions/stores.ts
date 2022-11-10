import { writableLocal } from './writableLocal'

export const preferences = writableLocal('preferences', {
	theme: 'dark',
	pane: '50%'
})
