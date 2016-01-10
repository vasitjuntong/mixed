var add_product = angular.module('add_product', []);

add_product.controller('AddProductCtrl', function($scope, $http, $location, $window){
	var productAhead = $('.typeahead');

	$scope.formData = {};
	$scope.formErrors = {};

	$http.get('/api/product-typeahead').then(function(response){
		$scope.products = response.data;

		productAhead.typeahead({
			source: $scope.products, 
	        autoSelect: true
		}); 
	});

	$scope.addProductInRequest = function(data){
		$http.post($location.absUrl(), data).success(function(response){
			$window.location.reload();
		}).error(function(response){
			$scope.formErrors = response;
		});
	}

	$scope.checkProduct = function(product_code){

		$http.get('/api/product/' + product_code).success(function(response){

			$scope.formData.product_id = response.id;
			$scope.formData.mix_no = response.mix_no;
			$scope.formData.product_description = response.description;
			$scope.formData.unit = response.unit.name;
			$scope.formData.stock = response.stock_sum;
		}).error(function(response){

			$scope.formData.product_id = null;
			$scope.formData.mix_no = null;
			$scope.formData.product_description = null;
			$scope.formData.unit = null;
			$scope.formData.stock = null;
		});
	}
});