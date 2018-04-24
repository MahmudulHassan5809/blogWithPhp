<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
						    <th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>

                  <?php  
                   $query="SELECT tbl_post.*,tbl_catagory.name from tbl_post INNER JOIN tbl_catagory on tbl_post.cat=tbl_catagory.id order by tbl_post.title desc ";
                     $post=$db->select($query);
                     if($post)
                     {
                     	 $i=0;
                     	while ($result=$post->fetch_assoc()) {
                     		$i++;
                     	
                     


                  ?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo  $fm->textShort($result['body'],50); ?></td>
							<td ><?php echo $result['name']; ?></td>
							<td><img src="<?php echo $result['image']; ?>" height="60px" width="40px"></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td ><?php echo $fm->formatDate($result['date']); ?></td>
							<td>

                            <a href="viewpost.php?viewid=<?php echo $result['id']; ?>">View</a> ||
                            <?php  

                             if( Session::get('userid')==$result['userid']||Session::get('userRole')=='0'){

                            ?>
							<a href="editpost.php?editid=<?php echo $result['userid']; ?>">Edit</a> || 
                            

							<a href="deletepost.php?delid=<?php echo $result['id']; ?>" onclick="return confirm('Are You Sure');">Delete</a>

                           <?php } ?>
							</td>
						</tr>
					 <?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
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
