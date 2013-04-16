$(document).ready( function() {
	
	relative_path = dir.substring(root.length + 1);

	

	$('#file-tree').fileTree(
		{ 
			root: root, 
			script: base_url('fileTree/jqueryFileTree.php'),
			dir: relative_path ,
			onFolderExpand: function(el) {
        var path = $(el).children('a').data("path");
				$.event.trigger({
					type: 'select',
					message: path
				});
			}
		}, 
		function(file) {
        var path = $(el).data("path");
				$.event.trigger({
					type: 'select',
					message: path
				});
		}	);


		$('#file-tree').parent().append($("<div>", {id: 'test-div'}));
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
					if ($(this).hasClass('selected'))
						$(this).val(path);
				});

	
});
