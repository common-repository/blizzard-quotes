jQuery(document).ready(function($){
    jQuery('.background-color').wpColorPicker();
	
	var upload_media_file;
	
	$('#upload_media_file').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (upload_media_file) {
            upload_media_file.open();
            return;
        }
 
        //Extend the wp.media object
        upload_media_file = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        upload_media_file.on('select', function() {
            attachment = upload_media_file.state().get('selection').first().toJSON();
            $('#bluepost_bg_img').val(attachment.url);

        });
 
        //Open the uploader dialog
        upload_media_file.open();
 
    });	
	

});