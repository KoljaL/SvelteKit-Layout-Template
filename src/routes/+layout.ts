// export const prerender = false
export const ssr = false

export const load = ({ url }) => {
	const currentRoute = url.pathname
	return {
		currentRoute
	}
}
