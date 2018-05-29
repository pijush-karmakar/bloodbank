<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/BloodProcess.php'; ?>

<?php 

if( !isset($_GET['slider_id']) || $_GET['slider_id']==NULL ){
    echo '<script>window.location = "sliderlist.php";</script>';
}
else{
   $id = preg_replace('/[^-a-zA-Z0-9_]/', '',  $_GET['slider_id'] );
}

?>

<?php  
     $bp = new BloodProcess();
     if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
       
       $updateSlide = $bp->slideUpdate($_POST,$_FILES,$id);
   }

 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update slide
            <small> Update slide's image,details etc.... </small>
        </h1>
    </section>
    
 <?php 
                                   
     if( isset( $updateSlide ) ){
               echo $updateSlide;
        }

 ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">

                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php 

                              $getSlide = $bp->getSlideById($id);
                              if($getSlide){
                                 while ($result = $getSlide->fetch_assoc() ) {
                                     

                        ?>

                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Upload Image</label>
                                    <div class="col-sm-10">
                                        
                                        <input type="file" id="exampleInputFile" name="slider_image">
                                        <div class="proImg">
                                            <img src="<?php echo $result['slider_image']; ?>" alt="" class="productImage">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label"> Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="body">
                                            <?php echo $result['body']; ?>
                                        </textarea>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a class="btn btn-primary" href="sliderlist.php">Back slide List</a>
                                <input type="submit" name="submit" class="btn btn-success pull-right" value="Update">
                            </div>
                            <!-- /.box-footer -->
                        </form>

                      <?php } } ?>

                    </div>
                </div>
            </div>

        </div>



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
