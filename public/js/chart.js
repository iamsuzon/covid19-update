let ctx = document.getElementById('pieChart').getContext('2d');
let labels = ['Cases','Recovered','Deaths'];
let colorHex = ['#dc3545','#28a745','#343a40'];

let pieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    datasets: [{
      data: [30,45,10],
      backgroundColor: colorHex
    }],
    labels: labels
  },
  options: {
    responsive: true,
    legend: {
      position: 'bottom',
    },
    plugins: {
      datalabels: {
        color: '#fff',
        anchor: 'center',
        align: 'center',
        borderWidth: 2,
        borderColor: '#fff',
        borderRadius: 25
      }
    }
  }
})
