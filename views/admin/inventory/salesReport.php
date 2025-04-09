  <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Monthly Sales</h5>
                  <!-- Bar Chart -->
                  <canvas id="barChart" style="max-height: 300px;"></canvas>
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      // Get PHP data and convert to JavaScript array
                      const salesData = <?php echo json_encode(array_values($monthlySalesData ?? [])); ?>;

                      
                      new Chart(document.querySelector('#barChart'), {
                        type: 'bar',
                        data: {
                          labels: [
                            'January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'
                          ],
                          datasets: [{
                            label: 'Sales Data',
                            data: salesData, // Use the real data
                            backgroundColor: [
                              'rgba(255, 99, 132, 0.5)', 'rgba(255, 159, 64, 0.5)',
                              'rgba(255, 205, 86, 0.5)', 'rgba(75, 192, 192, 0.5)',
                              'rgba(54, 162, 235, 0.5)', 'rgba(153, 102, 255, 0.5)',
                              'rgba(201, 203, 207, 0.5)', 'rgba(255, 87, 51, 0.5)',
                              'rgba(144, 238, 144, 0.5)', 'rgba(0, 191, 255, 0.5)',
                              'rgba(255, 140, 0, 0.5)', 'rgba(127, 255, 212, 0.5)'
                            ],
                            borderColor: [
                              'rgb(255, 99, 132)', 'rgb(255, 159, 64)',
                              'rgb(255, 205, 86)', 'rgb(75, 192, 192)',
                              'rgb(54, 162, 235)', 'rgb(153, 102, 255)',
                              'rgb(201, 203, 207)', 'rgb(255, 87, 51)',
                              'rgb(144, 238, 144)', 'rgb(0, 191, 255)',
                              'rgb(255, 140, 0)', 'rgb(127, 255, 212)'
                            ],
                            borderWidth: 1
                          }]
                        },
                        options: {
                          responsive: true,
                          plugins: {
                            legend: {
                              display: true,
                              position: 'top'
                            },
                            tooltip: {
                              callbacks: {
                                label: function(tooltipItem) {
                                  return 'Sales: ' + tooltipItem.raw;
                                }
                              }
                            }
                          },
                          scales: {
                            y: {
                              beginAtZero: true,
                              title: {
                                display: true,
                                text: 'Sales Total'
                              }
                            }
                          }
                        }
                      });
                    });
                  </script>
                  <!-- End Bar Chart -->
                </div>
              </div>
            </div><!-- End Reports -->
