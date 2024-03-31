
[ === main === ]
[ ' help ' ]
<!--notypo-->
	[= l Form =
		<div class="cssform">
		<h3>[ ' format_t: NewResource ' ]</h3>

		<form action="[ ' href ' ]" method="post" name="vm_new_resource">
			[ ' csrf: vm_new_resource ' ]
            <p>
                <input type="radio" id="bound_book" name="resource_type" value="bound_book" checked>
                <label for="bound_book">Bound book</label><br>
                <input type="radio" id="periodical" name="resource_type" value="periodical">
                <label for="periodical">Periodical</label><br>
                <input type="radio" id="sermon" name="resource_type" value="sermon">
                <label for="sermon">Sermon</label><br>
			<p>
				<label for="author_first">[ ' format_t: AuthorFirst ' ]</label>
				<input type="text" id="author_first" name="author_first" size="64" maxlength="64" value="[ ' authorfirst | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="author_last">[ ' format_t: AuthorLast ' ]</label>
				<input type="text" id="author_last" name="author_last" size="64" maxlength="64" value="[ ' authorlast | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="title">[ ' format_t: ResourceTitle ' ]</label>
				<input type="text" id="title" name="title" size="128" maxlength="64" value="[ ' title | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="ed">[ ' format_t: Edition ' ]</label>
				<input type="text" id="ed" name="ed" size="10" maxlength="10" value="[ ' ed | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<label for="year">[ ' format_t: Year ' ]</label>
				<input type="text" id="year" name="year" size="4" maxlength="4" value="[ ' year | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<label for="volume">[ ' format_t: Volume ' ]</label>
				<input type="text" id="volume" name="volume" size="10" maxlength="10" value="[ ' volume | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<label for="issue">[ ' format_t: Issue ' ]</label>
				<input type="text" id="issue" name="issue" size="10" maxlength="10" value="[ ' issue | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<label for="url">[ ' format_t: URL ' ]</label>
				<input type="text" id="url" name="url" size="128" maxlength="255" value="[ ' url | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<button type="submit" class="btn-ok" tabindex="4">[ ' format_t: SubmitButton ' ]</button>
			</p>
		</form>
		</div>
	=]
<!--/notypo-->
