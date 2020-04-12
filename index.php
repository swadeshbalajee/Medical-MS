<?php

//error_reporting(E_ERROR | E_PARSE);
    include('connect.php');
 if(isset($_POST['submit']))
    {
          $sql ="select p_id.nextval from dual";
          $query = oci_parse($conn,$sql);
          oci_execute($query,OCI_NO_AUTO_COMMIT);
          $row=oci_fetch_array($query,OCI_ASSOC);

        $pid = $row['NEXTVAL'];
        $docid=$_POST['doc'];
        $firstn=$_POST['fname'];
        $lastn=$_POST['lname'];
        $age=$_POST['age'];
        $sex=$_POST['sex'];
        $Pno=$_POST['phone'];
        $address=$_POST['address'];
        $pin=$_POST['pin'];
    
        
        $sql="insert into patient(p_id,doc_id,first_name,last_name,age,sex,phone_no,address,pincode) values($pid,$docid,'$firstn','$lastn',$age,'$sex',$Pno,'$address',$pin)";
        $query = oci_parse($conn,$sql);

        if(oci_execute($query))
        {
          echo '<script type="text/javascript">','myfunc("Inserted successfully");','</script>';
        }
        else{
          echo '<script type="text/javascript">','myfunc("Error while inserting. Invalid Doctor_id or Patient_id already exist");','</script>';
        }

        $sql = "insert into summary(doc_id,p_id) values($docid,$pid)";
        $query = oci_parse($conn,$sql);
        oci_execute($query);

        $sql  = "insert into advice(p_id) values($pid)";
        $query = oci_parse($conn,$sql);
        oci_execute($query);
     }
     header('location:index.html');
?>