<script>
	function toggleTheme() {
		document.body.classList.toggle('latex-dark');
	}
</script>

<nav class="header">
	<h1><span class="latex">L<span>a</span>T<span>e</span>X</span>.css</h1>
	<ul class="header__links">
		<li class="header__links_item">
			<a href="/" class="header__links__item__link">Home</a>
		</li>
		<li class="header__links_item">
			<a href="/admin" class="header__links__item__link">Admin</a>
		</li>
		<li class="header__links_item">
			<a href="/#" class="header__links__item__link" on:click|preventDefault={toggleTheme}>Dark</a>
		</li>
	</ul>
</nav>

<style>
	.header {
		height: 6rem;
		display: flex;
		justify-content: space-between;
		flex-direction: row;
	}

	.header__title {
		margin-left: 1rem;
		color: var(--main-color);
		text-decoration: none;
		font-weight: bold;
		font-size: 1.5rem;
		line-height: 6.2rem;
	}

	.header__links {
		display: flex;
		flex-direction: row;
		align-items: center;
		list-style: none;
	}

	.header__links_item {
		margin-left: 1rem;
	}

	.header__links_item:last-child {
		margin-right: 1rem;
	}

	.header__links__item__link {
		padding-bottom: 0.2rem;
		color: var(--secondary-color);
		text-decoration: none;
	}

	.header__links__item__link:hover {
		border-bottom: 1.5px solid var(--secondary-color);
	}
</style>
