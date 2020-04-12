<script type="text/javascript">
function myfunc($var)
{
     alert($var);
}
</script>
<?php
      error_reporting(E_ERROR | E_PARSE);
     include('connect.php');
    if(!($id = $_SESSION['id']))
    {
         header('location:doctors.php');
    }

     if(isset($_POST['update'])){
          $arr[0] = $_POST['pid'];
          $arr[1] = $_POST['disease'];//2
          $arr[2] = $_POST['med']; $med = (explode(",",$arr[2]));
          $arr[3] = $_POST['first_name']; //1
          $arr[4] = $_POST['last_name'];//1
          $arr[5]= $_POST['sex'];//1
          $arr[6] = $_POST['Pno'];//1
          $arr[7] = $_POST['symp']; //2
          $arr[8] = $_POST['diet'];
          $arr[9] = $_POST['dos'];
          $arr[10] = $_POST['donts'];
          $arr[11] = $_POST['address'];//1

          $arr1[0] = 'p_id';
          $arr1[1] = 'd_name';
          $arr1[2] = 'med_sugg';
          $arr1[3] = 'first_name';
          $arr1[4] = 'last_name';
          $arr1[5] = 'sex';
          $arr1[6] = 'phone_no';
          $arr1[7] = 'symptom';
          $arr1[8] = 'diet';
          $arr1[9] = 'dos';
          $arr1[10] = 'donts';
          $arr1[11] = 'address';  
          $i=11;$a1=$a2=$a3=$a4=$a6=1;

          while($i>=0){

               if(($i==3 ||$i==4 ||$i==5 ||$i==6 ||$i==11) && $arr[$i] !=NULL){
                    if($i==6 && $arr[$i])
                         $sql = "update patient set $arr1[$i]=$arr[$i] where p_id = $arr[0]";
                    else{
                         $sql = "update patient set $arr1[$i]='$arr[$i]' where p_id = $arr[0]";
                    }

                    $query = oci_parse($conn,$sql);
                    $a1=oci_execute($query,OCI_NO_AUTO_COMMIT);
                    
               }
               if(($i==7 || $i==1) && $arr[$i]!=NULL){
                    $sql = "update summary set $arr1[$i]='$arr[$i]' where p_id = $arr[0]";
                    $query = oci_parse($conn,$sql);
                    $a2=oci_execute($query,OCI_NO_AUTO_COMMIT);

                    $sql = "update summary set last_visited=sysdate where p_id = $arr[0]";
                    $query = oci_parse($conn,$sql);
                    $a6=oci_execute($query,OCI_NO_AUTO_COMMIT);

                    if($i==1){
                    $sql = "update has set $arr1[1]='$arr[1]' where p_id = $arr[0]";
                    $query = oci_parse($conn,$sql);
                    $a5=oci_execute($query,OCI_NO_AUTO_COMMIT);
                    }
               
               }

               if(($i==8 || $i==9 || $i==10) && $arr[$i]!=NULL){
                    $sql = "update advice set $arr1[$i]='$arr[$i]' where p_id = $arr[0]";
                    $query = oci_parse($conn,$sql);
                    $a3= oci_execute($query,OCI_NO_AUTO_COMMIT);
               }
               $i--;
               
          }
          $j=0;
          while($med[$j]!=NULL)
          {
               $sql = "insert into summary_med_sugg(med_sugg,doc_id,p_id) values('$med[$j]',$id,$arr[0])";
               $query = oci_parse($conn,$sql);
               $a4= oci_execute($query,OCI_NO_AUTO_COMMIT);
               $j++;
          }

          if($a1 && $a2 && $a3 && $a4 && $a6)
          {
               oci_commit($conn);
          }
          else{
               echo '<script type="text/javascript">','myfunc("Error while inserting. Invalid Doctor_id or Patient_id already exist");','</script>';
          }

     }

     ?>

