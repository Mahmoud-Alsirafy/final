<?php
require "dev/style/head.php";
$query = "SELECT * FROM `mess`";
$result = mysqli_query($connect, $query);

?>



<table class="table w-100 container">
    <thead>
    <?php if (isset($_SESSION["delete"])) { ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_SESSION["delete"]; ?>
            </div>
          <?php }
          unset($_SESSION["delete"])
          ?>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Delete</th>

        </tr>
    </thead>
    <tbody>

        <?php
        if (mysqli_num_rows($result) > 0) {
            $mes = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($mes as $key => $value) {
                $id = $value["id"]
        ?>
                <tr>
                    <td scope="col"><?php echo ++$key ?></td>
                    <td scope="col"><?php echo $value["Name"] ?></td>
                    <td scope="col"><?php echo $value["Email"] ?></td>
                    <td scope="col"><?php echo $value["Subject"] ?></td>
                    <td scope="col"><?php echo $value["message"] ?></td>
                    <td scope="col"><a href="dev/message/delete_mess.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a></td>
                </tr>

        <?php }
        } ?>


      

    </tbody>
</table>





</body>
</html>