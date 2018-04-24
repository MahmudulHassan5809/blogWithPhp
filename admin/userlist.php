<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
               <?php 
                 if(isset($_GET['deluser']))
                {
                	$delid=$_GET['deluser'];
                	$delquery="DELETE from tbl_user where id='$delid'";
                	$deldata=$db->delete($delquery);
                	if($deldata)
            {
               echo "<span style='color:green'>User deleted Successfully</span>";  
            }
            else
            {
              echo "<span style='color:red'>>User Not deleted</span>";  
            }
                }

               ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
                            <th>Name</th>
							<th>User Name</th>
                            <th>Eamil</th>
                            <th>Details</th>
                            <th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
					  <?php
                     $query="SELECT * from tbl_user ORDER BY id asc ";
                     $alluser=$db->select($query);
                     if($alluser)
                     {
                     	    $i=0;
                     	while ($result=$alluser->fetch_assoc()) {
                     		$i++;
                     	?>
						<tr class="odd gradeX">
							<td><?Php echo $i;  ?></td>
							<td><?Php echo $result['name']; ?></td>
                            <td><?Php echo $result['username']; ?></td>
                            <td><?Php echo $result['email']; ?></td>
                            <td><?Php echo $fm->textShort($result['details'],30);?></td>
                            <td>

                            <?Php 
                               if ($result['role']=='0') {
                                  echo "Admin";
                               }
                               elseif ($result['role']=='1') {
                                  echo "Author";
                               }
                             elseif ($result['role']=='2') {
                                  echo "Editor";
                               }



                            ?>
                                


                            </td>
							<td><a href="viewuser.php?userid=<?php echo $result['id']; ?>">View User</a> ||
                <?php

                  if (Session::get('userRole')=='0') {
                      # code...
                  


                ?>




               ||<a href="?deluser=<?php echo $result['id']; ?>" onclick="return confirm('Are You Sure');">Delete</a></td>
               <?php } ?>
						</tr>
						<?php } }?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
       <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>

       <?php include 'inc/footer.php';  ?>
