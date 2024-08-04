<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Lists</title>
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="images/favicon-16x16.png">
</head>

<body>
    <?php include 'adminNav.php' ?>
    <?php include("connect_database.php"); ?>



    <div class="container p-4">
    </div>

    <div class="shadow-lg p-3 mb-5 bg-white rounded container p-4">
        <h3>List of Users</h3>
        <hr>

        <div class="container my-4">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope=" col">SRno</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">State</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `user_data`";
                    $result = mysqli_query($database, $sql);

                    $srno = 1;
                    while ($row = mysqli_fetch_assoc($result)) {

                        $name = $row['firstname'];
                        $state = $row['state'];
                        $country = $row['country'];
                        $email = $row['user_id'];
                        $id = $row['id'];
                        echo '<tr>
                            <td scope="row">' . $srno . '</td>
                            <td>' . $id . '</td>
                            <td>' . $name . '</td>
                            <td>' . $email . '</td>
                            <td>' . $state . '</td>
                            <td>' . $country . '</td>
                            <td> <a class=" btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#Del" data-id="' . $row['id'] . '">Delete</a></td>
                        </tr>';

                        $srno = $srno + 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php

    echo ' <div class="modal fade" id="Del" tabindex="-1" aria-labelledby="Del" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="Del">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="deleteUserAdmin.php" method="post">
                    <div class="modal-body">
                        <h4>Are you sure ?</h4>
                    </div>
                
                    <div class="modal-footer">
                        <input type="hidden" name="id" value="" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button name="userDelete" type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    ';
    ?>
    <?php include("footer.php"); ?>


    <!-- jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });


        // Delete 
        $(document).ready(function() {
            $('a.delete').click(function(e) {
                e.preventDefault();
                var link = this;
                var deleteModal = $("#DelExampleModal");
                // store the ID inside the modal's form
                deleteModal.find('input[name=id]').val(link.dataset.id);
                // open modal
                deleteModal.modal();
            });
        });
    </script>


</body>

</html>