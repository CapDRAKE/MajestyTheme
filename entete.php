<?php require_once('theme/'. $_Serveur_['General']['theme'].'/assets/php/alerts.php'); ?>
<!-- Preloader -->
    <div class="preloader"><div class="icon"></div></div>

    <!-- Main Header -->
    <header class="main-header">
        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container clearfix">

                <div class="top-left clearfix">
                    <ul class="info-list">
                        <li>IP du serveur : <?= $_Serveur_['General']['ipTexte']; ?></li>
                    </ul>
                </div>

                <div class="top-right clearfix">
					<ul class="info-list"><li><i class="fas fa-signal"></i> Statut du serveur :
                            <?php if ($_Serveur_['General']['statut'] == 0 || $servEnLigne == false) : ?>
                            <span class="badge badge-pill badge-danger">Hors-Ligne</span>
                            <?php elseif ($_Serveur_['General']['statut'] == 1 && $servEnLigne == true) : ?>
                            <span class="badge badge-pill badge-success">En Ligne</span>
                            En ligne : <strong><?= $playeronline ?></strong>/<?= $maxPlayers; ?>
                            <?php else : ?>
                            <span class="badge badge-pill badge-warning">En Maintenance</span>
                            <?php endif; ?>
						</li>
					</ul>
                </div>
            </div>
        </div>

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="inner-container">
                <div class="auto-container clearfix">
                    <!--Logo-->
                    <div class="logo-outer">
                        <div class="logo"><a href="index.php"><img src="https://majestycraft.com/theme/upload/panel/sans-fond.png" style="width: 130px; height: 130px;" alt="" title="Gamon - Digital Gaming and Esports HTML Template"></a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix pull-left">
                                    <li><a href="https://majestycraft.com/index.php">Accueil</a>
                                    </li>
									<li class="dropdown"><a>Serveur</a>
                                        <ul>
											<li><a href="https://majestycraft.com/?&page=voter">Voter</a></li>
											<li><a href="https://majestycraft.com/Ressources">Ressources</a></li>
											<li><a href="https://majestycraft.com/?page=staff">Staff</a></li>
											<li><a href="https://discord.gg/7HAU4wWAkD">Discord</a></li>
											<li class="dropdown"><a href="https://majestycraft.com/?page=MineStrator">Minestrator</a>
                                                <ul>
                                                    <li><a href="https://majestycraft.com/?page=MineStrator">Présentation</a></li>
                                                    <li><a href="https://minestrator.com/?partner=eus561rkso">Site internet</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="https://majestycraft.com/?page=galerie">Galerie</a></li>
											<li><a href="https://majestycraft.com/?page=CGV">CGV</a></li>
											<li><a href="https://majestycraft.com/?page=R%C3%A8glement">Règlement</a></li>	
											<li><a href="https://majestycraft.com/?page=partenaires">Nos partenaires</a></li>
											<li><a href="https://majestycraft.instatus.com/">Statut serveurs</a></li>
											<li class="dropdown"><a>LiveMap</a>
                                                <ul>
                                                    <li><a href="https://livemap.minestrator.com/s/17a9a3b9-5653-4d87-8831-e4da820bb5cb/#spawnv1:128:0:-128:500:0:0:0:0:perspective">Lobby</a></li>
                                                    <li><a href="#">Créatif</a></li>
													<li><a href="#">SkyBlock</a></li>
													<li><a href="https://livemap.minestrator.com/s/19e473ed-2d0f-4c9c-8197-1faad9c2a9a5/#world:-147:0:280:500:0:0:0:0:perspective">PVP Box</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
									<li class="dropdown"><a>Support/forum</a>
                                        <ul>
                                            <li><a href="https://majestycraft.com/?page=support">Support</a></li>
                                            <li><a href="https://majestycraft.com/?page=forum">Forum</a></li>
                                        </ul>
                                    </li>
                                </ul>

                                <ul class="navigation pull-right clearfix">
                                    <li class="dropdown"><a href="https://majestycraft.com/?&page=boutique">Boutique</a>
										<ul>
											<li><a href="https://majestycraft.com/?&page=boutique">Boutique</a></li>
											<li><a href="https://majestycraft.com/Grades">Avantages des grades</a></li>
										</ul></li>
                                    <li><a href="https://majestycraft.com/?page=Launcher">Launcher</a>
                                    </li>									
									
                    <?php if ($banned == false) { ?>
					<?php if (Permission::getInstance()->verifPerm("connect")) { $Img = new ImgProfil($_Joueur_['id']); ?>
                    <li class="dropdown">
                        <a id="profil-<?= $_Joueur_['pseudo']; ?>" href="#" id="dropdown-tools" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" src="<?= $_ImgProfil_->getUrlHeadByPseudo($_Joueur_['pseudo'], 18); ?>" style="height:18px;width:18px;">&nbsp;<?= $_Joueur_['pseudo']; ?>
                        </a>
						<ul>


                            <?php if (Permission::getInstance()->verifPerm('PermsPanel', 'access')) { ?>
                            <!-- Administration -->
                            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Administration</a></li>
                            <?php }; ?>
                            <li><a href="?page=profil&profil=<?= $_Joueur_['pseudo']; ?>"><i class="fas fa-user"></i> Mon profil</a></li>

                            <?php if(Permission::getInstance()->verifPerm('PermsForum','moderation','seeSignalement')){$req_report=$bddConnection->query('SELECT id FROM cmw_forum_report WHERE vu = 0');$signalement=$req_report->rowCount(); ?>
                            <!-- Signalements -->
                            <li><a href="?page=signalement"><i class="fa fa-bell"></i> Signalement <span class="badge badge-pill badge-warning" id="signalement"><?= $signalement ?></span></a></li>
                            <?php }; ?>
                            <li><a href="?page=alert"><i class="fa fa-bell"></i> Alertes : <span class="badge badge-pill badge-primary" id="alerts"><?= $alerte; ?></span></a></li>
                            <li><a href="?page=token"><i class="fas fa-coins"></i> Mon solde : <?php if (isset($_Joueur_['tokens'])) echo $_Joueur_['tokens']; ?> </a></li>
                            <li><a class="text-danger" href="?action=deco"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>

								</ul>
                    </li>

                    <?php }else { ?>
					<li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-tools" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" src="https://minotar.net/avatar/steve/18.png"> Compte
                        </a>
						<ul>
                            <li><a href="#" data-toggle="modal" data-target="#InscriptionSlide"><i class="fa fa-user-plus"></i> Inscription</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#ConnectionSlide"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
						</ul>
                    </li>
				<?php } }; ?>
						
                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="index.php" title=""><img src="https://majestycraft.com/theme/upload/panel/logo-majestycraft-seul.png" style="width: 70px; height: 70px;" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-close"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->

        <!-- Mise en titre -->

            <?php if (((!isset($_GET['page']) && !isset($_GET['redirection'])) || $_GET['page'] == "accueil") && ($banned == false)) : ?>
            <!-- Title & Slogan -->
    <section class="banner-section" >
        <div class="banner-carousel owl-theme owl-carousel">
            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(https://majestycraft.com/theme/upload/panel/hubsansretouche.png)"></div>

                <div class="auto-container">
                    <div class="content-box">
                        <h2>4 modes de <br>jeu<br>inédits</h2>
                        <div class="btn-box"><a href="https://majestycraft.com/?page=galerie" class="theme-btn btn-style-one"><span class="btn-title">Découvrir</span></a></div>
                    </div>  
                </div>
            </div>

            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(https://majestycraft.com/theme/upload/panel/savoir-faire.jpg)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Un savoir-<br>faire <br> unique</h2>
                        <div class="btn-box"><a href="https://majestycraft.com/?page=galerie" class="theme-btn btn-style-one"><span class="btn-title">Découvrir</span></a></div>
                    </div>  
                </div>
            </div>
			
			<!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(https://majestycraft.com/theme/upload/panel/build.jpg)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Des<br>builds<br>d'exception</h2>
                        <div class="btn-box"><a href="https://majestycraft.com/?page=galerie" class="theme-btn btn-style-one"><span class="btn-title">Découvrir</span></a></div>
                    </div>  
                </div>
            </div>
        </div>
	</section>
	<?php elseif (isset($_GET['page']) && $_GET['page'] == "Launcher") : ?>
<!-- Banner Section -->
    <section class="banner-section style-two">
        <div class="banner-carousel owl-theme owl-carousel">
            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(https://majestycraft.com/theme/upload/panel/survie1.png)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Un launcher <br> incroyable</h2>
						<div class="text">Notre launcher propose une interface hors du commun, intuitive, avec de nombreuses possibilités de personnalisation.</div>
                        <div class="btn-box"><a href="https://majestycraft.com/Launcher#banner1" class="theme-btn btn-style-one"><span class="btn-title">Voir plus...</span></a></div>
                    </div>  
                </div>
            </div>

            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(https://majestycraft.com/theme/upload/panel/cathe╠üdrale3.png)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Optifine  <br> et forge</h2>
						<div class="text">Notre launcher propose par défaut le mod optifine permettant d'optimiser votre jeu et d'ajouter des shaders !</div>
                        <div class="btn-box"><a href="https://majestycraft.com/Launcher#banner2" class="theme-btn btn-style-one"><span class="btn-title">Voir plus...</span></a></div>
                    </div>  
                </div>
            </div>

            <!-- Slide Item -->
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(https://majestycraft.com/theme/upload/panel/survie5.png)"></div>
                <div class="auto-container">
                    <div class="content-box">
                        <h2>Plus de 3000 <br> Téléchargements</h2>
						<div class="text">Notre launcher possède à l'heure actuelle plus de 3000 téléchargements à son actif !</div>
                        <div class="btn-box"><a href="https://majestycraft.com/Launcher#banner3" class="theme-btn btn-style-one"><span class="btn-title">Voir plus...</span></a></div>
                    </div>  
                </div>
            </div>
            
        </div>
    </section>
            <?php else : ?>
			
<section class="page-banner" style="background-image:url(https://majestycraft.com/theme/upload/panel/heading.jpg);">
            <!-- L'utilisateur est banni -->
            <?php if (isset($banned) && $banned == true) : ?>
                        <div class="inner-container clearfix"><h4 class="text-white text-center"><?= $data['titre']; ?></h4></div></section>
            <!-- L'utilisateur est redirigé (maintenance) -->
            <?php elseif (isset($_GET['redirection'])) : ?>
                        <div class="inner-container clearfix"><h4 class="text-white text-center"><?= htmlentities($_GET['redirection']) ?></h4></div></section>

    <!--End Banner Section -->
            <!-- L'utilisateur est sur un profil -->

            <?php elseif (isset($_GET['page']) && isset($_GET['profil']) && $_GET['page'] == 'profil') : ?>
    
			<div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li>Profil</li>
					</ul>
					<h1><?= htmlentities($_GET['page']) ?> de <?= htmlentities($_GET['profil']) ?></h1>
				</div>
        	</div>
			</section>
            <!-- L'utilisateur est sur la page de signalements -->
            <?php elseif (isset($_GET['page']) && isset($_GET['page']) && $_GET['page'] == 'signalement') : ?>
			<div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li>Signalements</li>
					</ul>
					<h1>Signalements</h1>
				</div>
        	</div>
			</section>
            <!-- Forum -->
            <!-- L'utilisateur édite un forum -->
            <?php elseif (isset($_GET['page']) && $_GET['page'] == 'editForum') : ?>
            <h4 class="text-white text-center">Edition d'<?= ($_GET['objet'] == 1) ? 'un topic' : 'une réponse'; ?> </h4></section>
            <!-- L'utilisateur est dans une catégorie de forum -->
            <?php elseif (isset($_GET['page']) && $_GET['page'] == "forum_categorie") : ?>
		    <div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li><a href="https://majestycraft.com/forum">Forum</a></li>
						<?php if (isset($id_sous_forum)) : ?>
                        	<li> <a href="index.php?page=forum_categorie&id=<?= $id ?>"> <?= $categoried['nom'] ?> </a></li>
                    	<?php else : ?>
                        	<li><?= $categoried['nom'] ?> </li>
                    	<?php endif; ?>

                    	<?php if (isset($id_sous_forum)) : ?>
                        	<li><?= $sousforumd['nom'] ?></li>;
                    	<?php endif; ?>
						<li><?= $_Forum_->infosCategorie($_GET['id'])['nom'] ?> </li>
					</ul>
					<h1><?= $_Forum_->infosCategorie($_GET['id'])['nom'] ?> </h1>
				</div>
        	</div>
			</section>
		<!-- L'utilisateur est dans une catégorie de forum -->
            <?php elseif (isset($_GET['page']) && $_GET['page'] == "sous_forum_categorie") : ?>
		    <div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li><a href="https://majestycraft.com/forum">Forum</a></li>

						<li><?= $_Forum_->infosCategorie($_GET['id'])['nom'] ?> </li>
					</ul>
					<h1><?= $_Forum_->infosCategorie($_GET['id'])['nom'] ?> </h1>
				</div>
        	</div>
			</section>
            <!-- L'utilisateur lit un topic -->
            <?php elseif (isset($_GET['page']) && $_GET['page'] == "post") : ?>
			<div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li><a href="https://majestycraft.com/forum">Forum</a></li>
						<?php if (isset($id_sous_forum)) : ?>
                        	<li> <a href="index.php?page=forum_categorie&id=<?= $id ?>"> <?= $categoried['nom'] ?> </a></li>
                    	<?php else : ?>
                        	<li><?= $categoried['nom'] ?> </li>
                    	<?php endif; ?>

                    	<?php if (isset($id_sous_forum)) : ?>
                        	<li><?= $sousforumd['nom'] ?></li>;
                    	<?php endif; ?>
						<li>Post</li>
					</ul>
					<h1>Post: <?= $_Forum_->getTopic($_GET['id'])['nom'] ?> </h1>
				</div>
        	</div>
			</section>
            <!-- L'utilisateur accède aux notifications -->
            <?php elseif (isset($_GET['page']) && $_GET['page'] == "alert") : ?>
			<div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li>Notifications</li>
					</ul>
					<h1>Notifications</h1>
				</div>
        	</div>
			</section>
            <!-- L'utilisateur accède aux jetons -->
            <?php elseif (isset($_GET['page']) && $_GET['page'] == "token") : ?>
            			<div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li>Jetons</li>
					</ul>
					<h1>Mes jetons</h1>
				</div>
        	</div>
			</section>
            <!-- les autres pages -->
            <?php elseif (isset($_GET['page'])) : ?>
			<div class="auto-container">
				<div class="inner-container clearfix">
					<ul class="bread-crumb clearfix">
						<li><a href="index.php">Accueil</a></li>
						<li><?= htmlentities($_GET['page']) ?></li>
					</ul>
					<h1><?= htmlentities($_GET['page']) ?></h1>
				</div>
        	</div>
	</section>


            <?php endif; ?>
            <?php endif; ?>

