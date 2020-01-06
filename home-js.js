$(document).ready(function() {

  $("#home-navbar-link").addClass("custom-bg-grey");
  getItemTypeCountData();

  $(".class-card-home").on("click", function() {
    gotoCardPage(this);
  });
});

function gotoCardPage(card) {
  var id = $(card).data("id");
  window.location.href = "class.php?cid=" + id;
}

function getItemTypeCountData() {
  $.ajax({
    type: "GET",
    url: 'get-home-page-data.php',
    data: {"type": "check"},
    success: function(response) {
      loadChart(response);
    }
  });
}

function loadChart(data) {
  var counts = JSON.parse(data);
  var ctx = document.getElementById('item-type-count-chart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
      labels: ['Assignments', 'Exams', 'Projects', 'Quizzes', 'Other'],
      datasets: [{
        label: 'Count',
        data: [counts.count_assignments, counts.count_exams, counts.count_projects, counts.count_quizzes, counts.count_other],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false,
      }
    }
  });
}
