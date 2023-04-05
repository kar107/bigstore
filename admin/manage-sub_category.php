<?php  include('..\admin\partials\menu.php');  ?>


<section>
        <div class="container">
        <div class="stronghold-heading">
                        <div class="heading-subtitle">
                            <span class="heading-sep-front"></span>
                            <span class="heading-subtitle-span">Manage Sub Category</span>
                            <span class="heading-sep-front"></span>
                        </div>
                <?php
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }
                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }
                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                ?>
                        <a href="add-sub_category.php" class="btn mt-3" id="btn">Add Sub Category</a>
                    </div>

            <div class="row mt-3">

                <div class="col-12">
                    <div class="card" id="cart">
                        <h5 class="card-header">Sub Category Details</h5>
                        <div class="card-body">

                        <div class="wrapper">
                        <table class="table text-center table-hover table-borderless">
                        <thead class="table-header">
                          <tr>
                            <th scope="col">SR NO.</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Sub Category Name</th>
                            <th scope="col">Active</th>
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

                                    $query="SELECT scat.*,cat.category_name from sub_category scat INNER JOIN category cat on scat.category_id=cat.category_id LIMIT {$offset},{$limit}";
                                   $run=mysqli_query($conn,$query);
                                   $sn=1;
                                   if($run==true)
                                   {
                                       $count=mysqli_num_rows($run);
                                       if($count>0)
                                       {
                                           while($result=mysqli_fetch_assoc($run))
                                           {
                                               $id=$result['scategory_id'];
                                               $category_name=$result['category_name'];
                                                $sub_category_name=$result['sub_category_name'];
                                               $active=$result['active'];
                                               ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $category_name; ?></td>
                            <td><?php echo $sub_category_name; ?></td>
                            <?php
                                    if($active=='Yes')
                                    {
                                        ?>
                                                <td><span class="badge text-bg-success mt-2"><?php echo $active; ?></span></td>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>  
                                            <td><span class="badge text-bg-danger mt-2"><?php echo $active; ?></span></td>
                                        <?php
                                    }
                            ?>
                            <td>
                                <a href="update-sub_category.php?scategory_id=<?php echo $id; ?>" class="btn btn-success mt-2"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>  
                                <a href="delete-sub_category.php?scategory_id=<?php echo $id; ?>" class="btn btn-danger mt-2"><i class="fa-sharp fa-solid fa-trash-can"></i></a></td>
                            </td>
                        </tr>
                                               <?php
                                           }
                                       }
                                       else
                                       {
                                           ?>
                                         
                                           <td colspan="6"> <div class="alert w-100 text-center" role="alert">
                              <img src="..\assets\img\empty_cart.png" alt="" class="img-fluid" height="180px" width="180px">
                              <p class="empty mt-3">No sub category available..!</p>
                        </div> </td>
                                           <?php
                                       }
                                   }                             
                            ?>
                        </tbody>
                      </table>
                        </div>
                        <?php  
                $query1="select * from sub_category";
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
                            echo '<li class="page-item"><a class="page-link" href="manage-sub_category.php?page='.($page-1).'">Previous</a></li>';
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
                                    <li class="page-item <?php echo $active; ?>"><a class="page-link" href="manage-sub_category.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                           <?php
                        }
                        if($total_page>$page)
                        {
                            echo '<li class="page-item"><a class="page-link" href="manage-sub_category.php?page='.($page+1).'">Next</a></li>';
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
