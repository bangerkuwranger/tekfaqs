jQuery().ready(function(){
    
    jQuery('.tbl_chk').click(function(){
        if(jQuery(this).is(':checked')){
            jQuery(this).parents('table').first().find('tbody').show();
        }else{
            jQuery(this).parents('table').first().find('tbody').hide();
        }
    })
    
    jQuery('.tbl_chk:not(:checked)').parents('table').find('tbody').hide();
});