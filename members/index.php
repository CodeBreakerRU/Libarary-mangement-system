<!DOCTYPE html>
<?php include_once("../main-menu-admin.html"); ?>

	<head>
		<title> Manage members </title>
		<script src="jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		<script src="jquery.dataTables.min.js"></script>
		<script src="angular-datatables.min.js"></script>
		<script src="bootstrap.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css">
		<link rel="stylesheet" href="datatables.bootstrap.css">
		
	</head>
	<body ng-app="crudApp" ng-controller="crudController">
		
		<div class="container" ng-init="fetchData()">
			<br />
				<h3 align="center"> Manage members </h3>
			<br />

			<div class="alert alert-success alert-dismissible" ng-show="success" >
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{successMessage}}
			</div>

			<br />
			<div class="table-responsive" style="overflow-x: unset;">
				<table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered table-striped">
					<thead>

							 <th> ID Number </th>
							 <th> Name </th>
							 <th> Address </th>
                            <th> Phone </th>
                            <th> </th>

						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="name in namesData">
                            <td>{{name.username}}</td>
							 <td>{{name.name}}</td>
							 <td>{{name.address}}</td>
                            <td>{{name.phone}}</td>

							<td><button type="button" ng-click="fetchSingleData(name.id)" class="btn btn-warning btn-xs"> Edit Member details </button></td>

						</tr>
					</tbody>
				</table>
			</div>

		</div>

	</body>


<?php include_once("../main-footer.html"); ?>

</html>

<div class="modal fade" tabindex="-1" role="dialog" id="crudmodal">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">

    		<form method="post" ng-submit="submitForm()">

	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">{{modalTitle}}</h4>
	      		</div>

	      		<div class="modal-body">
	      			<div class="alert alert-danger alert-dismissible" ng-show="error" >
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						{{errorMessage}}
					</div>

					<div class="form-group">
						<label> Name</label>
						<input type="text" name="name" ng-model="name" class="form-control" />
					</div>

					<div class="form-group">
						<label> Address </label>
						<input type="text" name="address" ng-model="address" class="form-control" />
					</div>

                    <div class="form-group">
                        <label> Phone </label>
                        <input type="text" name="phone" ng-model="phone" class="form-control" />
                    </div>

	      		</div>
	      		<div class="modal-footer">
	      			<input type="hidden" name="hidden_id" value="{{hidden_id}}" />
	      			<input type="submit" name="submit" id="submit" class="btn btn-info" value="{{submit_button}}" />
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	</div>
	        </form>
    	</div>
  	</div>
</div>


<script>

var app = angular.module('crudApp', ['datatables']);
app.controller('crudController', function($scope, $http){

	$scope.success = false;

	$scope.error = false;

	$scope.fetchData = function(){
		$http.get('fetch.php').success(function(data){
			$scope.namesData = data;
		});
	};

	$scope.openModal = function(){
		var modal_popup = angular.element('#crudmodal');
		modal_popup.modal('show');
	};

	$scope.closeModal = function(){
		var modal_popup = angular.element('#crudmodal');
		modal_popup.modal('hide');
	};


	$scope.submitForm = function(){
		$http({
			method:"POST",
			url:"insert.php",
			data:{'name':$scope.name, 'address':$scope.address, 'phone':$scope.phone, 'action':$scope.submit_button, 'id':$scope.hidden_id}
		}).success(function(data){
			if(data.error != '')
			{
				$scope.success = false;
				$scope.error = true;
				$scope.errorMessage = data.error;
			}
			else
			{
				$scope.success = true;
				$scope.error = false;
				$scope.successMessage = data.message;
				$scope.form_data = {};
				$scope.closeModal();
				$scope.fetchData();
			}
		});
	};

	$scope.fetchSingleData = function(id)
    {
		$http(
		{
			method:"POST",
			url:"insert.php",
			data:{'id':id, 'action':'fetch_single_data'
			}
		}).success(function(data)
        {
			$scope.name = data.name;
			$scope.address = data.address;
            $scope.phone = data.phone;

			$scope.hidden_id = id;
			$scope.modalTitle = 'Update Member Details';
			$scope.submit_button = 'Edit';
			$scope.openModal();
		});
	};


});

</script>

