
<?php require('header.php')?>
<style>
    .cover-image{
    height: 500px !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden;
  }
  .cover-image img {
      display: block !important;
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
      transition: transform 0.3s ease;
    }
    .hero-section{
        width:70% !important;
        height:200px !important;
    }
    .cover-overlay-title {
    position: absolute;
    display: block;
    top: 20%;
    left:2%;
    /* left:50%;
    right:50%;
    width:300px; */
    padding: 5px 10px;
    font-size: 30px;
    font-weight: bold;
    border-radius: 10px;
    background-color: rgba(0, 29, 32, 0.3);
    z-index: 1000;
    color: #fff !important;
  }
</style>
    <div class="container mt-3">
       Graphs

    </div>
<?php require('footer.php')?>

