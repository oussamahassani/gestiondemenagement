<?php require_once"inc/header.php"; ?>


<!--=================================
 header End-->

<!--=================================
 Main content -->
 
 
<!-- Left Sidebar End-->
<?php require_once"inc/menu.php"; ?>


<!--=================================
 Main content -->

 <!--=================================
wrapper -->

<div class="content-wrapper">
	<div class="row"> 
       <div class="col-xl-12 mb-30">     
            <div class="card card-statistics h-100"> 
              <div class="card-body">
                <div class="table-responsive">
	                <table class="mb-0 table table-hover">
		                <thead>
		                  <tr>
		                    <th style="vertical-align: middle;border-top:none;">Source</th>
		                    <th style="vertical-align: middle;border-top:none;">Service</th>
		                    <th style="vertical-align: middle;border-top:none;" >Type</th>	
		                    <th style="vertical-align: middle;border-top:none;" >Nb Max Envoi Lead</th>
		                    
		                    <th style="vertical-align: top;border-top:none;" >        
		                          <nobr>
		                          <button type="button" id="openModalPassenger" class="button button-border green x-small pull-right"  >
		                           <i class="fa fa-plus-circle" style="font-size:20px"></i>
		                          </button>
		                          </nobr>   
		                     </th> 				
		                  </tr>
		                </thead>
		                
				                <tbody> 
				                  <tr>
				                   <td >Civility</td>
				                    <td>name</td>
				                    <td>firstName</td>
				                    <td>birthdayDate</td>
				                    <td>telephone</td>
				                    <td style="text-align:right;">
				                        <a style="cursor: hand;" href="" id="1" class="editPassager" class="btn btn-outline-warning btn-lg">
				                        	<i  class="fa fa-edit"  style="font-size:45px;color:orange"></i>
				                        </a>
				                        <br><br>
				                        <a style="cursor: hand;" href="##"  id="2" class="deletePassager" class="btn btn-outline-warning btn-lg" >
				                        	<i class="fa fa-trash-o" style="font-size:40px;color:brown; margin-right: 10px;"></i>
				                        </a>
				                    </td>
				                  </tr>  
				                </tbody>
			                
	              	</table>
              	</div>
              </div>
             </div>   
        </div>
	</div>
</div>   
<!---Modal confirm ---> 
<button id="confirmMsg" data-target="##confirm" data-toggle="modal" style="display:none;"></button>	                          
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="max-width:400px;">
	    <div class="modal-content">
	       <div class="modal-header">
		        <div class="modal-title"><div class="mb-30"></div>
		           Supprimer
		        </div>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		        </button>
	        </div>
	        <div align="right" style="padding-top:10px;padding-bottom:10px;padding-right:20px">
	        	<button type="button" id="deleteItemTmp" class="btn btn-primary" data-toggle="modal" data-dismiss="modal">Oui</button>
	        	<button type="button" class="btn btn-danger" data-toggle="modal" data-dismiss="modal">Non</button>
	        </div>
	    </div>
    </div>
</div><form name="submitFrm" id="submitFrm" action="passagers.cfm" method="post" >
	<input type="text"  id="idDevis"  name="idDevis" value="#idDevis#">
</form>
<form name="frmDeletePassager" action="passagers.cfm"  method="POST"  id="frmDeletePassager">
    <input type="Hidden" id="cmdSupprimer"    name="cmdSupprimer" value="">
    <input type="Hidden" id="idPassager" name="idPassager" value="">
     <input type="Hidden" id="idDevis" name="idDevis" value="#idDevis#">
</form>
<!---Modal pax --->
<div id="modalGetPax" data-iziModal-fullscreen="true"  data-iziModal-title="Ajout/Modification passagers"></div>
  <!--- Modal updOK --->
<cfset msg 			= translate.message.updOk>
<cfset showBtnOk 	= 1>
 <!--- Modal delOK --->
<cfset msgDel 			=translate.message.updDel>
<cfset showBtnOkDel 	= 1>
</cfoutput>
<cfif del EQ 1>
	<input type="hidden" id="deleteItem" value="1">
</cfif>
  <!--- Modal updOK 
<cfset msg 			= translate.message.updOk>
<cfset showBtnOk 	= 1>
 
<cfset msgDel 			=translate.message.updDel>
<cfset showBtnOkDel 	= 1>
</cfoutput>
<cfif del EQ 1>
	<input type="hidden" id="deleteItem" value="1">
</cfif>
<cfinclude template="inc/footer.php">--->
    
 <!--=================================
 wrapper -->
      

<!--=================================
 jquery -->

