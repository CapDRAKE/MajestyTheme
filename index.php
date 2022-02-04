<?php
require('theme/' . $_Serveur_['General']['theme'] . '/preload.php');
$configTheme = new Lire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml');
$_Theme_ = $configTheme->GetTableau();

?>
<!DOCTYPE html>
<html lang="fr">


    <head>
        <base href="<?= urlRewrite::getSiteUrl() ?>" />
        <title><?= $_Serveur_['General']['name'] . " | " . (isset($_GET["page"]) ? ucfirst($_GET["page"]) : $_Serveur_['General']['description']) ?></title>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
        <meta name="msapplication-navbutton-color" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
        <meta name="apple-mobile-web-app-statut-bar-style" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
        <meta name="apple-mobile-web-app-capable" content="<?= $_Serveur_["color"]["theme"]["main"]; ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- SEO -->
        <meta property="og:title" content="<?= $_Serveur_['General']['name'] ?>">
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://<?= $_SERVER["SERVER_NAME"] ?>">
        <meta property="og:image" content="https://<?= $_SERVER["SERVER_NAME"] ?>/favicon.ico">
        <meta property="og:image:alt" content="<?= $_Serveur_['General']['description'] ?>">
        <meta property="og:description" content="<?= $_Serveur_['General']['description'] ?>">
        <meta property="og:site_name" content="<?= $_Serveur_['General']['name'] ?>" />
        <meta name="twitter:title" content="<?= $_Serveur_['General']['name'] ?>">
        <meta name="twitter:description" content="<?= $_Serveur_['General']['description'] ?>">
        <meta name="twitter:image" content="https://<?= $_SERVER["SERVER_NAME"] ?>/favicon.ico">
        <meta name="author" content="CraftMyWebsite, TheTueurCiTy, <?= $_Serveur_['General']['name']; ?>" />
        <meta name="publisher" content="<?= $_SERVER["SERVER_NAME"] ?>" />
        <meta name="description" content="<?= $_Serveur_['General']['description'] ?>">
        <meta name="copyright" content="CraftMyWebsite, <?= $_Serveur_['General']['name']; ?>" />
        <meta name="robots" content="follow, index, all">
        <meta name="google" content="notranslate">
        <!-- Google Service -->
        <?php 
        if(googleService::isAdsenseEnable($_Serveur_)) {
            googleService::getAdsense()->writeHead();
        }
        if(googleService::isAnalyticsEnable($_Serveur_)) {
            googleService::getAnalytics()->writeHead();
        }	
        ?>
        <!-- CSS links -->
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/toastr.min.css">
		        <!-- CSS links -->
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/fa-all.min.css">
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/css/style.css">
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/css/responsive.css">
        <link rel="stylesheet" type="text/css" href="theme/<?= $_Serveur_['General']['theme']; ?>/assets/css/toastr.min.css">
        <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/ckeditor.js"></script>
        <?php if(isset($_GET['page']) && $_GET['page'] == "voter") {
    echo '<script type="application/javascript" src="theme/'.$_Serveur_['General']['theme'].'/assets/js/voteControleur.js"></script>';
} ?>
    </head>

    <body>
		

        <!-- Jetons -->
        <script type="text/javascript">var _Jetons_ = "<?=$_Serveur_['General']['moneyName'];?>";</script>
        <div id="content">
            <?php include("./include/version.php"); include("./include/version_distant.php"); if ($versioncms != $versioncmsrelease && Permission::getInstance()->verifPerm('PermsPanel', 'update', 'showPage')) : ?>
            <!-- M.A.J Dispo -->
            <div class="alert alert-primary alert-dismissible text-center fade show mb-0" role="alert">
                Une mise à jour est disponible <strong>(<a href="https://craftmywebsite.fr/telecharger" target="_blank" class="alert-link"><?= $versioncmsrelease ?></a>)</strong> !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color: var(--base-color);">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <?php if (Permission::getInstance()->verifPerm("connect")) setcookie('pseudo', $_Joueur_['pseudo'], time() + 86400, null, null, false, true); include('theme/' . $_Serveur_['General']['theme'] . '/entete.php'); tempMess(); ?>
            <?php if (is_dir("installation")) { include('theme/' . $_Serveur_['General']['theme'] . '/pages/fichier_installation.php'); } else { include('controleur/page.php'); } ?>
        </div>
        <?php include('theme/' . $_Serveur_['General']['theme'] . '/pied.php'); include('theme/' . $_Serveur_['General']['theme'] . '/formulaires.php'); ?>
        <!-- Retour en haut -->
    </body>
    <!-- Librairies -->
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/jquery.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/snow.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/popper.min.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/jquery-ui.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/jquery.fancybox.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/owl.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/appear.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/wow.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/scrollbar.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/js/script.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/jquery.min.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/popper.min.js"></script>
	<script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/multi-animated-counter.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/bootstrap.min.js"></script>
    <!-- RGPD -->
    <script type="text/javascript" src="//www.cookieconsent.com/releases/3.1.0/cookie-consent.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            cookieconsent.run({
                "notice_banner_type": "standalone",
                "consent_type": "express",
                "palette": "dark",
                "language": "fr"
            });
        });

    </script>
    <noscript>ePrivacy and GPDR Cookie Consent by <a href="https://www.CookieConsent.com/" rel="nofollow noopener">Cookie Consent</a></noscript>
    <!-- Scripts -->
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/clipboard.min.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/zxcvbn.js"></script>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets/js/custom.js"></script>
    <?php include "theme/" . $_Serveur_['General']['theme'] . "/assets/php/ckeditorManager.php"; ?>
    <script type="application/javascript" src="theme/<?= $_Serveur_['General']['theme']; ?>/assets//js/toastr.min.js"></script>
    <?php include "theme/" . $_Serveur_['General']['theme'] . "/assets/php/custom.php"; ?>
    <?php if ($_Serveur_['Payement']['dedipass']) : ?>
    <script type="application/javascript" src="//api.dedipass.com/v1/pay.js"></script>
    <?php endif; ?>
    <script>new ClipboardJS('a');</script>
	<!--<div id="snow"></div>-->
</html>
