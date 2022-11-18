<script lang="ts">
	// This can be false if you're using a fallback (i.e. SPA mode)
	export const prerender = false;

	// STYLE
	const adminCSS = document.querySelector('head #adminCSS') as HTMLButtonElement | null;
	const appCSS = document.querySelector('head #appCSS') as HTMLButtonElement | null;

	if (adminCSS != null) {
		adminCSS.disabled = true;
	}
	if (appCSS != null) {
		appCSS.disabled = false;
	}

	function toggleTheme() {
		document.body.classList.toggle('latex-dark');
	}
</script>

<header>
	<div class="left">
		<div class="pagename"><span class="latex">L<span>a</span>S<span>a</span>R</span></div>
	</div>
	<div class="right">
		<a href="/">Home</a>
		<a href="/text">Text</a>
		<a href="/admin">Admin</a>
		<a href="/#" on:click|preventDefault={toggleTheme}>Dark</a>
	</div>
</header>

<main>
	<article>
		<slot />
	</article>
</main>

<footer>
	<div class="withLove">
		<a href="https://github.com/KoljaL/" title="Link to Github Repository" target="_blank rel">
			Made with
			<svg width="12px" height="12px" viewBox="0 0 24 20" xmlns="http://www.w3.org/2000/svg">
				<path fill="#8E1B1B" d="M 11.9467 20.48 Q 11.6 20.48 11.36 20.24 L 3.04 12.2133 Q 2.9067 12.1067 2.6667 11.8667 T 1.9333 11 T 1.0267 9.6933 T 0.32 8.08 T 0 6.24 Q 0 3.3067 1.6933 1.6533 T 6.3733 0 Q 7.2 0 8.0667 0.2933 T 9.6667 1.0667 T 10.9333 1.9733 T 11.9467 2.88 Q 12.4267 2.4 12.96 1.9733 T 14.24 1.0533 T 15.84 0.28 T 17.52 0 Q 20.5067 0 22.2 1.6533 T 23.8933 6.24 Q 23.8933 9.1867 20.84 12.24 L 12.5333 20.24 Q 12.2933 20.48 11.9467 20.48 Z" />
			</svg>
			by
			<img src="https://rasal.de/img/SvelteKit-Layout-16.png" alt="KoljaL" />
		</a>
	</div>
</footer>

<!-- 
	STYLE 
-->
<style>
	header {
		flex-shrink: 0;
		height: var(--header-height);
		background-color: var(--bg-header);
		padding-inline: 1rem;
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
		border-bottom: 1px solid var(--kbd-border-color);
	}
	header .left {
		display: flex;
		flex-direction: row;
		align-items: end;
	}
	header .pagename {
		margin-left: 1rem;
		padding-bottom: 0.5rem;
		font-size: 2rem;
	}
	header .right {
		display: flex;
		flex-direction: row;
		align-items: end;
		gap: 1rem;
		height: 24px;
	}
	:global(.medium .toggleSidebar, .small .toggleSidebar) {
		display: inline !important;
	}

	:global(body > main) {
		flex-grow: 1;
		width: 100%;
		display: flex;
		flex-direction: row;
		border: 1px solid var(--border-color);
		border-radius: var(--page-radius);
		min-height: var(--main-height);
		overflow: auto;
	}

	article {
		width: 100%;
	}

	footer {
		flex-shrink: 0;
		height: var(--footer-height);
		/* border-top: 1px solid var(--border-color); */
		background-color: var(--bg-footer);
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: space-between;
		padding-inline: 1rem;
		border-top: 1px solid var(--kbd-border-color);
	}

	a {
		height: 1.2rem;
	}

	.withLove {
		height: 1.2rem;
		font-size: 0.8rem;
	}

	.withLove img {
		margin-bottom: -3px;
		display: inline;
	}
</style>
