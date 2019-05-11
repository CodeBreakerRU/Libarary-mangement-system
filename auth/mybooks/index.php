<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<?php include_once("main-menu.html"); ?>
<head>
<title> My Books </title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

</head>
<body>
<div class="container">

	<h3 align="center"> My Books </h3>

	<div ng-app="sa_display" ng-controller="controller" ng-init="display_data()">
		<table class="table table-bordered">
			<tr>
				<th>Book ID</th>
                <th>Book Name</th>
				<th>Borrowed Date</th>
                <th>Returned Date</th>
				<th>Status</th>
			</tr>
			<tr ng-repeat="x in names">
				<td>{{x.bookid}}</td>
                <td>{{x.bname}}</td>
				<td>{{x.borrowed_time}}</td>
                <td>{{x.returned_time}}</td>
				<td>{{x.status}}</td>
			</tr>
		</table>
	</div>
</div>

<script>
    var app = angular.module("sa_display", []);
    app.controller("controller", function($scope, $http) {
        $scope.display_data = function() {
            $http.get("fetch.php")
            .success(function(data) {
                $scope.names = data;
            });
        }
    });
</script>

</body>
<?php include_once("../../main-footer.html"); ?>
</html>