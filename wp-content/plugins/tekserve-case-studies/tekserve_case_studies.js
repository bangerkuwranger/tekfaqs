jQuery(function($) {  
  
    // Check to see if the 'Delete File' link exists on the page...  
    if(jQuery('a#tekserve-case-study-file-delete').length === 1) {  
  
        // Since the link exists, we need to handle the case when the user clicks on it...  
        jQuery('#tekserve-case-study-file-delete').click(function(evt) {  
          
            // We don't want the link to remove us from the current page  
            // so we're going to stop it's normal behavior.  
            evt.preventDefault();  
              
            // Find the text input element that stores the path to the file  
            // and clear it's value.  
            jQuery('#tekserve-case-study-file-url').val('');  
              
            // Hide this link so users can't click on it multiple times  
            jQuery(this).hide();  
          
        });  
      
    } // end if  
  
});  