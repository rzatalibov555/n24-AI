<?php $this->load->view('front/partials/headerStyle.php'); ?>
<?php $this->load->view('front/partials/loader.php'); ?>

<!-- REKLAM -->
<?php // $this->load->view('front/partials/reklam/main/___Reklam_topbar.php'); 
?>
<!-- REKLAM -->

<?php $this->load->view('front/partials/header.php'); ?>
<?php $this->load->view('front/partials/sideMenu.php'); ?>
<?php $this->load->view('front/partials/search.php'); ?>
<?php $this->load->view('front/partials/breakingNews.php'); ?>

<!-- container and reklam -->
<?php $this->load->view('front/partials/site_container/site_container_start.php'); ?>
<!-- container and reklam -->

<?php $this->load->view("front/partials/__indexContent_slider"); ?>
<?php $this->load->view("front/partials/__indexContent_categories"); ?>
<?php $this->load->view("front/partials/__indexContent_intervyu"); ?>
<?php $this->load->view('front/partials/reklam/main/___Reklam_footer.php'); ?>


<!-- container and reklam -->
<?php $this->load->view('front/partials/site_container/site_container_end.php'); ?>
<!-- container and reklam -->


<?php // $this->load->view("front/partials/_mostPopular"); ?>
<?php // $this->load->view("front/partials/liveVideos"); ?>
<?php // $this->load->view("front/partials/_discoverCategories"); ?>
<?php // $this->load->view("front/partials/modalSubscribe"); ?>

<?php $this->load->view("front/partials/footer"); ?>
<?php $this->load->view("front/partials/footerStyle"); ?>