<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITE_NAME ?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js"></script>
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-resource@1.2.0/dist/vue-resource.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

    <style>
        body {
            padding-top: 100px;
        }

    </style>

</head>
<body>
<div id='app'>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo SITE_NAME ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div v-bind:class="hasResult ? 'col-md-6' : 'col-md-12'">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Your Info</b></div>
                    <div class="panel-body">
                        <br>
                        <div class="col-md-10 col-md-offset-1">
                            <input type="text" class="form-control text-center" v-model='name' placeholder="Your Name"><br>
                            <input id="dob" type="text" class="form-control text-center" v-model='dob' placeholder="Your DOB"><br>
                            <br>
                            <button type="button" class="btn btn-primary btn-block" v-on:click="checkDOB"><i class="fa fa-cloud-download"></i>&nbsp;Impress Me!</button>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" v-if="hasResult" >
                <div class="panel panel-2 panel-default">
                    <div class="panel-heading"><b>Results</b></div>
                    <div class="panel-body row">
                        <div style="padding: 30px;">
                            <h4>You have been alive {{ current.years}} years</h4>
                            <h4>You have been alive {{ current.months}} months</h4>
                            <h4>You have been alive {{ current.days}} days</h4>
                            <h4>You have been alive {{ current.hours}} hours</h4>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-2 panel-default">
                    <div class="panel-heading"><b>History</b></div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Years</th>
                                <th>Months</th>
                                <th>Days</th>
                                <th>Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in history">
                                <td>{{ item.name }}</td>
                                <td>{{ item.dob }}</td>
                                <td>{{ item.years }}</td>
                                <td>{{ item.months }}</td>
                                <td>{{ item.days }}</td>
                                <td>{{ item.hours }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/app.js"></script>
<script>
    $('#dob').datepicker({
        format: "yyyy-mm-dd",
        orientation: "bottom auto"
    });
</script>
</body>