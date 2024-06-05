<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

</head>
<body>
    
    <div class="container-fluid">
        <div class="navbar  justify-content-center">
            <ul class="nav justify-content-center">
                <li class="nav-item" style="align-self: center;">
                    <div style="display: flex;justify-content: center;margin: 15px;color:#1e128b">
                        <h3>To-Do Application</h3>
                    </div>
                </li>
            </ul>
            
            
        </div>
        <hr>
        <div class="container-fluid" style="margin-top:75px">
            <div class="row justify-content-center ">
                    <div class="col-md-4 " style="border-radius: 8px;background-color:wheat;height:500px;overflow:scroll">
                        <!-- <h3>Today</h3>
                        <div class="row justify-content-center " style="border-radius: 10px;background-color:white;margin:10px;">
                            <div class="col-md-2">
                                <input type="checkbox" name="task" id="">
                            </div>
                            <div class="col-md-6 text-center">
                                <p>Work on UI of the application</p>
                            </div>
                            <div class="col-md-3" style="color: red;">
                                Incomplete
                            </div>
                        </div> -->
                        <?php 
                            $previousDate = null;
                            for($i=0;$i<sizeof($todos);$i++)
                            {
                                $dbdate = $todos[$i]["task_date"];
                                $selectdate = explode(" ",$dbdate)[0];
                                $formatted = date('Y-m-d');
                                if ($selectdate != $previousDate) 
                                {
                                    
                                    if ($selectdate == $formatted) {
                                        echo "<h3>Today</h3>";
                                    } else if($selectdate > $formatted) {
                                        echo "<h4>Upcoming  $selectdate</h4>";
                                    }
                                    $previousDate = $selectdate;
                                }
                                
                                $color = $todos[$i]["status"]==0?"red":"green";
                                $status = $todos[$i]["status"]==0?"Incomplete":"Completed";
                                $disable = $todos[$i]["status"]==0?"":"disabled";
                                $deco = $todos[$i]["status"]==0?"":"line-through";
                                $bg = $todos[$i]["status"]==0?"white":"rgb(233,233,233)";
                                echo '<div class="row justify-content-center " style="border-radius: 10px;align-content:center;align-items:center;';
                                echo 'background-color:'.$bg.';margin:10px;text-decoration:'.$deco.'">';
                                echo '<div class="col-md-2">
                                    <input onclick=updateStatus('.$todos[$i]["id"].')  '.$disable.' type="checkbox" name="task" id="">
                                </div>';
                                echo '<div class="col-md-6 text-center" style="align-items:center;">';
                                echo '<p style="align-items:center"> '.$todos[$i]["task_name"].' </p>';                               
                                echo ' </div>';
                                echo '<div class="col-md-3" style="color: '.$color.';">';
                                echo $status;
                                echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                
                    <div class="col-md-6 text-center" style="border-radius: 8px;background-color:aliceblue">
                    <h3>Add New Todo</h3>
                    
                    <hr>
                        <form action="<?php echo base_url(); ?>index.php/welcome/validate" method="post" >
                            <div class="row">
                                <label class="col-md-4" for="taskname">Task *</label>
                                <input required class="col-md-7" name="taskName" type="text">
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-md-4" for="taskname">Description </label>
                                <textarea class="col-md-7" name="taskDesc" id=""style="height:100px"></textarea>
                            </div>  
                            <br>
                            <div class="row">
                                <label class="col-md-4" for="taskname">Date *</label>

                                <input required class="col-md-7" name="selectdate" id="selectdate" type="date">
                            </div>   
                            <br>
                            <p style="color: red;">* indicates required</p>

                            <div class="row justify-content-center">
                                <button type="submit" class="col-md-4 btn" style="background-color: #1e128b;color:white">Add Todo</button> 
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div> 
</body>
<script>
    var selectedDate = document.getElementById("selectdate");
    var today = new Date();
    var date = today.toISOString().split("T")[0];
    selectedDate.setAttribute("min",date);

    function updateStatus(id)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST","<?php echo base_url(); ?>index.php/welcome/update/"+id);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
        xhttp.onreadystatechange = function(){
            if(this.status==200 && this.readyState ==4)
            {
                var data = this.responseText;
                if(data=="success")
                {
                    console.log("Updated");
                    location.reload();
                }
                else
                {
                    console.log("Not updated");
                    location.reload();
                }
            }
        }
    }
</script>
</html>