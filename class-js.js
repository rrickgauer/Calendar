var view = 'chart';

// tool tip for add item
$(document).ready(function() {
  $('[data-toggle="tooltip"]').tooltip();

  // set the background on the navbar to selected
  $("#class-navbar-link").addClass("custom-bg-grey");

  // set flatpickr js
  flatpickr("#date-assigned-new", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    defaultDate: "today"
  });

  flatpickr("#date-due-new", {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
  });

  // initialize the Chart
  // setChart();

  getClassItemCounts();

});

// updates the info in the update-item-info form modal
function getUpdateItemFormInfo(classID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var e = this.responseText;
      $("#update-item-model-content").html(e);
    }
  };

  xhttp.open("GET", "get-item-info.php?q=" + classID, true);
  xhttp.send();
}

function deleteClass() {
  if (confirm("Are you sure you want to delete this class?")) {
    var classID = $("#class-card-top").data("class-id");
    var location = 'delete-class.php?classID=' + classID;
    window.location.href = location;
  }
}

function getClassItemCounts() {
  var classID = getClassID();

  $.ajax({
    type: "GET",
    url: 'get-class-data.php',
    data: {
      "type"    : "check",
      "classID" : classID,
      "view"    : "chart"
    },
    success: function(response) {
      if (view == 'chart') {
        loadChart(response);
      } else {
         loadTable(response);
       }
      console.log(response);
    }
  });
}


function loadChart(data) {
  var counts = JSON.parse(data);
  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'horizontalBar',

    // The data for our dataset
    data: {
      labels: ['Assignments', 'Exams', 'Projects', 'Quizzes', 'Other'],
      datasets: [
        {
          label: 'Open',
          backgroundColor: 'rgb(108, 52, 131)',
          borderColor: 'rgb(108, 52, 131)',
          data: [counts.assignments_open, counts.exams_open, counts.projects_open, counts.quizzes_open, counts.other_open],
        },

        {
          label: 'Completed',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: [counts.assignments_completed, counts.exams_completed, counts.projects_completed, counts.quizzes_completed, counts.other_completed],
        },
      ]
    },

    // Configuration options go here
    options: {
      scales: {
        xAxes: [{
          stacked: true
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }
  });
}

function getClassID() {
  return $("#class-card-top").data("class-id");
}

function updateView(newView) {
  view = newView;

  if (view == 'chart') {
    $("#item-breakdown-card .card-body").html('<canvas id="myChart"></canvas>');
  }

  getClassItemCounts();

  $("#item-breakdown-card .dropdown-menu .dropdown-item").toggleClass("selected");
}

function loadTable(data) {
  var counts = JSON.parse(data);

  var thead = '<table class="table table-sm"><thead><tr><th>Type</th><th>Open</th><th>Closed</th><th>Total</th></tr></thead><tbody>';

  var assignments = '<tr><td>Assignments</td>';
  assignments = assignments + '<td>' + counts.assignments_open + '</td>';
  assignments = assignments + '<td>' + counts.assignments_completed + '</td>';
  assignments = assignments + '<td>' + counts.assignments + '</td>';
  assignments = assignments + '</tr>';

  var exams = '<tr><td>Exams</td>';
  exams = exams + '<td>' + counts.exams_open + '</td>';
  exams = exams + '<td>' + counts.exams_completed + '</td>';
  exams = exams + '<td>' + counts.exams + '</td>';
  exams = exams + '</tr>';

  var quizzes = '<tr><td>Quizzes</td>';
  quizzes = quizzes + '<td>' + counts.quizzes_open + '</td>';
  quizzes = quizzes + '<td>' + counts.quizzes_completed + '</td>';
  quizzes = quizzes + '<td>' + counts.quizzes + '</td>';
  quizzes = quizzes + '</tr>';

  var projects = '<tr><td>Projects</td>';
  projects = projects + '<td>' + counts.projects_open + '</td>';
  projects = projects + '<td>' + counts.projects_completed + '</td>';
  projects = projects + '<td>' + counts.projects + '</td>';
  projects = projects + '</tr>';

  var other = '<tr><td>Other</td>';
  other = other + '<td>' + counts.other_open + '</td>';
  other = other + '<td>' + counts.other_completed + '</td>';
  other = other + '<td>' + counts.other + '</td>';
  other = other + '</tr>';

  var thead2 = '<tr class="row-sum">';
  thead2 = thead2 + '<th>Sum</th>';
  thead2 = thead2 + '<th>' + counts.open + '</th>';
  thead2 = thead2 + '<th>' + counts.completed + '</th>';
  thead2 = thead2 + '<th>' + counts.total + '</th></tr>';

  var table = thead + assignments + exams + quizzes + projects + other + thead2 +  '</tbody></table>';

  $("#item-breakdown-card .card-body").html(table);

}
