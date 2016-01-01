new Vue({
	el: '#app',
	data: {
		product_id: '',
		product_code: '',
		product_description: '',
		mix_no: '',
		unit: '',
		location_id: ''
	},
	ready:function(){
		var that = this;
		 // GET request
	      that.$http.get('/api/product-typeahead').then(function (response) {			
			var $input = $('.typeahead');
			$input.typeahead({
				source: response.data, 
	            autoSelect: true}
            ); 
			$input.change(function() {
			    var current = $input.typeahead("getActive");
			    if (current) {
			    	that.$set('mix_no', current.mix_no);
			    	that.$set('product_description', current.description);
			    	that.$set('product_id', current.id);
			    	that.$set('unit', current.unit);
			    } else {
			        // Nothing is active so it is a new value (or maybe empty value)
			    }
			});

	      }).catch(function (data, status, request) {
          	// handle error
      	});

	}
});