(function(){

	// initialize foundaton
	$(document).foundation();

	// create popup
	var modal = new Foundation.Reveal($('#postModal'));

	/**
	 * show post with given id in popup
	 */
	var showPost = function(id){
		var template = $('#postModalTpl').html();
		$.ajax({
			url: "/?action=getpost&postid=" + id
	 	}).done(function(data){
	 		$("#postModal").html(Mustache.to_html(template, data[0]));
	 		// bind he buttons
			$('#postModal .btn_close').on(
				'click',
				function(){ modal.close(); }
	 		)	
	 		$('#postModal button').on(
	 			'click',
	 			function(){ 
	 				$('#postModal button').toggleClass('secondary');
	 				$('#postModal .tabs div').toggleClass('hidden');
	 			}
	 		)
	 		modal.open();
	 	});

		
		
		//alert(id); 		
	};

	/**
	 * load accordion content the first time a header is clicked
	 */
	 $('.accordion-item').on('click', 
	 	function(ev){ 
	 		var sender = $(this);
	 		// get posts 
	 		if(! sender.hasClass('loaded')) {
	 			var template = $('#postsListTpl').html();
	 			var contentdiv = sender.find('.accordion-content');
	 			
	 			contentdiv.html(Mustache.to_html(template, { 'posts' : { 'title' : 'loading...'}}));
	 			
	 			$.ajax({
					url: "/?action=getposts&userid=" + sender.attr('data-userid')
	 			}).done(
	 				function(data) {
	 					// prepare returned data for use with mustache partial
	 					var posts = { posts: data.map(function(item){ 
	 						return { 'ID':item.ID, 'title':item.post_title || '[no title]', 'status':item.post_status };
	 					})};
	 					// insert posts and bind the click handler
	 					contentdiv
	 						.html(Mustache.to_html(template, posts))
	 						.find('li')
	 						.on('click',function(ev){
	 							showPost($(this).attr('data-post-id'))
	 						});
	 					// mark this one as loaded
					 	contentdiv
					 		.parent()
	 						.addClass('loaded has-posts')
					}
				);
	 	}});

}());


