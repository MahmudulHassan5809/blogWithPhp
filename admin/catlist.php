<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
               <?php 
                 if(isset($_GET['delid']))
                {
                	$delid=$_GET['delid'];
                	$delquery="DELETE from tbl_catagory where id='$delid'";
                	$deldata=$db->delete($delquery);
                	if($deldata)
            {
               echo "<span style='color:green'>Catagory deleted Successfully</span>";  
            }
            else
            {
              echo "<span style='color:red'>>Catagory Not deleted</span>";  
            }
                }

               ?>

                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody>
					  <?php
                     $query="SELECT * from tbl_catagory ORDER BY id asc ";
                     $catagory=$db->select($query);
                     if($catagory)
                     {
                     	    $i=0;
                     	while ($result=$catagory->fetch_assoc()) {
                     		$i++;
                     	?>
						<tr class="odd gradeX">
							<td><?Php echo $i;  ?></td>
							<td><?Php echo $result['name']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a href="?delid=<?php echo $result['id']; ?>" onclick="return confirm('Are You Sure');">Delete</a></td>
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
