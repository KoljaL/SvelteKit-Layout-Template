<footer class="footer">
	<ul class="footer__links">
		<li class="footer__links_item">
			<a href="/admin" class="footer__links__item__link">Admin</a>
		</li>
	</ul>
</footer>

<style>
	.footer {
		height: 6rem;
		display: flex;
		justify-content: start;
		flex-direction: row;
	}

	.footer__links {
		display: flex;
		flex-direction: row;
		align-items: start;
		list-style: none;
	}

	.footer__links_item {
		margin-left: 1rem;
	}

	.footer__links_item:last-child {
		margin-right: 1rem;
	}

	.footer__links__item__link {
		padding-bottom: 0.2rem;
		color: var(--secondary-color);
		text-decoration: none;
	}

	.footer__links__item__link:hover {
		border-bottom: 1.5px solid var(--secondary-color);
	}
</style>
