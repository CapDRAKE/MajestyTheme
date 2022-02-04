<?php
require('modele/forum/date.php');
if (isset($_GET['id'])) :
    $id = $_GET['id'];
    if (isset($_Joueur_))
        $_JoueurForum_->topic_lu($id, $bddConnection);
    $topicd = $_Forum_->getTopic($id);
    $titleHTML = $topicd['nom'];
    if (!empty($topicd['id'])) :
        if ((Permission::getInstance()->verifPerm("createur") or (Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $topicd['perms'] and Permission::getInstance()->verifPerm('PermsDefault', 'forum', 'perms') >= $topicd['permsCat']) and !$_SESSION['mode']) or ($topicd['perms'] == 0 and $topicd['permsCat'] == 0)) : ?>
<script>
    document.title = "<?=$_Serveur_['General']['name'] . " | " . $titleHTML;?>";

</script>
<section id="Post">
    <div class="container">
		<br/><br/><br>
        <div class="row">
 <nav aria-label="breadcrumb" role="navigation" class="w-100">
                            <ol class="breadcrumb bg-lightest">

                                <li class="breadcrumb-item">
                                    <a href="/">
                                        Accueil
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="index.php?page=forum">
                                        Forum
                                    </a>
                                </li>

                                <li class="breadcrumb-item">
                                    <a href="index.php?page=forum_categorie&id=<?= $topicd['id_categorie']; ?>">
                                        <?= $topicd['nom_categorie']; ?>
                                    </a>
                                </li>

                                <?php if (isset($topicd['sous_forum'])) : ?>
                                    <li class="breadcrumb-item">
                                        <a href="index.php?page=sous_forum_categorie&id=<?= $topicd['id_categorie']; ?>&id_sous_forum=<?= $topicd['sous_forum']; ?>">
                                            <?= $topicd['nom_sf']; ?>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="breadcrumb-item" aria-current="page">
                                    <?= $topicd['nom']; ?>
                                </li>

                            </ol>
                        </nav>


            <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic') or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'selTopic') and !$_SESSION['mode']) : ?>

            <div class="col-md-6 col-lg-4 col-sm-12 my-3 ml-auto">

                <div class="card">

                    <div class="card-header bg-primary">
                        <h5 class="text-white text-center mb-0"><i class="fas fa-screwdriver"></i> Modération</h5>
                    </div>

                    <div class="card-body categories">
                        <ul class="categorie-content nav flex-column">

                            <li class="categorie-item nav-item">
                                <div class="dropdown">
                                    <a class="nav-link categorie-link dropdown-toggle text-center" type="button" id="Actions-Modération" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fas fa-user-shield"></i> Actions de Modération
                                    </a>
                                    <div class="dropdown-menu" aria-labeledby="Actions-Modérations">

                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'closeTopic')) :

                                                            if ($topicd['etat'] == 1) : ?>

                                        <a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?= $id; ?>&choix=4">
                                            Ouvrir la discussion
                                        </a>

                                        <?php else : ?>

                                        <a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?= $id; ?>&choix=1">
                                            Fermer la discussion
                                        </a>

                                        <?php endif; ?>

                                        <?php endif; ?>

                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic')) : ?>

                                        <a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?= $id; ?>&choix=2">Supprimer le topic</a>

                                        <?php endif; ?>

                                        <?php if (Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'mooveTopic')) : ?>

                                        <a class="dropdown-item" href="?&action=forum_moderation&id_topic=<?= $id; ?>&choix=3">
                                            Déplacer la discussion
                                        </a>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            </li>

                            <li class="categorie-item nav-item">
                                <div class="dropdown">
                                    <a class="nav-link categorie-link dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Niveau d'accès
                                    </a>


                                    <div class="dropdown-menu">

                                        <form class="px-4 py-3" action="?action=modifPermsTopics" method="POST">
                                            <div class="form-group">
                                                <label for="perms">Niveau de permission</label>
                                                <input type="hidden" name="id" value="<?= $id; ?>">
                                                <input type="number" min="0" max="100" class="form-control custom-text-input" name="perms" value="<?= $topicd['perms']; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary bg-lightest w-100">Modifier</button>

                                        </form>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>

            </div>
            <?php endif; ?>

        </div>