<!-- jquery -->
<script src="js/jquery-3.3.1.min.js"></script>

<!-- plugins-jquery -->
<script src="js/plugins-jquery-fr.js"></script>

<!-- plugin_path -->
<script>var plugin_path = 'js/';</script>

<!-- chart -->
<script src="js/chart-init-fr.js"></script>

<!-- calendar -->
<script src="js/calendar.init.js"></script>

<!-- charts sparkline -->
<script src="js/sparkline.init.js"></script>

<!-- charts morris -->
<script src="js/morris.init.js"></script>

<!-- datepicker -->
<script src="js/datepicker.js"></script>

<!-- sweetalert2 -->
<script src="js/sweetalert2.js"></script>

<!-- toastr -->
<script src="js/toastr.js"></script>

<!-- validation -->
<script src="js/validation.js"></script>

<!-- lobilist -->
<script src="js/lobilist.js"></script>
 
<!-- custom -->
<script src="js/custom.js"></script>
<script src="js/iziModal.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	
	// Izimodal pax
	var $iziBloc1 = $("#modalGetPax").iziModal({ 
		headerColor: '#282a39'
		, background : '#FFF'
		, width: 800 
	});
	$(document).on('click', '[id="openModalPassenger"]', function (event) {
		$iziBloc1.iziModal('startLoading');
		$iziBloc1.iziModal('open', { zindex: 99999 });
		$.get('ajax/popUpPassagers.cfm?newPassenger=1&idDevis=' + $("#idDevis").val(), function(data) {
			$("#modalGetPax .iziModal-content").html(data);
			$iziBloc1.iziModal('stopLoading');
			
		});
	});
    //Modifier un passager
	$(".editPassager").click(function(){
	  	var idPassager= $(this).attr("id");	
		var idDevis= $(this).attr("idDevis");	
        $iziBloc1.iziModal('startLoading');
        $iziBloc1.iziModal('open', { zindex: 99999 });
		$.ajax({ 
			type: "POST", 
			url: "ajax/popUpPassagers.cfm",
			data: {
					id:idPassager,
					idDevis:idDevis
				  },		
			cache:false,
			dataType: "html",
			success : function(data){
				$("#modalGetPax .iziModal-content").html(data);
				$iziBloc1.iziModal('stopLoading');
			}
		});	
	});
	//Supprimer un passager
	/*$(".deletePassager").click(function(){
		var idPassager= $(this).attr("id");	
		 $("#cmdSupprimer").val(1);
		 $("#idPassager").val(idPassager);
		 if (confirm("Vous voulez supprimer ce passager"))
		 {
			  $("#frmDeletePassager").submit();
		 }
	});*/
	
	$(".deletePassager").click(function(){
		var idPassager= $(this).attr("id");	
		 $("#cmdSupprimer").val(1);
		 $("#idPassager").val(idPassager);
		 $("#confirmMsg").trigger('click');
		 /*if (confirm("Vous voulez supprimer ce passager"))
		 {
			  $("#frmDeletePassager").submit();
		 }*/
	});
	
  	$("#deleteItemTmp").click(function(){
  		$("#frmDeletePassager").submit();
  	});
	
	// Enregistrer 
	$(document).on('click', '[id="save"]', function () {
		$("#frmPax").validate({
			errorPlacement: function(error, element) {
			  // error.insertAfter(element);
			   error.remove();
		   } 
	    });
		if ($("#frmPax").valid()){
				
			$iziBloc1.iziModal('startLoading');
			$.ajax({ 
				type: "POST", 
				url: "ajax/popUpPassagers.cfm",
				data	: {  id                 : $("#idPassenger").val()
				            ,inputCivility		: $("#inputCivility").val()
							, firstName 	    : $("#firstName").val()
							, name 		        : $("#name").val()
							, birthdayDate 	    : $("#birthdayDate").val()
							, telephone 		: $("#telephone").val()
							, cmdValider 	    : 1
							, quoteID 		: $("#idDevis").val()
							, idDevis 		: $("#idDevis").val()
							},
				cache:false,
				//async:false,
				dataType: "html",
				success : function(data){
					$("#modalGetPax .iziModal-content").html(data);
					$iziBloc1.iziModal('stopLoading');
					$iziBloc1.iziModal('close');
				}
			});	
		};
	});
	
	$("#msgBtnOK").on("click", function(){
		$("#submitFrm").submit();
	});	
	$("#msgBtnOKDel").on("click", function(){
		$("#submitFrm").submit();
	});	
	
	if($("#deleteItem").length){
		$("#showBtnOkDel").trigger('click');
	}
	
	
});

</script>
</body>
</html>