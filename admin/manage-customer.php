<?php  include('..\admin\partials\menu.php');  ?>


<section>
        <div class="container">

        <div class="stronghold-heading">
            <div class="heading-subtitle">
                <span class="heading-sep-front"></span>
                <span class="heading-subtitle-span">Manage Customer</span>
                <span class="heading-sep-front"></span>
            </div>
            <?php
                                if(isset($_SESSION['add']))
                                {
                                    echo $_SESSION['add'];
                                    unset($_SESSION['add']);
                                }
                                if(isset($_SESSION['delete']))
                                {
                                    echo $_SESSION['delete'];
                                    unset($_SESSION['delete']);
                                }
                        ?>
            <a href="..\admin\add-customer.php" class="btn mt-3" id="btn">Add Customer</a>
        </div>


            <div class="row mt-3">

                <div class="col-12">
                    <div class="card" id="cart">
                        <h5 class="card-header">Customers Details</h5>
                        <div class="card-body">

                        <div class="wrapper">
        <table class="table text-center table-hover table-borderless">
            <thead class="table-header">
                <tr>
                    <th scope="col">SR NO.</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-detail">

                    <?php
                            $limit=5;

                            if(isset($_GET['page']))
                            {
                                $page=$_GET['page'];
                            }
                            else
                            {
                                $page=1;
                            }
                            $offset=($page-1)*$limit;

                        $query="SELECT * from customer LIMIT {$offset},{$limit} ";
                        $run=mysqli_query($conn,$query);
                                $sn=1;
                        if($run==true)
                        {
                            $count=mysqli_num_rows($run);

                            if($count>0)
                            {
                                while($result=mysqli_fetch_assoc($run))
                                {
                                    $id=$result['id'];
                                    $fn=$result['fullname'];
                                    $email=$result['email'];

                                    ?>
                                    <tr>
                                    <td><?php  echo $sn++; ?></td>
                                    <td><?php  echo $fn; ?></td>
                                    <td><?php  echo $email; ?></td>
                                    <td>
                                <a href="delete-customer.php?id=<?php echo $id; ?>" class="btn btn-danger mt-2"><i class="fa-sharp fa-solid fa-trash-can"></i></a></td>
                                </td>
                                </tr>
                                    <?php
                                }
                            }
                            else
                            {
                            ?>
                            <td colspan="4"> <div class="alert w-100 text-center" role="alert">
                              <img src="..\assets\img\empty_cart.png" alt="" class="img-fluid" height="180px" width="180px">
                              <p class="empty mt-3">No customers available..!</p>
                        </div> </td>
                            <?php
                            }
                        }
                    ?>
            </tbody>
        </table>
        </div>
      
    <?php  
                $query1="select * from customer";
                $run1=mysqli_query($conn,$query1);
                if($run1==true)
                {
                    if(mysqli_num_rows($run1))
                    {
                        $total_records=mysqli_num_rows($run1);
                        $total_page=ceil($total_records/$limit);

                        echo '<ul class="pagination justify-content-center">';
                        if($page>1)
                        {
                            echo '<li class="page-item"><a class="page-link" href="manage-customer.php?page='.($page-1).'">Previous</a></li>';
                        }
                        for($i=1;$i<=$total_page;$i++)
                        {
                            if($i==$page)
                            {
                                $active="active";
                            }
                            else
                            {
                                $active="";
                            }
                           ?>
                                    <li class="page-item <?php echo $active; ?>"><a class="page-link" href="manage-customer.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                           <?php
                        }
                        if($total_page>$page)
                        {
                            echo '<li class="page-item"><a class="page-link" href="manage-customer.php?page='.($page+1).'">Next</a></li>';
                        }
                       
                        echo '</ul>';
                        
                    }
                }
    ?>
  
   



                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

<?php  include('..\admin\partials\footer.php');  ?>