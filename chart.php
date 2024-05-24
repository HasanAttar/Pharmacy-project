<?php
header("Content-type: application/javascript");
?>

var ctx = document.getElementById('chartHeldMedicines').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($_SESSION['line_chart_labels']); ?>,
        datasets: [{
            label: 'Total Held Medicines Quantity for <?php echo $pharmacy_name; ?>',
            data: <?php echo json_encode($_SESSION['line_chart_data']); ?>,
            fill: false,
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 2
        }]
    },
    echo "    options: {";
    echo "        scales: {";
    echo "            x: {";
    echo "                grid: {";
    echo "                    color: 'rgba(255, 255, 255, 0.2)'"; // Adjust the grid color for X-axis
    echo "                },";
    echo "                ticks: {";
    echo "                    color: 'black'"; // Adjust the label color for X-axis
    echo "                }";
    echo "            },";
    echo "            y: {";
    echo "                grid: {";
    echo "                    color: 'rgba(255, 255, 255, 0.2)'"; // Adjust the grid color for Y-axis
    echo "                },";
    echo "                ticks: {";
    echo "                    color: 'black'"; // Adjust the label color for Y-axis
    echo "                }";
    echo "            }";
    echo "        }";
    echo "    }";
    echo "});";
    echo "</script>";

