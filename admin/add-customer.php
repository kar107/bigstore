<?php  include('..\admin\partials\menu.php');  ?>

<section>
        <div class="container mt-5">

                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="..\admin\manage-customer.php" style="text-decoration:none;">
                                <p class="text-danger">Manage Customer</p>
                            </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer</li>
                    </ol>
                </nav>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-12">
       
                        <h4 class="signuptitle1">Welcome,</h4>
                        <h4 class="signuptitle">Add New Customer</h4>
    
                        <p class="signinmsg mt-2">Add your new customer</p>
                        <?php
                                if(isset($_SESSION['pass-not-match']))
                                {
                                    echo $_SESSION['pass-not-match'];
                                    unset($_SESSION['pass-not-match']);
                                }
                        ?>
                        <form action="" method="POST" onSubmit="return validateform()" name="frmuserreg" >
                            <div class="form-group mt-3">
                                <input type="text" class="form-control shadow-sm" placeholder="Full Name" id="user" name="t1">
                            </div>

                            <div class="form-group mt-3">
                                <input type="email" class="form-control shadow-sm" placeholder="Email Address" id="user" name="t2">
                            </div>
    
                            <div class="form-group mt-3">
                                <input type="password" class="form-control shadow-sm" placeholder="Password" id="user" name="t3">
                            </div>

                            <div class="form-group mt-3">
                                <input type="password" class="form-control shadow-sm" placeholder="Confirm Password" id="user" name="t4">
                            </div>
    
                            <div class="form-group mt-4">
                                <input type="submit" class="form-control shadow-sm" value="Add Customer" id="signupbtn" name="s1">

                            </div>
                        </form>
    
                </div>
            </div>
        
        </div>
    </section>

<?php  include('..\admin\partials\footer.php');  ?>

<?php
        if(isset($_POST['s1']))
        {
            $fn=$_POST['t1'];
            $email=$_POST['t2'];
            $pass=$_POST['t3'];
            $cpass=$_POST['t4'];

            if($pass==$cpass)
            {
                $query="select * from customer where email='$email'";
                $run=mysqli_query($conn,$query);

                if(!$run->num_rows>0)
                {
                    $query="insert into customer(fullname,email,password) values('$fn','$email','$pass')";
                    $run=mysqli_query($conn,$query);
                if($run)
                {
                    echo "<script>window.location='manage-customer.php';</script>";
                  $_SESSION['add']="<p class='validation-green'>wow!! Customer Added successfully</p>";
                }
                }
                else
                {
                    echo "<script>window.location='add-customer.php';</script>";
                  $_SESSION['pass-not-match']="<p class='text-center validation-red'>Woops! Email Already Exists.</p>";
                }
                
            }
            else
            {
                echo "<script>window.location='add-customer.php';</script>";
              $_SESSION['pass-not-match']="<p class='text-center validation-red'>'Woops!! Confirm Password Not Match.</p>";
            }
           
        }

?>

<script type="application/javascript">

    var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
    var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
    var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
    var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
    var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

    function validateform()
    {
        if(document.frmuserreg.t1.value == "")
        {
            alert("Fullname should not be empty.!");
            document.frmuserreg.t1.focus();
            return false;
        }
        else if(!document.frmuserreg.t1.value.match(alphaspaceExp))
        {
            alert("Fullname should be in character.!");
            document.frmuserreg.t1.focus();
            return false;
        }
        else if(document.frmuserreg.t2.value == "")
        {
            alert("Email address should not be empty.!");
            document.frmuserreg.t2.focus();
            return false;
        }
        else if(!document.frmuserreg.t2.value.match(emailExp))
        {
            alert("Email invalid.!");
            document.frmuserreg.t2.focus();
            return false;
        }
        else if(document.frmuserreg.t3.value == "")
        {
            alert("Password should not be empty.!");
            document.frmuserreg.t3.focus();
            return false;
        }
        else if(document.frmuserreg.t4.value == "")
        {
            alert("Confirm Password should not be empty.!");
            document.frmuserreg.t4.focus();
            return false;
        }
        else if(document.frmuserreg.t3.value.length < 8)
        {
            alert("Password length should be more than 8 characters...");
            document.frmuserreg.t3.focus();
            return false;
        }
    }
</script>