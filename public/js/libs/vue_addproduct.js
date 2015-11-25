new Vue({
	el: '#app',
	data: {
		product_id: '',
		mix_no: '',
		description: '',
		location_id: ''
	},
	ready:function(){
		 // GET request
	      this.$http.get('/api/product-typeahead', function (data, status, request) {
			var that = this;			
			var $input = $('.typeahead');
			$input.typeahead({
				source: data, 
	            autoSelect: true}
            ); 
			$input.change(function() {
			    var current = $input.typeahead("getActive");
			    if (current) {
			    	console.log(current);
			    	that.$set('mix_no', current.mix_no);
			    	that.$set('description', current.description);
			        // Some item from your model is active!
			        if (current.name == $input.val()) {
			            // This means the exact match is found. Use toLowerCase() if you want case insensitive match.
			        } else {
			            // This means it is only a partial match, you can either add a new item 
			            // or take the active if you don't want new items
			        }
			    } else {
			        // Nothing is active so it is a new value (or maybe empty value)
			    }
			});

	      }).error(function (data, status, request) {
          	// handle error
      	});

	}
});