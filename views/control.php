
<!--
Ben Chadwick
Jessica Sestak
Husrav Homidov

Team Dotcom
12/8/20
This website is the control page for the Admin user
-->
<body>
<!--NAVBAR-->
<nav class="navbar navbar-dark bg-dark navbar-expand-md fixed-top">
    <div class="container">
        <!-- Toggler For Mobile -->
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#myTogglerNav"
                aria-controls="myTogglerNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="index.php" class="navbar-brand">Kent Outreach</a>
        <div class="collapse navbar-collapse" id="myTogglerNav">
            <div class="navbar-nav">
                <a href="{{@BASE}}/index.php#assistance" class="nav-item nav-link">ASSISTANCE</a>
                <a href="{{@BASE}}/index.php#contact" class="nav-item nav-link">CONTACTS</a>
                <a href="getinvolved" class="nav-item nav-link active">GET INVOLVED</a>
                <a href="resources" class="nav-item nav-link">RESOURCES</a>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-item nav-link" href="logout">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- NAVBAR END -->

<!-- Page Top Section -->
<div class="w3-content pageStyle">
    <div class="w3-container w3-content w3-center w3-padding-64 band shadow-lg p-3 bg-white rounded">
        <!-- Page Top Title -->
        <div class="w3-container w3-content w3-center w3-padding-64" id="welcomeMessage">
            <h1>Control Page</h1>
        </div>
    </div>
</div>

<!--Table-->
<div class="w3-content pageStyle mt-5">
    <div class="band shadow-lg p-3 mb-5 bg-white rounded table-responsive">
        <table class="table display table-hover" id="user-table">
            <!-- Table columns -->
            <thead class="thead-light">
            <tr>
                <th scope="col"></th>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Zip</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Help List</th>
                <th scope="col">Comments</th>
                <th scope="col">Notes</th>
                <th scope="col">Attachments</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id="tableData">
            <repeat group="{{ @requests}}" value="{{ @request }}">
                <tr class="tableRow" id="row{{@request['id']}}" data-href="{{@request['id']}}">
                    <td><input class='completed' type='checkbox' id="complete{{@request['id']}}"></td>
                    <td date("M d, Y g:i a")>{{@request['date']}}</td>
                    <td>{{@request['FirstName']}} {{@request['LastName']}}</td>
                    <td>{{@request['Zip']}}</td>
                    <td>{{@request['Email']}}</td>
                    <td>{{@request['Phone']}}</td>
                    <td>{{@request['HelpList']}}</td>
                    <td>{{@request['Comments']}}</td>
                    <td class="notes" id="note{{@request['id']}}" contenteditable="true">{{@request['Note']}}</td>
                    <td class='text-center'>
                        <a href="{{@request['Attachments']}}" target='_blank'>
                            <check if="{{ @request['Attachments'] != 'uploads/' }}">
                                <true>
                                    <img class='img img-fluid' src='{{@BASE}}/images/paperclip.png' style='max-width: 40px; height: auto;'>
                                </true>
                            </check>
                        </a>
                    </td>
                    <td>
                        <a href='includes/delete.php?recordId={{@request["id"]}}' class='btn btn-sm text-white mt-2'>Delete</a>
                    </td>
                </tr>
            </repeat>
            </tbody>
        </table>

        <!-- Form Status -->
        <div class="row text-left mt-2">
            <div class="card mb-2 col-md-12 mx-auto">
                <h3 class="card-header text-center">Form Status</h3>
                <div class="card-body mx-auto row">
                    <div id="displayToggle" class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label id="onLabel" class="btn btn-dark">
                            <input type="radio" name="options" id="on" value="0"> On
                        </label>
                        <label id="offLabel" class="btn btn-dark">
                            <input type="radio" name="options" id="off" value="1"> Off
                        </label>
                        <label id="scheduleLabel" class="btn btn-dark">
                            <input type="radio" name="options" id="schedule" value="2"> Schedule
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Status End-->
    </div>
</div>
<!--Table End -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"
></script>
<script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"
></script>
<script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"
></script>
<!-- jQuery Data Table -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="scripts/control.js"></script>
</body>
</html>