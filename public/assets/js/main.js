$(function() {
	'use strict';

	
  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});

app = angular.module("b1", []);
app.controller("hienthi", xuly);
function xuly($scope) {
	$scope.agl = "AngularJS";
	$scope.hoten = "phan nhựt Giàu";
	$scope.email = "Email@example.com";
	$scope.phone = "0123456789";
	$scope.tile = "Lập trình gaio diện với AngularJS";
	$scope.web = 'www.example.com';
}