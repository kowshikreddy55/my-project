




                    <div class="col-lg-12">
                      

                        <h1 class="page-header">
                            Users
                         <h3 class="h3 bg-success"><?php display_message(); ?></h3>
                        </h1>
                          <p class="bg-success">
                          <!--   <?php echo $message; ?> -->
                        </p>

                        <a href="add_user.php" class="btn btn-primary">Add User</a>


                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>


                            <?php show_users() ?>


          


                                    
                                    
                                </tbody>
                            </table> <!--End of Table-->
                        

                        </div>










                        
                    </div>
    