<!DOCTYPE html>
<html lang="en">
<head>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="svjk0" >
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

  
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

   
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>

     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a>
               </div>

               
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="#top" class="smoothScroll">Home</a></li>
                         <li><a href="#refer" class="smoothScroll">Search</a></li>
                         <li><a href="#details" class="smoothScroll">View Patient details</a></li>
                         
                         <li class="appointment-btn"><a href="#appointment">Update patient details</a></li>
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                         <div class="owl-carousel owl-theme">
                              <div class="item item-first">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h1>Information is wealth</h1>
                                             
                                             <a href="#refer" class="section-btn btn btn-default smoothScroll">Refer Data base</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-second">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h1>Entry for progress</h1>
                                           
                                             <a href="#appointment" class="section-btn btn btn-default btn-gray smoothScroll">Update patient details</a>
                                        </div>
                                   </div>
                              </div>

                              <div class="item item-third">
                                   <div class="caption">
                                        <div class="col-md-offset-1 col-md-10">
                                             <h1>We care for your health</h1>
                                            
                                             <a href="#details" class="section-btn btn btn-default btn-blue smoothScroll">Patient details</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     


      <body style="height:30%">
     <section id="refer" data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                  

                    <div class="col-md-6 col-sm-6" style="margin-left:290px">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="result.php" >
										
                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:100px">Enter to search</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s" >
                                   <div class="col-md-6 col-sm-6" >
                                        <label for="name">Disease</label>
                                        <input  type="text" class="form-control" id="name" name="disease" placeholder="disease">
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Medicine</label>
                                        <input  type="text" class="form-control" id="name" name="med" placeholder="Medicine">
                                   </div>

                                   

                                   <div class="col-md-6 col-sm-6"  >
                                        <label for="Message" style="margin-left: 225px; margin-top: 20px;margin-bottom: 0px;">Symptom</label>
                                        <textarea class="form-control" rows="7" id="message" name="symp" style="margin-left: 140px";></textarea>
                                        
                                  
                                   
                                   
                                   
                                        <button class="form-control" type="submit"  id="cf-submit" name="submit" style = "background-color:YellowGreen;color:white;width:150px;height:45px;margin-top:50px;margin-left: 190px;">Submit </button>
                             
                                   </div>
                              
                              
                              
                        </form>
                    </div>

               </div>
          </div>
     </section>
     
     </body>
     


     <!-- NEWS -->
     <section id="details" data-stellar-background-ratio="5" >
          <div class="container">
               <div class="row">

                   

                    <div class="col-md-6 col-sm-6" style="margin-left:290px" >
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="patient_details.php" >
										
                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:190px">View details</h2>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s"  >
                                   <div class="col-md-6 col-sm-6">
                                        <label for="name">Name</label>
                                        <input  type="text" class="form-control" id="name" name="name" placeholder="Name">
                                   </div>

                                   

                                   <div class="col-md-6 col-sm-6">
                                        <label for="pid">Enter patient id</label>
                                        <input  type="number" class="form-control" id="phone" name="pid" placeholder="id">
                                        
                                   </div>
                                   
                                    <div >
                                        <label for="pin">Pincode</label>
                                        <input size="10"  type="number" class="form-control" id="phone" name="pin" placeholder="pin">
                                        
                                   </div>
                                   
                                    <div class="col-md-6 col-sm-6">
                                        <label for="age">Age</label>
                                        <input  type="number" class="form-control" id="phone" name="age" placeholder="age">
                                        <label for="select">Comparator</label>
                                        <select class="form-control" name="comp">
                                             <option value="1">Less Than</option>
                                             <option value="2">Greater Than</option>
                                             <option value="3">Equal to</option>
                                        </select>
                                        </div>
                                         <div class="col-md-6 col-sm-6">
                                        <label for="dname">Disease name</label>
                                        <input  type="text" class="form-control" id="phone" name="dname" >
                                        </div>
                                          <div class="col-md-6 col-sm-6">
                                        <label for="select">Sex</label>
                                        <select class="form-control" name="sex">
                                             <option value='A'></option>
                                             <option value='M' >Male</option>
                                             <option value='F' >Female</option>
                                             
                                             <option value='O'>Others</option>
                                        </select>
                                   </div>
                                        
                                   </div>
                                        
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6" >
                                   
                                   
                                        <button class="form-control" type="submit" class="form-control" id="cf-submit" name="submit" style = "background-color:YellowGreen;color:white;width:150px;height:50px;margin-top:40px;margin-bottom:60px;margin-left:170px">Submit</button>
                             
	                           </div>	
                              </div>
                              </div>
                              
                              
                        </form>
                    </div>

               </div>
          </div>
     </section>
     


     
     <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">

                    

                    <div class="col-md-6 col-sm-6" style="margin-left:290px">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="doc.php">

                              <!-- SECTION TITLE -->
                              <div style="text-align:center">
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 style="margin-top:70px">Update here</h2>
                              </div>
                              </div>

                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-6 col-sm-6">
                                        <label for="id">P_id</label>
                                        <input type="text" class="form-control" id="name" name="pid" placeholder="id" required>
                                   </div>

                                   <div class="col-md-6 col-sm-6">
                                        <label for="disease">Disease</label>
                                        <input type="text" class="form-control" id="email" name="disease" placeholder="disease">
                                   </div>

                                  

                                   <div class="col-md-6 col-sm-6">
                                        <label for="select">Remedy suggested</label>
                                        <input type="text" name="med" value="" class="form-control" placeholder="med">
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6">
                                        <label for="select">First Name</label>
                                        <input type="text" name="first name" value="" class="form-control" placeholder="first name">
                                   </div>
                                   
                                    <div class="col-md-6 col-sm-6">
                                        <label for="select">Last Name</label>
                                        <input type="text" name="last name" value="" class="form-control" placeholder="last name">
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6">
                                        <label for="select">Sex</label>
                                        <input type="text" name="sex" value="" class="form-control" placeholder="Sex">
                                   </div>
                                   
                                   <div class="col-md-6 col-sm-6">
                                        <label for="select">Phone number</label>
                                        <input type="tel" name="Pno" value="" class="form-control" >
                                   </div>
												 <div class="col-md-6 col-sm-6">
                                        <label for="Message">Symptom</label>
                                        <textarea class="form-control" rows="5" id="message" name="symp"></textarea>
                                   </div>
                                   <div class="col-md-12 col-sm-12">
                                       <label for="Message">Diet</label>
                                        <textarea class="form-control" rows="5" id="message" name="diet"></textarea>
                                        <label for="Message">Do's</label>
                                        <textarea class="form-control" rows="5" id="message" name="dos"></textarea>
                                         <label for="Message">Dont's</label>
                                        <textarea class="form-control" rows="5" id="message" name="donts"></textarea>
                                        <label for="Message">Address</label>
                                        <textarea class="form-control" rows="5" id="message" name="address"></textarea>
														          
                                        <button class="form-control" type="submit" class="form-control" id="cf-submit" name="update" style = "width:150px;height:50px;margin-top:10px;margin-bottom:30px;padding-left: 10px; float: left;">Update</button>
                                        <button class="form-control"type="reset" style = "width:150px;height:50px;margin-top:10px;margin-bottom:30px;padding-left: 10px;float: right;"class="form-control" id="cf-submit" name="Reset">Reset</button>
                                   
                                   </div>
                              </div>
                        </form>
                    </div>

               </div>
          </div>
     </section>


     <!-- GOOGLE MAP -->
              


     <!-- FOOTER -->
     

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>