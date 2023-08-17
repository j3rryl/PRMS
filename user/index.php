
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
    <div class="cover-image">
    <span class="cover-overlay-title">“Discover, Connect, and Engage with PRMS”</span>
    <img src="../assets/images/hospital.png" class="img-fluid" alt="Responsive image">
    </div>

    <div class="container mt-3">
        <div class="row gap-5">
            <div class="col mb-3 hero-section">
                <div class="hero-section card p-3 shadow">
                    <div class="text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#008080" class="bi bi-activity" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
                    </svg>
                    </div>
                    Welcome to PRMS, the premier web application reshaping the way healthcare establishments manage patient information. 
                </div>
            </div>
            <div class="col mb-3 hero-section">
                <div class="hero-section card p-3 shadow">
                <div class="text-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#008080" class="bi bi-capsule" viewBox="0 0 16 16">
                    <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z"/>
                    </svg>
                </div>
                In today's fast-paced medical landscape, staying organized and having instant access to patient records is not just a convenience - it's a necessity.
                </div>
            </div>
            <div class="col mb-3 hero-section">
                <div class="hero-section card p-3 shadow">
                    <div class="text-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#008080" class="bi bi-file-earmark-medical" viewBox="0 0 16 16">
                    <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>
                    </div>
                    PRMS is more than just a digital record-keeping system. It's a holistic solution for clinics, hospitals, and private practices.
                </div>
            </div>

        </div>

    </div>
<?php require('footer.php')?>

