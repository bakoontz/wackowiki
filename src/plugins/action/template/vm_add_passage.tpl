
[ === main === ]
[ ' help ' ]
<!--notypo-->
	[= l Form =
		<div class="cssform">
		<h3>[ ' format_t: AddPassage ' ]</h3>

		<form action="[ ' href ' ]" method="post" name="vm_add_passage">
			[ ' csrf: vm_add_passage ' ]
            <p>
				<label for="book">[ ' format_t: Book ' ]</label>
				<input type="text" id="book" name="book" size="10" maxlength="10" value="[ ' book | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="chapter_start">[ ' format_t: ChapterStart ' ]</label>
				<input type="text" id="chapter_start" name="chapter_start" size="3" maxlength="3" value="[ ' chapterstart | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="verse_start">[ ' format_t: VerseStart ' ]</label>
				<input type="text" id="verse_start" name="verse_start" size="3" maxlength="3" value="[ ' versestart | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="chapter_end">[ ' format_t: ChapterEnd ' ]</label>
				<input type="text" id="chapter_end" name="chapter_end" size="3" maxlength="3" value="[ ' chapterstart | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<label for="verse_end">[ ' format_t: VerseEnd ' ]</label>
				<input type="text" id="verse_end" name="verse_end" size="3" maxlength="3" value="[ ' verseend | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<label for="page">[ ' format_t: Page ' ]</label>
				<input type="text" id="page" name="page" size="4" maxlength="4" value="[ ' page | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" required autofocus>
			</p>
			<p>
				<label for="notes">[ ' format_t: Notes ' ]</label>
				<input type="text" id="notes" name="notes" size="64" maxlength="255" value="[ ' notes | e attr ' ]" title="[ ' only | e attr ' ]" tabindex="1" autofocus>
			</p>
			<p>
				<button type="submit" class="btn-ok" tabindex="4">[ ' format_t: SubmitButton ' ]</button>
			</p>
		</form>
		</div>
	=]
<!--/notypo-->
