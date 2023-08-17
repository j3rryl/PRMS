
<?php 
require('header.php');
include '../db/operations/users.php';
$monthlyData = getMonthlyTestCounts();
$months = array_keys($monthlyData);
$counts = array_values($monthlyData);

$userData = getMonthlyUserCounts();
$userMonths = array_keys($userData);
$userCounts = array_values($userData);
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>    

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
<div class="container card p-3 mt-3 mb-3">
  <h6>Analytics for tests per month.</h6>
  <div class="row gap-2 mt-3">
        <div class="col card p-2">
            <p>Line Chart</p>
            <canvas id="lineChart"></canvas>
        </div>
        <div class="col card p-2">
            <p>Bar chart</p>
            <canvas id="barChart"></canvas>
        </div>
    </div>

</div>

<div class="container card p-3">
  <h6>Analytics for new patients.</h6>
  <div class="row gap-2 mt-3">
        <div class="col card p-2">
            <p>Line Chart</p>
            <canvas id="userLineChart"></canvas>
        </div>
        <div class="col card p-2">
            <p>Bar chart</p>
            <canvas id="userBarChart"></canvas>
        </div>
    </div>

</div>
    <script>
var ctx = document.getElementById('lineChart').getContext('2d');
var barCtx = document.getElementById('barChart').getContext('2d');
var uctx = document.getElementById('userLineChart').getContext('2d');
var ubarCtx = document.getElementById('userBarChart').getContext('2d');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels:  <?php echo json_encode($months); ?>, // Static months for example
        datasets: [{
            label: 'Tests per month.',
            data:  <?php echo json_encode($counts); ?>, // Static ticket counts for example
            backgroundColor: 'rgba(0, 128, 128, 0.5)',
            borderColor: '#008080',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels:  <?php echo json_encode($months); ?>, // Static months for example
        datasets: [{
            label: 'Tests per month.',
            data:  <?php echo json_encode($counts); ?>, // Static ticket counts for example
            backgroundColor: 'rgba(0, 128, 128, 0.5)',
            borderColor: '#008080',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


var umyChart = new Chart(uctx, {
    type: 'line',
    data: {
        labels:  <?php echo json_encode($userMonths); ?>, // Static months for example
        datasets: [{
            label: 'Patients per month.',
            data:  <?php echo json_encode($userCounts); ?>, // Static ticket counts for example
            backgroundColor: 'rgba(0, 128, 128, 0.5)',
            borderColor: '#008080',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var ubarChart = new Chart(ubarCtx, {
    type: 'bar',
    data: {
        labels:  <?php echo json_encode($userMonths); ?>, // Static months for example
        datasets: [{
            label: 'Patients per month.',
            data:  <?php echo json_encode($userCounts); ?>, // Static ticket counts for example
            backgroundColor: 'rgba(0, 128, 128, 0.5)',
            borderColor: '#008080',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>
<?php require('footer.php')?>

