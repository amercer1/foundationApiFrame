$(document).ready( function() {
	
	relative_path = dir.substring(root.length + 1);

	

	$('#file-tree').fileTree(
		{ 
			root: root, 
			script: base_url('jqueryFileTree.php'),
			dir: relative_path ,
			onFolderExpand: function(el) {
        var path = $(el).children('a').data("path");
				//console.log(path);	
				$.event.trigger({
					type: 'select',
					message: path
				});
			}
		}, 
		function(file) {
        var path = $(el).data("path");
				//console.log(path);	
				$.event.trigger({
					type: 'select',
					message: path
				});
			//window.location.replace(base_url(file));
		}/*, function (t) {
				//console.log(t);
				$(t).find('li').mouseenter(function() {
					$(t).find('button').hide();
					$(t).find('li:hover > button').last().show();
				});

				console.log($(t).find("a").data("path")); 
        var path = $(t).find("a").data("path");	
				$.event.trigger({
					type: 'select',
					message: path
				})
				// copy url button
				$(t).find('li button').show().zclip({
					path: base_url('js/ZeroClipboard.swf'),
					copy: function() {return $(this).prev().attr('href');},
					afterCopy: function() {
						//$(t).find('button:disabled').removeAttr('disabled').html('Copy URL');
						$(this).attr('disabled', 'disabled').html('Copied');
					}
				}).attr('style', '');
			  
		}*/);

		//debugger;	

		$('#file-tree').parent().append($("<div>", {id: 'test-div'}));
		//$(document).on('click', '#file-tree li', function(e) {
		//$('#file-tree a').live('click', function() {
		$('#test-div, #file-tree').delegate('li a', 'click', function(e) {
        var path = $(e.currentTarget).data("path");
				//console.log(path);	
				$.event.trigger({
					type: 'select',
					message: path
				})
		});
    /*
		$('#test-div')
			.append($("<li>").append($("<a>", {href: '#', 'data-path': 'path/to/file1'}).append('File1')))
			.append($("<li>").append($("<a>", {href: '#', 'data-path': 'path/to/file2'}).append('File2')));
    */
		$(".toBeGrabbed")
				.focus(function(e) {
						$(".toBeGrabbed").removeClass('selected');
						$(this).addClass('selected');
				})
				.on('select', function(e) {
					var path = e.message;
					//console.log("PATH :" + path);
					//if ($(this).is(':focus'))	
					//console.log(this);
					if ($(this).hasClass('selected'))
						$(this).val(path);
				//console.log($(this).val('hello'));
				});

	
});
