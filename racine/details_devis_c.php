<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
try {   
   if (isset($_SESSION['id']) && isset($_SESSION['nom_com'])) {
      require_once "inc/header.php";
      require_once "inc/menu.php";
      require_once '../db.php';

      $id_devis   = $_GET['dev'];

      $req_devis = "
         SELECT *, dev.* FROM `demande`
         INNER JOIN devis dev ON demande.id_dem = dev.id_demande 
         WHERE 1
            AND dev.id_devis = $id_devis
      ";
      $req_devis = mysqli_query($con, $req_devis);
      if (isset($id_devis) && !empty($id_devis)) {
         $query_user_logged = "
            SELECT id_utilisateur, nom, prenom, email, login, civilite
            FROM utilisateur
            WHERE
               id_utilisateur = " . $_SESSION['id'] . "
            ORDER BY id_utilisateur DESC
            LIMIT 1
         ";

         $que_user_logged              = mysqli_query($con, $query_user_logged);
   ?>
   <link rel='stylesheet' href='css/default.css?v=1.1' />
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css' />
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css' />
   <style type="text/css">
      .datepicker {
         width: 100% !important;
      }
      .table td, .table th {
         border-top: none;
      }
      input.border-none.form-control {
          border: none;
      }
   </style>
   <body>
      <div class="content-wrapper">
         <div class="page-title">
            <div class="row">
               <div class="col-sm-6">
                  <h4 class="mb-0">Détail du devis  N° <?php echo $id_devis; ?></h4>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                     <li class="breadcrumb-item"><a href="#" class="default-color">Acceuil</a></li>
                     <li class="breadcrumb-item"><a href="liste_demande.php" class="default-color">Détail devis</a></li>
                  </ol>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-12 mb-30">
               <div class="card card-statistics h-100">
                  <div class="card-body">
                     <?php 
                     if ($req_devis) {
                        $result = mysqli_fetch_array($req_devis);
                        $id = $result['id_demande'];
                        
                     ?>
                     <section>
                        <div class="box box-default">
                           <div class="box-header with-border">
                              <h5 class="card-title">Proposition Devis
                                 <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                 </div>
                              </h5>
                           </div>
                           <div class="box-body">
                              <div class="form-row">
                                 <table  width="100%">
                                    <tr>
                                       <td width="32%">
                                          <div class="form-inline"> 
                                             <label for="exampleInputEmail1">Devis établie le</label>
                                             <div class='input-group date display-years col-md-8'>
                                                <span class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                </span>
                                                <input name="date_etab_devis"  class="form-control" type='text' disabled value="<?php $date=$result['devis_etabli_le'];
                                                $a=substr($date,0,4);
                                                $m=substr($date,5,2);
                                                $j=substr($date,8,2);
                                                $date=$j."/".$m."/".$a;
                                                echo $date;
                                                ?>" id="datepicker">
                                             </div> 
                                          </div>
                                       </td>
                                       <td width="30%">
                                          <div class="form-inline"> 
                                             <label for="exampleInputEmail1">Valable au</label>
                                             <div class='input-group date display-years col-md-8'>
                                                <span class="input-group-addon">
                                                   <i class="fa fa-calendar"></i>
                                                </span>
                                                <input name="date_val"  class="form-control" type='text' disabled value="<?php $date=$result['devis_valable_au'];
                                                $a=substr($date,0,4);
                                                $m=substr($date,5,2);
                                                $j=substr($date,8,2);
                                                $date=$j."/".$m."/".$a;
                                                echo $date;
                                                ?>" id="datepicker">
                                             </div>
                                          </div>
                                       </td>
                                       <td width="20%">
                                          <div class="form-inline"> 
                                             <label for="exampleInputEmail1">Statut Devis</label>
                                             <div class="col-md-1">
                                                <?php
                                                $req_statut_devis = "
                                                   SELECT mpv.valeur
                                                   FROM masterParametreValeur mpv
                                                   INNER JOIN devis dev ON dev.id_statut = mpv.id
                                                   WHERE dev.id_devis = $id_devis
                                                ";
                                                $req_statut_devis = mysqli_query($con, $req_statut_devis);
                                                if ($req_statut_devis) {
                                                   $res_statut_devis=mysqli_fetch_array($req_statut_devis);
                                                ?>
                                                <input class="form-control" type='text' disabled value="<?php echo $res_statut_devis['valeur'];?>" />
                                                <?php
                                                } else {
                                                   echo mysqli_error($con);
                                                }
                                                ?>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                              <br>
                              <div class="form-row">
                                 <table  width="100%">
                                    <tr>
                                       <td width="25%">
                                          <div class="form-inline">  
                                             <label for="exampleInputEmail1">Prix TTC</label>
                                             <div class="col-md-8">
                                                <input name="prix_ttc" value="<?php echo $result['Prix_ttc'];?>" disabled class="form-control col-md-10">
                                             </div>
                                          </div>
                                       </td>
                                       <td width="25%">
                                          <div class="form-inline">  
                                             <label for="exampleInputEmail1">Prix HT</label>
                                             <div class="col-md-8">
                                                <input name="prix_ht" value="<?php echo $result['Prix_ht'];?>" disabled class="form-control col-md-10">
                                             </div>
                                          </div>
                                       </td>
                                       <td width="27%">
                                          <div class="form-inline">  
                                             <label for="exampleInputEmail1">Assurance</label>
                                             <div class="col-md-8">
                                                <input name="assurance" value="<?php echo $result['assurance'];?>" class="form-control col-md-10" disabled>
                                             </div>
                                          </div>
                                       </td>
                                       <td width="25%">
                                          <div class="form-inline"> 
                                             <label for="exampleInputEmail1">Montant payé</label>
                                             <div class="col-md-7">
                                                <input name="prix_paye"  value="<?php echo $result['montant_paye'];?>" class="form-control col-md-10" disabled>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                              </br>
                              <div class="form-row">
                                 <div class="form-group col-md-4"> 
                                    <label for="exampleInputEmail1">Remarques Pdf Devis</label>
                                    <textarea name="remarque" disabled class="form-control" rows="3"><?php echo $result['rqs'];?></textarea>
                                 </div>
                                 <div class="form-group col-md-4"> 
                                    <label for="exampleInputEmail1">Remarques Privées</label>
                                    <textarea name="remarque2" disabled class="form-control" rows="3"><?php echo $result['remarque']; ?></textarea>
                                 </div>
                                 <div class="form-group col-md-4"> 
                                    <label for="exampleInputEmail1">Instruction</label>
                                    <textarea name="instruction" disabled class="form-control" rows="3"><?php echo $result['instruction']; ?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </section>
                     <section>
                        <div class="box box-default">
                           <div class="box-header with-border">
                              <h5 class="card-title">Informations Générales
                                 <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                 </div>
                              </h5>
                           </div>
                           <div class="box-body">
                              <div class="form-row" id="infogenerales" style='margin-top: 13px !important;'>
                                 <div class="form-group col-md-3">       
                                    <label>Source</label>
                                    <?php
                                       $req_source = mysqli_query($con, "
                                          SELECT s.nom_source
                                          FROM source s
                                          INNER JOIN demande d ON s.id_source = d.id_source
                                          WHERE d.id_dem = $id
                                       ");
                                       $result_source=mysqli_fetch_array($req_source);
                                    ?>
                                    <input name="date_etab"  class="border-none form-control" disabled readonly type='text' value="<?php echo $result_source['nom_source'];?>
                                    "/>
                                 </div>              
                                 <div class="form-group col-md-3">    
                                    <label>Type de demande</label>
                                    <?php
                                       $req_type_demande = mysqli_query($con, "
                                          SELECT mpv.valeur
                                          FROM masterParametreValeur mpv
                                          INNER JOIN demande d ON mpv.id = d.id_type
                                          WHERE 
                                             d.id_dem = $id
                                             AND idMasterParametre = 2
                                       ");
                                       $res_type_demande = mysqli_fetch_array($req_type_demande);
                                    ?>
                                    <input name="date_etab"  class="border-none form-control" disabled readonly type='text' value="<?php echo $res_type_demande['valeur']; ?>
                                    "/>
                                 </div>
                                 <div class="form-group col-md-3"> 
                                    <label>Demande établie le</label>
                                    <div class='input-group date display-years'>
                                       <span class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                       </span>
                                       <input name="date_etab"  class="border-none form-control" disabled readonly type='text' value="<?php
                                             $date=$result['etablie_le'];
                                             $a=substr($date,0,4);
                                             $m=substr($date,5,2);
                                             $j=substr($date,8,2);
                                             $date=$j."/".$m."/".$a;
                                             echo $date;
                                          ?>
                                       "/>
                                    </div>
                                 </div>
                              </div>
                           <!--todo div -->
                           </div>
                        </div>
                     </section>
                     <section>
                        <div class="box box-default">
                           <div class="box-header with-border">
                              <h5 class="card-title">Informations Client
                                 <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                 </div>
                              </h5>
                           </div>
                           <div class="box-body">
                              <!-- /.box-header -->
                              <?php
                              $id_client=$result['id_client'];
                              $req=mysqli_query($con, "select * from client where id_client='$id_client' ");
                              if($result1=mysqli_fetch_array($req)) {    
                                 $req_type_1 = mysqli_query($con, "

                                    SELECT mpv.valeur, mpv.id, mpv.idMasterParametre 
                                    FROM `masterParametreValeur` mpv
                                    INNER JOIN client c ON mpv.id = c.type_client
                                    WHERE 
                                       1 
                                       AND mpv.idMasterParametre = 1
                                       AND c.id_client = " . $result1['id_client']
                                 );
                                 // echo $result1['id_client'] . " id : " . $id;
                              ?>
                                 <div class="form-row" id="infoClient">
                                    <input name="id_c" value="<?php echo $result1['id_client'];?>"  type="hidden" class="border-none form-control" >
                                    <input name="id_dem" value="<?php echo $id_demande; ?>"  type="hidden" class="form-control" >
                                    <div class="form-row" id="clientParticulier" style='margin-top: 13px !important;'>
                                       <div class="form-group col-md-1.5" style='width: 13%;'>
                                          <label>Type</label>
                                          <?php
                                             $res_type_1 = mysqli_fetch_array($req_type_1);
                                          ?>
                                          <input name="date_etab"  disabled class="border-none form-control" readonly type='text' value="<?php echo $res_type_1['valeur']; ?>
                                          "/>
                                       </div>
                                       <div class="form-group col-md-1">  
                                          <label>Civilité</label>
                                          <input  value="<?php
                                             echo $result1['civilite'];
                                             ?>" name="civilite"  type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <label for="exampleInputEmail1">Nom</label>
                                          <input  value="<?php
                                             echo $result1['nom'];
                                             ?>" name="nom"  type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <label for="exampleInputEmail1">Prénom</label>
                                          <input   value="<?php
                                             echo $result1['prenom'];
                                             ?>" name="prenom"  type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                       </div>
                                       <div class="form-group col-md-1.5" style='width: 13%;'>
                                          <label for="exampleInputEmail1">N° téléphone</label>
                                          <input   value="<?php
                                             echo $result1['tel'];
                                             ?>" name="telephone"  type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                       </div>
                                       <div class="form-group col-md-1.5" style='width: 13%;'>
                                          <label for="exampleInputEmail1">N° Mobile</label>
                                          <input   value="<?php
                                             echo $result1['telMobile'];
                                             ?>" name="telMobile"  type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                       </div>
                                       <div class="form-group col-md-2">
                                          <label for="exampleInputEmail1">Adresse Email</label>
                                          <input value="<?php
                                             echo $result1['email'];
                                             ?>" name="email"  type="email" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-row" id="clientProfessionnel" style="display:none">
                                 <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">Raison sociale</label>
                                    <input  value="<?php
                                       echo $result1['nom'];
                                       ?>" name="nomPro"  type="text" class="border-none form-control" id="exampleInputEmail1"  readonly disabled>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">N° téléphone</label>
                                    <input   value="<?php
                                       echo $result1['tel'];
                                       ?>" name="telephonePro"  type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1">Adresse Email</label>
                                    <input  value="<?php
                                       echo $result1['email'];
                                       ?>" name="emailPro"  type="email" class="border-none form-control" id="exampleInputEmail1"  readonly disabled>
                                 <!-- todo div -->
                                 </div>
                              <?php 
                              }
                              ?>
                           </div>
                        </div>
                     </section>
                     <section>
                        <div class="box box-default">
                           <div class="box-header with-border">
                              <h5 class="card-title">Informations Déménagement
                                 <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                 </div>
                              </h5>
                           </div>
                           <div class="box-body">
                              <div class="form-row" id='infoDemenagement' style='margin-top: -60px;'>
                                 <table>
                                    <tr>
                                       <td width="2%"></td>
                                       <td width="35%">
                                          <h5 class="card-title">Départ</h5>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Adresse</label>
                                             <input name="adresse_dep" type="text" class="border-none form-control" id="exampleInputEmail1" readonly
                                                value="<?php echo $result['adresse_dep']; ?>">
                                          </div>
                                          <div class="form-group">
                                             <table>
                                                <tr>
                                                   <td width="35%">
                                                      <label for="exampleInputEmail1">Code postale</label>
                                                   </td> 
                                                   <td>
                                                      <label for="exampleInputEmail1">Ville</label>
                                                   </td>
                                                </tr> 
                                                <tr>
                                                   <td>
                                                      <input name="cp_dep" type="text" class="border-none form-control" id="exampleInputEmail1" 
                                                         value="<?php echo $result['code_postale_dep']; ?>" readonly disabled>
                                                   </td>
                                                   <td> 
                                                      <input name="ville_dep" type="text" class="border-none form-control" id="exampleInputEmail1" 
                                                         value="<?php echo $result['ville_dep']; ?>" readonly disabled>
                                                   </td>
                                                </tr>
                                             </table>
                                          </div>
                                          <div class="form-group">
                                             <table width="100%">
                                                <tr> 
                                                   <td width="35%">
                                                      <label for="exampleInputEmail1">Étage</label>
                                                   </td> 
                                                   <td>
                                                      <label for="exampleInputEmail1">Portage</label>
                                                   </td>
                                                </tr>
                                                <tr> 
                                                   <td>
                                                      <input name="ville_dep" type="text" class="border-none form-control" id="exampleInputEmail1" 
                                                         value="<?php echo $result['habit_dep']; ?>" readonly disabled>
                                                   </td>
                                                   <td>  
                                                      <input name="portage_dep"  
                                                         value="<?php echo $result['portage_dep']; ?>" type="text" class="border-none form-control" id="exampleInputEmail1" readonly disabled>
                                                   </td>
                                                </tr>
                                             </table>
                                          </div>
                                          <!-- todo div a decommenter -->
                                          <!-- </div> -->
                                          <div class="form-group">
                                             <table>
                                                <tr>
                                                   <td colspan="1" width="45%">
                                                      <label>Date</label>
                                                   </td>
                                                   <td colspan="2"> 
                                                      <label>Période</label>
                                                   </td>
                                                </tr> 
                                                <tr>
                                                   <td colspan="1">
                                                      <div class='input-group date display-years'>
                                                         <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                         </span>
                                                         <input name="date_dep" disabled readonly type="text" class="border-none form-control pull-right" 
                                                            value="<?php
                                                            $date=$result['date_dep'];
                                                            $a=substr($date,0,4);
                                                            $m=substr($date,5,2);
                                                            $j=substr($date,8,2);
                                                            if ( $a == '00' ) {
                                                              $date='';
                                                            } else {
                                                              $date=$j."/".$m."/".$a;
                                                            }
                                                            echo $date;
                                                            ?>" >
                                                      </div>
                                                   </td>
                                                   <td colspan="2">
                                                      <div class="input-group">
                                                         <input name="periode_dep" readonly value="<?php
                                                         echo $result['periode_dep']; ?>"  type="text" class="border-none form-control pull-right" id="reservation" disabled>
                                                      </div>
                                                   </td>
                                                </tr>  
                                             </table>  
                                          </div>
                                          <div class="form-group">
                                             <label>
                                                <?php
                                                   if ($result['assenceur_dep']==1) {
                                                      echo "Assenceurs";
                                                   } else if ($result['stationnement_dep']==1) {
                                                      echo "Stationnement";
                                                   } else if ($result['cave_dep']==1) {
                                                      echo "Cave";
                                                   } else if ($result['monte_meuble_dep']==1) {
                                                      echo "Monte meuble";
                                                   } else if ($result['garde_meuble_dep']==1) {
                                                      echo "Garde meuble";
                                                   } else if ($result['passageFenetre_dep']==1) {
                                                      echo "Passage par fenêtre";
                                                   } else {
                                                      echo "Accès véhicule";
                                                   }
                                                ?>
                                                <!-- <input name="assen_arr_0" type="checkbox" class="flat-red" checked/> -->
                                             </label>
                                          </div> 
                                       </td>
                                       <td width="2%"></td>
                                       <td width="36%">
                                          <h5 class="card-title">Arrivée</h5>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Adresse</label>
                                             <input name="adresse_arr" type="text" class="form-control" id="exampleInputEmail1" readonly
                                                value="<?php echo $result['adresse_arr']; ?>">
                                          </div>
                                          <div class="form-group">
                                             <table>
                                                <tr> 
                                                   <td width="35%">
                                                      <label for="exampleInputEmail1">Code postale</label>
                                                   </td>
                                                   <td>
                                                      <label for="exampleInputEmail1">Ville</label>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <input name="cp_arr" type="text" class="border-none form-control" id="exampleInputEmail1" 
                                                         value="<?php echo $result['code_post_arr']; ?>" readonly disabled>
                                                   </td>
                                                   <td> 
                                                      <input name="ville_arr" type="text" class="border-none form-control" id="exampleInputEmail1"  
                                                         value="<?php echo $result['ville_arr']; ?>" readonly disabled>
                                                   </td>
                                                </tr>
                                             </table>
                                          </div>
                                          <div class="form-group">
                                             <table width="100%">
                                                <tr> 
                                                   <td width="35%">
                                                      <label for="exampleInputEmail1">Étage</label>
                                                   </td>
                                                   <td>
                                                      <label for="exampleInputEmail1">Portage</label>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>
                                                      <input name="ville_dep" type="text" class="border-none form-control" id="exampleInputEmail1" 
                                                         value="<?php echo $result['habit_arr']; ?>" readonly disabled>
                                                   </td>
                                                   <td> 
                                                      <input name="portage_arr" 
                                                         value="<?php echo $result['portage_arr']; ?>" type="text" class="border-none form-control" id="portage_arr" readonly disabled>
                                                   </td>
                                                </tr>
                                             </table>
                                          </div>
                                          <!-- todo div a decommenter -->
                                          <!-- </div> -->
                                          <div class="form-group"> 
                                             <table>
                                                <tr>
                                                   <td colspan="1" width="45%">
                                                      <label>Date</label>
                                                   </td>
                                                   <td colspan="2"> 
                                                      <label>Période</label>
                                                   </td>
                                                </tr> 
                                                <tr>
                                                   <td colspan="1">
                                                      <div class="input-group date display-years">
                                                         <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                         </span>
                                                         <?php
                                                            $date=$result['date_arr'];
                                                            $a=substr($date,0,4);
                                                            $m=substr($date,5,2);
                                                            $j=substr($date,8,2);
                                                            if ($a == '00') {
                                                              $date='';
                                                            } else {
                                                              $date=$j."/".$m."/".$a;
                                                            }
                                                         ?>
                                                         <input name="date_arr" disabled type="text" readonly class="border-none form-control pull-right" 
                                                            value="<?php echo $date;?>">
                                                      </div>
                                                   </td>
                                                   <td colspan="2">
                                                      <div class="input-group">
                                                         <input name="periode_arr" value="<?php echo $result['periode_arr']; ?>" type="text" class="border-none form-control pull-right" id="reservation2" readonly>
                                                      </div>
                                                   </td>
                                                </tr>  
                                             </table>
                                          </div>
                                          <div class="form-group">
                                             <label>
                                                <?php
                                                   if($result['assenseur_arr']==1) {
                                                      echo "Assenceurs";
                                                   } else if ($result['stationnement_arr']==1) {
                                                      echo "Stationnement";
                                                   } else if ($result['cave_arr']==1) {
                                                      echo "Cave";
                                                   } else if ($result['monte_meuble_arr']==1) {
                                                      echo "Monte meuble";
                                                   } else if ($result['garde_meuble_arr']==1) {
                                                      echo "Garde meuble";
                                                   } else if ($result['passageFenetre_arr']==1) {
                                                      echo "Passage par fenêtre";
                                                   } else {
                                                      echo "Accès véhicule";
                                                   }
                                                ?>
                                                <!-- <input name="assen_arr" type="checkbox" class="flat-red" checked/> -->
                                             </label>
                                          </div>
                                       </td>
                                       <td width="2%"></td>
                                       <td width="24%" style='padding-top: 55px;'>
                                          <h5 class="card-title">Déménagement</h5>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Volume</label>
                                             <input value="<?php echo $result['volume']; ?>" name="volume" type="number" disabled class="border-none form-control" id="exampleInputEmail1" readonly>
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Distance</label>
                                             <input value="<?php echo $result['distance']; ?>" name="distance" type="number"  disabled class="border-none form-control" id="exampleInputEmail1" readonly>
                                          </div>
                                          <div class="form-group">
                                             <label for="exampleInputEmail1">Prestation</label>  
                                             <?php
                                                $req_prestation = mysqli_query($con, "
                                                   SELECT mpv.valeur
                                                   FROM demande dem
                                                   INNER JOIN masterParametreValeur mpv ON dem.id_prestation = mpv.id
                                                   WHERE 
                                                      dem.id_dem = $id
                                                      AND idMasterParametre = 9
                                                ");
                                                $res_prestation = mysqli_fetch_array($req_prestation);
                                             ?>
                                             <input name="ville_dep" type="text" class="border-none form-control" id="exampleInputEmail1" 
                                                value="<?php echo $res_prestation['valeur']; ?>" readonly disabled >
                                          </div>
                                          <div class="form-group">
                                             <label>Remarques</label>
                                             <textarea name="remarque" class="border-none form-control" rows="4" disabled  readonly><?php echo $result['rqs']; ?></textarea>
                                          </div>
                                          <br><br><br>
                                       </td>
                                       <td width="2%"></td>
                                    </tr>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </section>
                     <?php 
                     } else {
                        echo mysqli_error($con);
                     }
                     ?>
                     <div class="form-row"></div>
                     <div class="box-footer">
                        <a href="list_ca_c.php">
                           <button type="reset" class="btn btn-primary pull-right">Retour &agrave; la liste des devis</button>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php      
      require_once "inc/footer.php";
      ?>
      </div>
   </body>
   <?php
      } else {
         header('location: index.php');
      }
   } else {
      header('location: ../login.php');
   }
} catch (exception $e) {
   echo $e->getMessage();
}
?>