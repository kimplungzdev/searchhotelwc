var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
var checkin = jQuery('#tgl-mulai').datepicker({
  onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
  }
  checkin.hide();
  jQuery('#tgl-akhir')[0].focus();
}).data('datepicker');
var checkout = jQuery('#tgl-akhir').datepicker({
  onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
  }
}).on('changeDate', function(ev) {
  checkout.hide();
}).data('datepicker');


/*
 * perhitungan hari
 */
function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function daydiff(first, second) {
    return Math.round((second-first)/(1000*60*60*24));
}


function showdataform( first, second, id ) {
  var text      = '';
  var firstday  = first.split('/');
  var secondday = second.split('/');

  text += 'wc_bookings_field_duration=' +  daydiff( parseDate( first ), parseDate( second ) ) ;
  text += '&wc_bookings_field_start_date_month=' + firstday[0];
  text += '&wc_bookings_field_start_date_day=' + firstday[1];
  text += '&wc_bookings_field_start_date_year=' + firstday[2];
  text += '&wc_bookings_field_start_date_to_month=' + secondday[0];
  text += '&wc_bookings_field_start_date_to_day=' + secondday[1];
  text += '&wc_bookings_field_start_date_to_year=' + secondday[2];
  text += '&add-to-cart=' + id ;
  return text;
}
var textinput = '';
function ajaxSubmit( first, second, id, index ){

  jQuery.ajax({
    type:"POST",
    url: "/training_wp/wp-admin/admin-ajax.php",
    data: {     
      action: 'wc_bookings_calculate_costs',
      form: showdataform( first, second, id )  
    },
    success:function(data){
      var obj = jQuery.parseJSON( data );
      //jQuery( '#data_result' ).val( obj.result );
      textinput = id + '###' + obj.result;
      var input = jQuery("<input>")
               .attr("type", "hidden")
               .attr("name", "data_cari[]").val( textinput );
      jQuery( '#form_process' ).append(jQuery( input ));
      //jQuery( '#form_process' ).append('<input type="hidden" name="data_cari" value="' + textinput + '" >' );
      jQuery( '#form_process' ).submit();
    }
  });

}

jQuery("#cari").click(function(event) {
  
  jQuery( ".id_hotel" ).each(function( index ) {
    console.log( index + ": " + jQuery( this ).val() );
    ajaxSubmit( jQuery('#tgl-mulai').val(), jQuery('#tgl-akhir').val(), jQuery( this ).val(), index );    
  });
  


});
