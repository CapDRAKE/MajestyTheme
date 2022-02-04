<?php
include ('controleur/maintenance.php');
require ('include/version.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?=$_Serveur_['General']['name'] . " | Maintenance " ?></title>
    <!-- Métadonnées -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="<?=$_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="msapplication-navbutton-color" content="<?=$_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="apple-mobile-web-app-statut-bar-style" content="<?=$_Serveur_["color"]["theme"]["main"]; ?>">
    <meta name="apple-mobile-web-app-capable" content="<?=$_Serveur_["color"]["theme"]["main"]; ?>">
    <meta property="og:title" content="<?=$_Serveur_['General']['name'] ?>">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://<?=$_SERVER["SERVER_NAME"] ?>">
    <meta property="og:image" content="https://<?=$_SERVER["SERVER_NAME"] ?>/favicon.ico">
    <meta property="og:image:alt" content="<?=$_Serveur_['General']['description'] ?>">
    <meta property="og:description" content="<?=$_Serveur_['General']['description'] ?>">
    <meta property="og:site_name" content="<?=$_Serveur_['General']['name'] ?>" />
    <meta name="twitter:title" content="<?=$_Serveur_['General']['name'] ?>">
    <meta name="twitter:description" content="<?=$_Serveur_['General']['description'] ?>">
    <meta name="twitter:image" content="https://<?=$_SERVER["SERVER_NAME"] ?>/favicon.ico">
    <meta name="author" content="CraftMyWebsite, TheTueurCiTy, Amjido, <?=$_Serveur_['General']['name']; ?>" />
    <!-- Feuilles de style -->
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/nebulae.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
</head>

<body style="background-image:url('theme/nebulae/assets/img/heading.jpg');background-size:cover;">
    <div id="particles-js"></div>
    <?php
    //Vercheck
    include ("./include/version.php");
    include ("./include/version_distant.php");
    ?>
    <div class="py-5">
        <!-- Contenu de la page -->
        <section id="maintenance">
            <div class="container">
                <?php if (!empty($donnees['dateFin'])):
            if ($donnees['dateFin'] != 0 && $donnees['dateFin'] <= time())
            {
                $req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat WHERE maintenanceId = :maintenanceId');
                $req->execute(array(
                    'maintenanceEtat' => 0,
                    'maintenanceId' => $donnees['maintenanceId']
                ));
                header("Location: /");
            } ?>

                <div class="rounded bg-secondary shadow p-3 mt-0 mb-4">
                    <div style="display:inline-block;">
                        <h4>Durée de maintenance <i class="fas fa-calendar"></i></h4>
                        <hr style="width:20%;border:1px solid black;display:inline-block;margin-top:-5px;margin-left:auto;margin-right:auto;" />
                    </div>
                    <div id="clockdiv" class="countdown-circles d-flex flex-wrap justify-content-center pt-4">

                        <div class="content-clock">
                            <span class="bloc-clock days h5"></span>
                            <div>Jours</div>
                        </div>
                        <div class="content-clock">
                            <span class="bloc-clock hours h5"></span>
                            <div>Heures</div>
                        </div>
                        <div class="content-clock">
                            <span class="bloc-clock minutes h5"></span>
                            <div>Minutes</div>
                        </div>
                        <div class="content-clock">
                            <span class="bloc-clock seconds h5"></span>
                            <div>Secondes</div>
                        </div>

                    </div>
                </div>
                <?php endif; ?>
                <div class="card border-0 w-100">
                    <div class="card-header bg-primary">
                        <h3 class="text-white text-center m-0"><i class="fas fa-tools"></i> Maintenance</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div style="display:inline-block;">
                                    <h4>Que se passe t-il ? <i class="fas fa-info-circle"></i></h4>
                                    <hr style="width:20%;border:1px solid black;display:inline-block;margin-top:-5px;margin-left:auto;margin-right:auto;" />
                                </div>
                                <p><?php echo $donnees['maintenanceMsg']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <form role="form" method="post" action="?&action=connection">
                                    <h5><i class="fas fa-user-cog"></i> Connexion Administrateurs</h5>
                                    <div class="form-group">
                                        <label for="PseudoConectionForm"> Pseudo </label>
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <div class="input-group-text bg-main border-0">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            </span>
                                            <input type="text" name="pseudo" class="form-control custom-text-input" id="PseudoConectionForm" placeholder="Pseudo" required autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="MdpConnectionForm"> Mot de passe </label>
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <div class="input-group-text bg-main border-0">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </span>
                                            <input type="password" name="mdp" class="form-control custom-text-input" id="MdpConnectionForm" placeholder="Votre mot de passe" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="reconnexion" name="reconnexion">
                                                <label class="custom-control-label" for="reconnexion">Se souvenir de moi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" data-target="#passRecover" data-toggle="modal" class="float-right" data-dismiss="modal">Mot de passe oublié ?</a>
                                        </div>
                                    </div>
                                    <?php if (Permission::getInstance()->verifPerm("PermsPanel", "maintenance", "actions", "connexionAdmin")) { ?>
                                    <a href="index.php" class="btn btn-primary btn-block btn-sm mt-2"><i class="fas fa-sign-in-alt"></i> Aller sur votre site</a>
                                    <?php } elseif (Permission::getInstance() ->verifPerm("connect")) { ?>
                                    <p>Vous n'avez pas la permission d'accéder au site pendant la maintenance ! </p>
                                    <?php } else { ?>
                                    <button type="submit" class="btn btn-primary btn-sm btn-block mt-2"><i class="fas fa-key"></i> Se connecter</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($donnees['inscription'] && !Permission::getInstance()->verifPerm('connect')) { ?>
                <!-- Inscription -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="text-center m-0">Inscription</h3>
                    </div>
                    <div class="card-body">
                        <h5><?=$donnees['maintenanceMsgInscr']; ?></h5>
                    </div>
                    <div class="card-footer">
                        <a data-toggle="modal" data-target="#InscriptionSlide" class="btn btn-main w-100">S'inscrire</a>
                    </div>
                </div>

                <?php } ?>

            </div>
        </section>
    </div>


    <?php include ('theme/' . $_Serveur_['General']['theme'] . '/formulaires.php'); //Forms included ?>


    <!-- Javascript -->
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/jquery.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/popper.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/bootstrap.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/clipboard.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/particles.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/particles_settings.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/zxcvbn.js"></script>
    <script src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/custom.js"></script>

    <!-- Script pour fonctionnement de la page -->
    <script type="text/javascript">
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            if (days == 0 && hours == 0 && minutes == 0 && seconds == 0)
                window.location.replace("/");
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t = getTimeRemaining(endtime);

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                }
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        var deadline = new Date(Date.parse(new Date()) + <?=($donnees["dateFin"] - time()) ?> * 1000);
        initializeClock('clockdiv', deadline);

    </script>
</body>

</html>
