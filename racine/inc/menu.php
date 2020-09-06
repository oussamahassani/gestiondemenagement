<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar -->
    <div class="side-menu-fixed">
     <div class="scrollbar side-menu-bg">
      <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
          <a href="index.php" >
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Home</span></div>
            <div class="pull-right"></div><div class="clearfix"></div>
          </a>
         
        </li>
        <!-- menu title -->
         <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Ecrans </li>
        <!-- menu item Elements-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#demandes">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Demandes</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="demandes" class="collapse" data-parent="#sidebarnav">
            <li> <a href="ajout_demande.php">Ajout</a> </li>
            <li> <a href="liste_demande.php">Liste</a> </li>
            <li> <a href="liste_relanceDemande.php">Relance Demande</a> </li>
          </ul>
        
        </li>
		
        <?php
if ($_SESSION['id_client_B2B'] == 247) 
{ ?>
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">Demandes API</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
            <ul id="elements" class="collapse" data-parent="#sidebarnav">
            <li><a href="liste_demande_api.php?id_source=5"> Devis Prox</a></li>
            <li><a href="liste_demande_api.php?id_source=6"> Fiche Déménagement</a></li>
            <li><a href="liste_demande_api.php?id_source=7"> Trouver mon déménageur</a></li>
            </ul>
        </li>
        <?php
}?>

        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parametres-menu">
            <div class="pull-left"><i class="ti-pencil-alt"></i><span class="right-nav-text">Devis</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Parametres-menu" class="collapse" data-parent="#sidebarnav">
            <li><a href="liste_devis.php"><i class="fa fa-circle-o"></i>Liste</a></li>
            <li><a href="liste_devis.php?confirm=1"><i class="fa fa-circle-o"></i>Liste confirmée</a></li>
            <li><a href="liste_devis.php?annule=1"><i class="fa fa-circle-o"></i>Liste Annulée</a></li>
            <li><a href="liste_relance.php"><i class="fa fa-circle-o"></i>Relance devis</a></li>
          </ul>
        </li>

        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Visite-menu">
            <div class="pull-left"><i class="ti-pencil-alt"></i><span class="right-nav-text">Visite</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Visite-menu" class="collapse" data-parent="#sidebarnav">
          <li><a href="liste_visite.php"><i class="fa fa-circle-o"></i>Liste</a></li>
          <li><a href="liste_visite_calendrier.php"><i class="fa fa-circle-o"></i>Calendrier</a></li>
         
        </ul>
        </li>

        <?php
if ($_SESSION['id_client_B2B'] == 247) 
{ ?>
<li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parametres-menu-p">
            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">Parametres</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Parametres-menu-p" class="collapse" data-parent="#sidebarnav">
          <li><a href="parametrage.php"><i class="fa fa-circle-o"></i>Services Fournisseur</a></li>
          <li><a href="../pages/tables/liste_source.php"><i class="fa fa-circle-o"></i> Sources</a></li>
          <li><a href="../pages/tables/liste_commerciaux.php"><i class="fa fa-circle-o"></i> Commerciaux</a></li>
          <li><a href="../pages/forms/tva.php"><i class="fa fa-circle-o"></i> TVA</a></li>

          </ul>
        </li>
		 <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#myModal">
            <div class="pull-left"><i class="ti-calendar "></i><span class="right-nav-text">Calculateur cubage</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="myModal" class="collapse" data-parent="#sidebarnav">
            <li><a href="liste_volume.php"><i class="fa fa-circle-o"></i>Liste article</a></li>
            <li><a href="ajout_volume.php"><i class="fa fa-circle-o"></i>Ajouter article</a></li>
			 <li><a href="liste_categorie.php"><i class="fa fa-circle-o"></i>Liste categorie</a></li>
			 <li><a href="ajout_categorie.php"><i class="fa fa-circle-o"></i>Ajouter categorie</a></li>
         </ul>
        </li>
		 <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parametres-en">
            <div class="pull-left"><i class="ti-notepad"></i><span class="right-nav-text">Encaissement</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="Parametres-en" class="collapse" data-parent="#sidebarnav">
            <li><a href="liste_encaissement.php"><i class="fa fa-circle-o"></i>Recherche</a></li>
            <li><a href="ajout_encaissement.php"><i class="fa fa-circle-o"></i>Ajout</a></li>
   
          </ul>
        </li>
        <?php
}?>

        <!-- menu item calendar-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">Statistiques</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="statistiques.php">Statistiques Devis</a> </li>
          </ul>
        </li>
         <!-- menu item clients-->
         <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#client">
            <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">Client</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="client" class="collapse" data-parent="#sidebarnav">
         
            <li> <a href="../racine/ajout_client.php">Ajout</a> </li>
          
            <li> <a href="../racine/liste_client.php">Liste</a> </li>
          </ul>
        </li>
        <!-- menu item Authentication-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
            <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">Utilisateur</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="authentication" class="collapse" data-parent="#sidebarnav">
          <?php
if ($_SESSION['id_type'] == 17) 
{ ?><li> <a href="../racine/ajout_utilisateur.php">Ajout</a> </li>  <?php
}?>
            <li> <a href="../racine/liste_utilisateur.php">Liste</a> </li>
          </ul>
        </li>
        <!-- menu item maps-->
      
        </ul>
      </li>
      
    </ul>
  </div>
  </div>