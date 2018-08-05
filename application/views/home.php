<?php $this->load->view('fragments/home-header.php') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <?php $this->load->view('fragments/home-left-menu') ?>
  </aside>

  <?php $this->load->view("fragments/contents/" . $content) ?>

<?php $this->load->view("fragments/home-footer.php") ?>
