<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <img src="../../dist/img/avatar5.png" class="img-circle" alt="User Image">

        </div>

        <div class="pull-left info">

          <p>

          <?php

          echo $_SESSION['nom_com'];

		  ?>

          </p>

          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>

      </div>

      <!-- search form -->

      <div style="padding:10px;" >

      

      </div>

      <form action="#" method="get" class="sidebar-form">

        <div class="input-group">

          <input type="text" name="q" class="form-control" placeholder="Search...">

              <span class="input-group-btn">

                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>

                </button>

              </span>

        </div>

      </form>

      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu">

        <li class="header">MAIN NAVIGATION</li>

        <li class="treeview">

          <a href="#">

             <i class="fa fa-files-o"></i> <span>Demandes</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="../../racine/ajout_demande.php"><i class="fa fa-circle-o"></i> Ajout</a></li>

            <li><a href="../../racine/liste_demande.php"><i class="fa fa-circle-o"></i> Liste</a></li>

          </ul>

        </li>

        <li class="treeview">

<a href="#">

   <i class="fa fa-files-o"></i> <span>Demandes API</span>

  <span class="pull-right-container">

    <i class="fa fa-angle-left pull-right"></i>

  </span>

</a>

<ul class="treeview-menu">
<li><a href="../../racine/liste_demande_api.php?id_source=5"><i class="fa fa-circle-o"></i> Devis Prox</a></li>
</ul>

</li>
		<li class="treeview">

          <a href="#">

             <i class="fa fa-edit"></i>  <span>Devis</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            

           <li><a href="../../racine/liste_devis.php"><i class="fa fa-circle-o"></i> Liste</a></li>

            <li><a href="../../racine/liste_devis.php?confirm=1"><i class="fa fa-circle-o"></i> Liste confirmée</a></li>

             <li><a href="../../racine/liste_devis.php?annule=1"><i class="fa fa-circle-o"></i> Liste Annulée</a></li>

          </ul>

        </li>

		<li class="treeview">

          <a href="#">

             <i class="fa fa-folder"></i> <span>Parametres</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">
          <li><a href="../../racine/parametrage.php"><i class="fa fa-circle-o"></i>Services Fournisseur</a></li>
          <li><a href="../tables/liste_source.php"><i class="fa fa-circle-o"></i> Sources</a></li>
          <li><a href="../tables/liste_commerciaux.php"><i class="fa fa-circle-o"></i> Commerciaux</a></li>

			 <li><a href="../forms/tva.php"><i class="fa fa-circle-o"></i> TVA</a></li>

          </ul>

        </li>

        

        <li class="treeview">

          <a href="#">

             <i class="fa fa-book"></i> <span>Compte</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="../forms/info.php"><i class="fa fa-circle-o"></i> Infos</a></li>

            <li><a href="../forms/compte.php"><i class="fa fa-circle-o"></i> Sécurite</a></li>

			 <li><a href=""><i class="fa fa-circle-o"></i> Photo</a></li>

          </ul>

        </li>

         <li class="treeview">

          <a href="#">

             <i class="fa fa-book"></i> <span>Visite</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="../tables/liste_visite.php"><i class="fa fa-circle-o"></i> Liste</a></li>

            <li><a href="../forms/upload_visite.php"><i class="fa fa-circle-o"></i> Upload</a></li>

		

          </ul>

        </li>
        <li class="treeview">

<a href="#">

   <i class="fa fa-book"></i> <span>Client</span>

  <span class="pull-right-container">

    <i class="fa fa-angle-left pull-right"></i>

  </span>

</a>

<ul class="treeview-menu">

  <li><a href="../../racine/ajout_client.php"><i class="fa fa-circle-o"></i> Ajout</a></li>

  <li><a href="../../racine/liste_client.php"><i class="fa fa-circle-o"></i> Liste</a></li>



</ul>

</li>


         <li class="treeview">

          <a href="#">

             <i class="fa fa-book"></i> <span>Admin</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

            <li><a href="../forms/admin.php"><i class="fa fa-circle-o"></i> Ajout</a></li>

            <li><a href="../tables/liste_admin.php"><i class="fa fa-circle-o"></i> Liste</a></li>

			

          </ul>

        </li>

        

        

		<li class="treeview">

          <a href="../../deconnexion.php">

             <i class="fa fa-share"></i> <span>Déconnexion</span>

            

          </a>

          

        </li>

       

      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>