[ === main === ]
	[ ' message ' ]
	<h3>[ ' _t: CreateNewPage ' ] using the above template:</h3>
	<br>
	<form action="[ ' href ' ]" method="post" name="add_template">
		[ ' csrf: add_template ' ]
		<input type="hidden" name="page" value="result">
		<label for="create_page">[ ' _t: CreateNewPage ' ]:</label><br>
		<input type="text" id="create_page" name="newpage" value="[ ' tag | e attr ' ]" size="60" maxlength="255">
		<button type="submit" id="submit_template">[ ' _t: CreateButton ' ]</button>
	</form>	
