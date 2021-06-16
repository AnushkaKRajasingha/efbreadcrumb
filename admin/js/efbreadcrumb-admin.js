(function( $ ) {
	$(document).ready(function(){
		$("select#efb_root_elm").change(function(){
			$value =  $(this).find("option:selected").val() ;
			if($value == 2 ) $('input#efb_root_elm_text').show(); else $('input#efb_root_elm_text').hide();
		});

		var custom_uploader;
		$('#btn_upload').click(function(e) {
			e.preventDefault();
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Thumbnail',
				button: {
					text: 'Choose Thumbnail'
				},
				multiple: false
			});
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON();
				$('#uld_image').val(attachment.url);
			});
			//Open the uploader dialog
			custom_uploader.open();
		});

	});
})( jQuery );
