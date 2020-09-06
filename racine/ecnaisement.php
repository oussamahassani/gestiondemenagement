
		     
			 <div class=" border border-success" >	
			  	<p class="text-black p-3 mb-2 bg-light" style="text-align: center;"><strong>Liste encaissement effectué  </strong></p>
		   		  
					    </br> 
						<div class="card-body">
                  <div class="table-responsive" id="resultatRecherche">
                     <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead class="table-dark">
                           <tr>
                              <th width="7%">N° facture</th>
                              <th width="10%">Date action</th>
                              <th width="8%">User </th>
                              <th width="10%">Montant</th>
							   <th width="10%">Type encaisement</th>
							   <th width="10%">Action</th>
							    <th width="10%">date creation</th>
                            
                           </tr>
                        </thead>
                        <tbody>
                           <?php
						   require_once '../connect.php';
						   if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	                      $page_no = $_GET['page_no'];
	                       } else {
	                      	$page_no = 1;
                                }
						   	$total_records_per_page = 8;
                            $offset = ($page_no-1) * $total_records_per_page;
	                       $previous_page = $page_no - 1;
	                       $next_page = $page_no + 1;
	                       $adjacents = "2";
                           $req=mysql_query("select * from facturation LIMIT $offset, $total_records_per_page");
	                       $result_count = mysql_query("SELECT COUNT(*) As total_records FROM `facturation`");
						   $total_records = mysql_fetch_array($result_count);
	                       $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
	                         $second_last = $total_no_of_pages - 1; // total page minus 1

                           while($result=mysql_fetch_array($req)) {
                              // Check relance
                       			
                           ?>
                           <tr>
                              <td><?php echo $result['numero_Facture']; ?></td>
                              <td>
                                 <?php 
                                    echo $result['date_action'];
                                    
                                 ?> 
                              </td>
                              
                              <td>
                                 <?php  
                                    echo $result['user'];
                                    
                                 ?> 
                              </td>
                              <td>
                                 <?php 
                                  echo $result['montant'];                        
						   ?>  
                               </td>
							    <td>	
                                 <?php echo $result['type_encaissement']; ?> 
                                                                                                                                                             
                             					   
                              
                              </td>
							    <td>	
                                 <?php echo $result['action']; ?> 
                                                                                                                                                             
                             					   
                              
                              </td>
							      <td>	
                                 <?php echo $result['date_creation_facture']; ?> 
                                                                                                                                                             
                             					   
                              
                              </td>
							   <td>	
                                  
                      <a target="new" href="../pages/TCPDF-master/examples/visite.php?dem=">
                      <i class="fa fa-file-pdf-o" style="font-size:25px;" ></i>
                              
                                 

                                                    
                           </div>              
                              </td>
							   <?php	} ?>
                           </tr>
                   </tbody>
                     </table>    
					 
                  </div>
				  <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>