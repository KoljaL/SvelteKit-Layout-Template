// export const prerender = false
export const ssr = false
// import { page } from '$app/stores'

// export let currentRoute;
// console.log(page)
export async function get ({ request, params, url }) {
	console.log(url)
}
export const load = ({ url }) => {
	const currentRoute = url.pathname
	return {
		currentRoute
	}
}
