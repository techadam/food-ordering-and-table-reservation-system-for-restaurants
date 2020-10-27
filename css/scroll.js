$(document).ready(function() {
	var win = $(window);

	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();

			$.ajax({
				url: 'get-post.php',
				dataType: 'html',
				success: function(html) {
					$('#posts').append(html);
					$('#loading').hide();
				}
			});
		}
	});
});

/*HTML
<ul id="posts">
	<li>
		<article>content</article>
	</li>

	…
</ul>

<p id="loading">
	<img src="images/loading.gif" alt="Loading…" />
</p>
*/