<section id="vote" class="welcome-section">
    <div class="container">
        <!-- Alerts -->
        <div class="mb-3">
            <?php if (isset($_GET['success'])) :
                if ($_GET['success'] != 'recupTemp') : ?>
            <div class="alert alert-success alert-dismissible fade show text-shadow-none" role="alert">
                Votre récompense arrive, si vous n'avez pas vu de fenêtre s'ouvrir pour voter, la fenêtre à dû s'ouvrir derrière votre navigateur, validez le vote et <strong class="important--text">profitez de votre récompense In-Game</strong> !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php else : ?>
            <div class="alert alert-success alert-dismissible fade show text-shadow-none" role="alert">
                La récompense séléctionnée arrive, <strong class="important--text">Profitez de cette dernière In-Game ! </strong>
                Votre(vos) récompense(s) arrive(nt), profitez de votre(vos) récompense(s) In-Game !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif;
            endif; ?>
        </div>
        <!-- Gestion des informations de vote -->
        <div>
            <?php
            if (Permission::getInstance()->verifPerm("connect") and isset($_GET['player']) and $_Joueur_['pseudo'] == $_GET['player']) {  ?>
            <!-- Gestion des Récompenses -->
            <div class="alert alert-main w-80 mx-auto" id="disprecompList" style="display:none;">

                <h4 class="alert-heading h4">
                    Réception de récompense(s) !
                </h4>
                <hr>

                <ul id="recompList" class="list-unstyled container">
                </ul>

            </div>
            <?php } ?>
        </div>
        <div class="row">
            <?php if (!isset($_GET['player'])) { ?>
			 <div class="row clearfix">
                
                <!-- Title Column -->
                <div class="title-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft" data-wow-delay="0ms">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <div class="title">Voter</div>
                            <h2>Pseudonyme</h2>
                        </div>
                        <div class="text">Entrez votre pseudonyme. Pensez à vous inscrire pour garantir une bonne réception des récompenses. Pensez à bien mettre votre pseudo IN-GAME EXACT. Vous pouvez voter même si vous n'êtes pas connecté sur le serveur. Il vous suffit de faire /cr claim in-game afin de récupérer vos clés.</div>
                    </div>
                </div>
                <!-- Form Column -->
                <div class="form-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInRight" data-wow-delay="0ms">
                        
                        <!--Default Form-->
                        <div class="default-form contact-form">
							<form id="forme-vote" role="form" method="GET" action="index.php">
                                <div class="row clearfix"> 
									<input type="text" style="display:none;" name="page" value="voter">
                                    <div class="col-md-12 col-sm-12 form-group">
										  <br/><br/><br/><br/>
                                        <input type="text" id="vote-pseudo" class="form-control" name="player" placeholder="Votre pseudo IN-GAME" value="<?= (Permission::getInstance()->verifPerm("connect")) ? $_Joueur_['pseudo'] : '' ?>" required>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 form-group">
                                        <button class="theme-btn btn-style-one" type="submit"><span class="btn-title">Suivant</span></button>
                                    </div>
                                </div>
							</form>
                        </div>
                        
                    </div>
                </div>
            </div>

            <?php } else { ?>

			            

            <?php
                require_once("modele/vote.class.php");
                 $pseudo = htmlspecialchars($_GET['player']); ?>
            <div class="col-lg-16">
                <!-- Affichage des sites de vote -->
                <div class="sidebar-widget search-box">
                    <div class="card-body">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Voter pour <?= $_Serveur_['General']['name']; ?></h4>
                    </div>

                        <div class="tab-content">

                            <?php

                                    if(Permission::getInstance()->verifPerm("connect") AND  isset($_GET['player']) AND $_Joueur_['pseudo'] == $_GET['player'] ) {
                                        echo '<script>isConnect = true;</script>';
                                    }

                                     $first=true; foreach($lectureJSON as $serveur) { ?>

                            <div id="voter-<?= $serveur['id']; ?>" class="tab-pane fade <?= ($first) ? ' in active show' : ''; ?>" aria-expanded="<?= ($first) ? 'true' : 'false' ?>">
                                <hr>
                                <h5 class="title-vote-listing">
                                    Liste des sites de vote <div class="vote-line"></div>
                                </h5>
                                <?php 
                                            $req_vote->execute(array('serveur' => $serveur['id']));
                                            while($allvote = $req_vote->fetch(PDO::FETCH_ASSOC)) {
                                                 $vote = new vote($bddConnection, $pseudo, $allvote['id']);
    
                                                  ?>

                                <button type="button" id="votebtn-<?php echo $allvote['id']; ?>"></button>
                                <script>
                                    initVoteBouton(document.getElementById('votebtn-<?php echo $allvote['id']; ?>'), '<?php echo $pseudo; ?>', <?php echo $allvote['id']; ?>, <?php echo $vote->getLastVoteTimeMili(); ?>, <?php echo $vote->getTimeVoteTimeMili(); ?>, '<?php echo $vote->getUrl(); ?>', '<?php echo $vote->getTitre(); ?>');

                                </script>
                                <?php } ?>
                            </div>

                            <?php $first=false; } ?>

                        </div>
                    </div>
                </div>
            </div>
            <script>
                <?php 
                    foreach($topRecompense as $key => $value) {
                        echo "topRec.set(".$key.",JSON.parse('".$value."'));";
                    }

                ?>

            </script>

            <?php } ?>
        </div>
		<br/><br/>
        <!-- Top vote -->
        <!-- Disclaimer -->
		<br/><br/>
        <div style="display:inline-block;">
            <h4>Les meilleurs voteurs <i class="fas fa-award"></i></h4>
            <hr style="width:20%;border:1px solid black;display:inline-block;margin-top:-5px;margin-left:auto;margin-right:auto;" />
        </div>
        <table class="table table-hover " id="baltop">
            <!-- theme/default/assets/js/voteControleur.js::updateBaltop -->
        </table>
    </div>
</section>
