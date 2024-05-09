document.addEventListener("DOMContentLoaded", function() {
    // Récupération des données PHP
    // var positiveCount = <?php echo $commentaireC->countPositiveComments(); ?>;
    // var negativeCount = <?php echo $commentaireC->countNegativeComments(); ?>;

    // Création du graphique
    var ctx = document.getElementById('commentChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Positif', 'Négatif'],
            datasets: [{
                label: 'Nombre de Commentaires',
                data: [positiveCount, negativeCount],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
