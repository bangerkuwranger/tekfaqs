jQuery(document).ready(function(){
    
    jQuery('.faq-content').hide();
    
    jQuery('.faq .entry-title').toggle(
    function(){
        jQuery(this).parents('.faq').first().find('.faq-content').slideDown();
        jQuery(this).removeClass('faq-close').addClass('faq-open');
    },function(){
        jQuery(this).parents('.faq').first().find('.faq-content').slideUp();
        jQuery(this).removeClass('faq-open').addClass('faq-close');
    }).addClass('faq-close');
    
});


