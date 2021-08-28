<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard | Events Booking Application</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Events Booking Dashboard </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <form acttion="" method="GET" class="row gy-2 gx-3 align-items-center">
                                    <div class="col-md-4">
                                        <input type="text" name="employee_name"  value="<?php echo isset($filters["employee_name"]) ?  $filters["employee_name"] :  "" ?>" class="form-control" placeholder="Employee Name...">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="event_name"  value="<?php echo isset($filters["event_name"]) ?  $filters["event_name"] :  "" ?>" class="form-control" placeholder="Event Name...">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="event_date"  value="<?php echo isset($filters["event_date"]) ?  $filters["event_date"] :  "" ?>" class="form-control" placeholder="Event Date...">
                                    </div>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Participation Id</th>
                                        <th>Employee Name</th>
                                        <th>Employee Mail</th>
                                        <th>Event Id </th>
                                        <th>Event Name</th>
                                        <th>Participation Fee</th>
                                        <th>Event Date</th>
                                        <th>Version</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                            if($events->count())
                                            {
                                                $sum = 0;
                                                foreach($events as $event)
                                                {  
                                                    ?>
                                                    <tr>
                                                        <td><?= $event->participation_id; ?></td>
                                                        <td><?= $event->employee_name; ?></td>
                                                        <td><?= $event->employee_mail; ?></td>
                                                        <td><?= $event->event_id; ?></td>
                                                        <td><?= $event->event_name; ?></td>
                                                        <td><?= (($sum += $event->participation_fee) ? $event->participation_fee : 0); ?></td>
                                                        <td><?= $event->event_date; ?></td>
                                                        <td><?= $event->version; ?></td>
                                                    </tr>
                                                <?php
                                                } 
                                                ?>

                                                <tr>
                                                    <th colspan="5">Total</th>
                                                    <th><?= $sum ?></th> 
                                                </tr>
                                            
                                            <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <tr>
                                                        <td colspan="8">No Events Found...</td>
                                                    </tr>
                                                <?php
                                            }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>