<div class="content-side col-lg-12 col-md-12 col-sm-24">
	<div class="blog-detail"><div class="lower-content">
			<div class="post-date">Posté le <?=  $_Forum_->conversionDate($topicd['date_creation']); 
                                 if($topicd['d_edition'] != NULL) {
                                       
                                        echo " et édité le ".  $_Forum_->conversionDate($topicd['d_edition']);
								 }?></div>
		<h3>Sujet : <?= $topicd['nom']; ?></h3>
		</div></div>


            <!-- Contenue du topic de l'auteur -->
		
		<div class="comments-area">
            <div class="comment-box">
				<div class="comment">

                <?php
                            unset($contenue);
                            $contenue = $topicd['contenue'];

                            $signature = $_Forum_->getSignature($topicd['pseudo']);

                            $d_edition = explode('-', $topicd['d_edition']);

                            $countlike = $_Forum_->compteLike($topicd['id'], $count1, 1);
                            $countdislike = $_Forum_->compteDisLike($topicd['id'], $count2, 1);

                            ?>


				<div class="author-thumb">
                    <figure class="thumb"><img src="<?= $_ImgProfil_->getUrlHeadByPseudo($topicd['pseudo'],192); ?>" alt="" style="width: 192px; height: 192px;"></figure><br/><?php if (isset($_Joueur_) && ($_Joueur_['pseudo'] == $topicd['pseudo'] || Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'editTopic') && !$_SESSION['mode'])) : ?>
                        <form action="?action=editPost" method="post">
                            <input type="hidden" name="objet" value="topic" />
                            <input type="hidden" name="id" value="<?= $id; ?>" />
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                Editer
                            </button>
                        </form><?php endif; ?>
					                        <?php if (isset($_Joueur_) && ($_Joueur_['pseudo'] == $topicd['pseudo'] || Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteTopic') && !$_SESSION['mode'])) : ?>
                        <form action="?action=remove_topic" method="post">
                            <input type="hidden" name="id_topic" value="<?= $id; ?>" />
                            <a class="btn btn-danger w-100 no-hover" role="button" data-toggle="modal" href="#topic_<?= $id; ?>" aria-expanded="false" aria-controls="modalConfirmation">
                                Supprimer
                            </a>

                            <div class="modal fade" id="topic_<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content bg-danger">

                                        <div class="modal-header bg-danger">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body bg-danger rounded py-4">
                                            <h5>Voulez-vous vraiment <span class="font-weight-bolder">Supprimer</span> ce topic ?</h5>
                                            <h6>Plus aucune données de ce topic ne pourra être récupérées.</h6>
                                        </div>

                                        <div class="modal-footer bg-danger">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Confirmer la suppression de ce Topic !
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
                 </div> 
				<h4 class="name"><?= $topicd['pseudo']; ?> | <?= Permission::getInstance()->gradeJoueur($topicd['pseudo']); ?></h4>

                <div class="text" id="contenuePost">

                    <?= $contenue; ?>
                </div>
					                <p class="text-right h6 mt-3">

                </p>




                    <?php if (isset($_Joueur_)) : ?>
  
					<a onclick="addBlockQuote('ckeditorPost','contenuePost', '<?= $topicd['pseudo']; ?>');" class="reply-btn">Répondre</a>
                    <?php endif; ?>

				</div>
            </div>
        </div>
	<div class="blog-detail"><div class="lower-content"><h3>Commentaires :</h3>

        <!-- Affichage des réponses -->
        <?php
                    $count_Max = $_Forum_->compteReponse($id);
                    $count_nbrOfPages = ceil($count_Max / 20);

                    $page = (isset($_GET['page_post'])) ? $_GET['page_post'] : 1;

                    $count_FirstDisplay = ($page - 1) * 20;
                    $answerd = $_Forum_->affichageReponse($id, $count_FirstDisplay);

                    for ($i = 0; $i < count($answerd); $i++) : ?>


	<div class="blog-detail"><div class="lower-content">
			<div class="post-date"><?php 
                                    echo 'Posté le  '.$_Forum_->conversionDate($answerd[$i]['date_post']); 
                                    if($answerd[$i]['d_edition'] != NULL) {
                                        echo " et édité le ". $_Forum_->conversionDate($answerd[$i]['d_edition']);
                                    }?></div>
		</div></div>



		<div class="comments-area">
            <div class="comment-box">
				<div class="comment">

                <?php
                                $answere = $answerd[$i]['contenue'];

                                $signature = $_Forum_->getSignature($answerd[$i]['pseudo']);

                                $d_edition = explode('-', $answerd[$i]['d_edition']);

                                $countlike = $_Forum_->compteLike($answerd[$i]['id'], $count3, 1);
                                $countdislike = $_Forum_->compteDisLike($answerd[$i]['id'], $count4, 1);

                                $count1 += 1;
                                $count2 += 1;
                                ?>


				<div class="author-thumb">
                    <figure class="thumb"><img src="<?= $_ImgProfil_->getUrlHeadByPseudo($answerd[$i]['pseudo'], 192); ?>" alt="" style="width: 192px; height: 192px;"></figure><br/><?php if ($_Joueur_['pseudo'] === $answerd[$i]['pseudo'] or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'editMessage') and !$_SESSION['mode']) : ?>
                        <form action="?action=editPost" method="post">
                            <input type="hidden" name="objet" value="answer" />
                            <input type="hidden" name="id" value="<?= $answerd[$i]['id']; ?>" />
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                Editer
                            </button>
                        </form>
                        <?php endif; ?>
 <?php if ($_Joueur_['pseudo'] === $answerd[$i]['pseudo'] or Permission::getInstance()->verifPerm('PermsForum', 'moderation', 'deleteMessage') and !$_SESSION['mode']) : ?>
									<form action="?action=remove_answer" method="post">
                                                <input type="hidden" name="id_answer" value="<?= $answerd[$i]['id']; ?>" />
                                                <input type="hidden" name="page" value="<?= (isset($_GET['page_post'])) ? $_GET['page_post'] : 1; ?>" />
                                                <a class="btn btn-danger w-100 no-hover" role="button" data-toggle="modal" href="#awnser_<?= $answerd[$i]['id']; ?>" aria-expanded="false" aria-controls="modalConfirmation">
                                                    Supprimer
                                                </a>

                                                <div class="modal fade" id="awnser_<?= $answerd[$i]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalConfirmation" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content bg-danger">

                                                            <div class="modal-header bg-danger">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body bg-danger rounded py-4">
                                                                <h5>Voulez-vous vraiement <span class="font-weight-bolder">Supprimer</span> ce message ?</h5>
                                                                <h6>Plus aucune donnée de ce message ne pourra être récupéré.</h6>
                                                            </div>

                                                            <div class="modal-footer bg-danger">
                                                                <button type="submit" class="btn btn-secondary w-100">
                                                                    Confirmer la suppression de ce message !
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                 </div> 
				<h4 class="name"><?= $answerd[$i]['pseudo']; ?> | <?= Permission::getInstance()->gradeJoueur($answerd[$i]['pseudo']); ?></h4>

                <div class="text" id="contenuePost">

                    <?= $answere; ?>
                </div>
					                <p class="text-right h6 mt-3">

                </p>




                    <?php if (isset($_Joueur_)) : ?>
  
					<a onclick="addBlockQuote('ckeditorPost','contenuePost<?=$i?>', '<?= $answerd[$i]['pseudo']; ?>');" class="reply-btn">Répondre</a>
                    <?php endif; ?>


				</div>
            </div>
        </div>

        <?php endfor; ?>
        <hr class="bg-main" />

        <nav aria-label="Page Navigation Post">
            <ul class="pagination justify-content-end">
                <?php for ($i = 1; $i <= $count_nbrOfPages; $i++) : ?>

                <li class="page-item">
                    <a class="page-link" href="?&page=post&id=<?= $id; ?>&page_post=<?= $i; ?>">
                        <?= $i; ?>
                    </a>
                </li>

                <?php endfor; ?>
            </ul>
        </nav>

        <?php if ($topicd['etat'] == 1 and (!Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide') and $_SESSION['mode'])) : ?>

        <div class="d-flex col-12 info-page">
            <i class="fas fa-window-close notification-icon"></i>
            <div class="info-content">
                Le topic est fermé ! Aucune réponse n'est possible !
            </div>
        </div>
	</div>

        <?php elseif (isset($_Joueur_) && ($topicd['etat'] == 0 or (Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide') and !$_SESSION['mode']))) : ?>

        <hr class="my-2 bg-lightest w-80" />

        <div class="col-12 mx-auto">

            <?php $data = $_Forum_->isLock($topicd['id_categorie']);
                            if ($data['close'] == 0 or isset($topicd['sous_forum']) or Permission::getInstance()->verifPerm('PermsForum', 'general', 'seeForumHide') and !$_SESSION['mode']) : ?>


            <h4 class="text-center"><i class="fas fa-feather"></i> Rédiger une réponse</h4>
            <form action="?&action=post_answer" method="post">
                <input type='hidden' name="id_topic" value="<?= $id; ?>" />

                <div class="form-row">

                    <div class="col-md-12 text-center">

                        <textarea data-UUID="0003" id="ckeditorPost" name="contenue" style="height: 750px; margin: 0px; width: 100%;"></textarea>
                    </div>

                </div>

                <div class="form-row" style="margin-top:15px;">
                    <div class="col-12">
                        <center><button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Poster votre réponse</span></button></center>
                    </div>
                </div>

            </form><br/><br/><br>


            <?php elseif (!Permission::getInstance()->verifPerm("connect")) : ?>
            <div class="alert alert-info">
                <i class="fas fa-sign-in-alt"></i> Connectez-vous pour intéragir !
            </div>
            <?php endif; ?>

        </div>

        <?php endif; ?>

    </div>
		</div></div>
</section>

<?php else :
            header('Location: ?page=erreur&erreur=7');
        endif;
    else :
        header('Location: index.php');
    endif;
else :
    header('Location: ?page=erreur&erreur=17'); //fatale
endif; ?>
