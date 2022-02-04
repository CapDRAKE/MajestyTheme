<section id="Shop" class="welcome-section">
	<br/><br/>
    <div class="container">
		        <div class="row">
			<div class="col-sm-12"></div>
				<div class="auto-container">
					<div class="sec-title centered">
                        <h2 class="text-white mb-0">Informations</h2>
                    </div>
					<div class="card-body player-shop">
					<p>Tous les achats de la boutiques sont facultatifs et ne sont pas obligatoires afin de bénéficier de l'expérience de jeu du serveur. Cela signifie que tout le contenu présent dans la boutique peut être obtenu sans avoir besoin de payer. Effectuer un achat vous permet d'accéder à du contenu tout en soutenant le financement du serveur. La monnaie virtuelle utilisée sur la boutique est le "MajestyCoins", vous pouvez obtenir des  ici: <a class="btn-style-four" href="?&page=token"> Achetez des MajestyCoins</a></p>
					<p>Les payements par Paypal ou Carte bancaire peuvent prendre jusqu'à 20 minutes avant d'être validée et que vous receviez vos MajestyCoins. Les payements via Dedipass peuvent prendre jusqu'à 10 minutes. En dehors de ces délais, nous vous invitons à prendre contact avec nous via <b><a href="https://discord.gg/bj7mUb9">Discord</a></b> ou sur notre <b><a href="?&page=support">support</a></b>.</p>
					<p>Les articles sur notre boutique sont des biens immatériels et sont soumis à nos conditions générales de ventes validées avant chaque achats. Plus d'informations disponibles via le lien ci-après: <b><a href="https://majestycraft.com/?page=CGV">Conditions Générales de Vente</a></b>.</p>
					<p>Vos informations fournies lors de la vérification, qu'elles soient privées ou publiques, ne seront pas : vendues, échangées, transférées ou données à toute autre société ou personne(s) sans votre consentement.</p>
					<p>Pour voir les avantages de nos grades VIP, rendez vous ici => <a class="btn-style-four" href="?&page=Grades"> Voir les avantages</a></p>
		</div>
		</div>
		</div>
        <div class="row">
            <div class="col-lg-6">
                <!-- Compte -->
                <div class="sidebar-widget search-box">
                    <div class="card-header bg-primary">
                        <h4 class="text-white mb-0">Mes infos</h4>
                    </div>
                    <div class="card-body player-shop">
                        <?php if (Permission::getInstance()->verifPerm("connect")) : ?>
                        <!-- Affichage nom, panier, crédits -->
                        <h6>Bonjour,<?= $_Joueur_['pseudo']; ?></h6>
                        <p>Crédits : <?= $_Joueur_['tokens']; ?> <i class="fas fa-coins"></i></p>
                        <a href="<?= $_Panier_->compterArticle() > 0 ? '?page=panier' : '#' ?>" class="btn btn-primary btn-block btn-sm rounded">Panier : <?= $_Panier_->compterArticle() . ($_Panier_->compterArticle() > 1 ? ' articles' : ' article') ?></a>
                        <?php else : ?>
                        <!-- Pas connecté -->
                        <h6>Bonjour, Visiteur</h6>
                        <small>Connectez-vous pour accéder à la boutique</small>
                        <a data-toggle="modal" data-target="#ConnectionSlide" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span>Connexion</a>
                        <?php endif; ?>
                    </div>
				</div>
				</div>
			            <div class="col-lg-6">
                <!-- Catégories -->
                <div class="sidebar-widget search-box">
                    <div class="card-header bg-primary">
                        <h4 class="text-white mb-0">Catégories :</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <?php if (isset($categories)) : ?>
                            <!-- Affichage noms catégories -->
                            <?php for ($j = 0; $j < count($categories); $j++) : ?>
                            <li class="nav-item<?= ($j == 0) ? ' active' : '' ?>">
                                <a href="#categorie-<?= $j ?>" class="nav-link<?= ($j == 0) ? ' active' : '' ?>" data-toggle="tab">
                                    <i class="fas fa-angle-double-right"></i> <?= $categories[$j]['titre']; ?>
                                </a>
                            </li>
                            <?php endfor; ?>
                            <?php else : ?>
                            <li class="nav-item active">
                                <a href="javascript:void(0)" class="nav-link">
                                    <i class="fas fa-exclamation-triangle"></i> Aucune catégorie
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
			</div>
		</div>
		<br/>
            <!-- Offres -->
		                <div class="offres tab-content">

                <?php if (isset($categories)) : ?>

                    <!-- Affichage de la catégorie -->
                    <?php for ($j = 0; $j < count($categories); $j++) : ?>
                    <div id="categorie-<?= $j ?>" class="tab-pane fade <?= ($j == 0) ? ' in active show' : ''; ?>" aria-expanded="<?= ($j == 0) ? 'true' : 'false' ?>">

						<div class="row">
                            <!-- Affichage des offres -->
                            <?php foreach ($categories as $key => $value) {
                                        $categories[$key]['offres'] = 0;
                                    }
                                    if(isset($offresTableau) && !empty($offresTableau)) : for ($i = 1; $i <= count($offresTableau); $i++) :
                                        if ($offresTableau[$i]['categorie'] == $categories[$j]['id']) : 
                                            $categories[$j]['showNumber'] = ($categories[$j]['showNumber'] == 0) ? 1 : $categories[$j]['showNumber']; ?>
                            <div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" style= "margin:auto;" data-wow-delay="0mss">
                                <div class="inner-box hvr-bob">
									<div class="lower-content">
                                    <h3><a>
                                        <?= (($offresTableau[$i]['nbre_vente'] == 0) ? "<s>" . $offresTableau[$i]['nom'] . "</s>" : $offresTableau[$i]['nom']); ?>
                                        <br /><small>
                                            <?php
                                                        if ($offresTableau[$i]['nbre_vente'] == 0) {
                                                            echo "vide";
                                                        } else {
                                                            echo ($offresTableau[$i]['nbre_vente'] == -1) ? 'Stock Non limité' : 'Stock : ' . $offresTableau[$i]['nbre_vente'];
                                                        }
                                                        ?>
                                        </small>
										</a></h3>
                                    <div class="card-body">
                                        <?= htmlspecialchars_decode($offresTableau[$i]['description']) ?>
                                    </div>
                                    <div class="card-footer text-center">
                                        <?php if (Permission::getInstance()->verifPerm("connect")) : ?>
                                        <?php if (isset($offresTableau[$i]['buy'])) { ?>
                                        <a href="#" class="btn btn-primary disabled" disabled>Vous devez d'abord acheter: <?php foreach($offresTableau[$i]['buy'] as $value) { echo $offresByGet[$value]; } ?></a>
                                        <?php } else if (isset($offresTableau[$i]['maxbuy'])) { ?>
                                        <a href="#" class="btn btn-primary disabled" disabled>Vous avez dépassé le nombre d'achat maximum de cette offre</a>
                                        <?php } else if ($offresTableau[$i]['nbre_vente'] == 0) { ?>
                                        <a href="#" class="btn btn-primary disabled" disabled>Rupture de stock</a>
                                        <?php } else { ?>
                                        <a href="?action=addOffrePanier&offre=<?= $offresTableau[$i]['id'] ?>&quantite=1" class="theme-btn btn-style-one"><span class="btn"><i class="fa fa-cart-arrow-down"></i> Ajouter
											</span></a>
                                        <?php } ?>
                                        <?php else : ?>
                                        <a data-toggle="modal" data-target="#ConnectionSlide" class="theme-btn btn-style-one">
                                            <span class="fas fa-sign-in-alt"></span> Se connecter
                                        </a>
                                        <?php endif; ?>
                                        <button class="btn btn-primary btn-block btn-sm">Prix : <?= ($offresTableau[$i]['prix'] == '0' ? 'gratuit' : $offresTableau[$i]['prix']) ?> <i class="fas fa-coins"></i></button>
                                    </div>
                                    <?php $categories[$j]['offres']++; ?>
									</div>
                                </div>
                            </div>

                            <?php endif; ?>
                            <?php endfor; ?>
                            <?php endif; ?>
						</div>
							
                        <?php if ($categories[$j]['offres'] == 0) : ?>
                        <!-- Aucune offre disponible -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Aucune offre disponible dans : <?= $categories[$j]['titre'] ?>
                        </div>
                        <?php endif; ?>

                    </div>
                    <?php endfor; ?>
                <!--</div> -->
                <?php else : ?>
                <!-- Aucune Catégorie disponible -->
                <div class="alert alert-info text-center"><i class="fas fa-info-circle"></i> Aucune catégorie n'a été créée</div>
                <?php endif; ?>
            </div>
</section>
