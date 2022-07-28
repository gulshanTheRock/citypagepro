
jQuery(document).on('click','#loadMore',function(){
console.log('click');
jQuery("body").prepend( "<div class='loader-ajax'><img src='"+city_proplugin_url+"images/loading_spinner.gif'></div>" );
jQuery(this).parents('.loadMore-pagination').addClass('hide-this-button');
var next_page = jQuery(this).parents('.loadMore-pagination').find('.page__pagination .pagination-next').attr('href');
console.log(next_page);
jQuery.ajax(next_page, {
type: 'GET', 
dataType: 'html',
success: function (data) {
    console.log(data);
	jQuery( ".loader-ajax" ).remove();
    var html  = jQuery(data).find('.parentlistloop').html();
    jQuery('.parentlistloop').append(html);
},
error: function (jqXhr, textStatus, errorMessage) {
    console.log('error');
}
});
});
jQuery(document).on('click','#showlisting',function(){
	 jQuery('.parentlistloop').show();
	 jQuery(this).hide();
});

