</div> <!-- End main-content -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Set base URL untuk CI4
            var BASE_URL = '<?= base_url() ?>';
            
            // Initialize charts
            initializeCharts();
            
            // Tab click handlers
            $('.tab-btn').click(function() {
                var type = $(this).data('type');
                var card = $(this).closest('.rekap-card');
                
                // Update active tab
                card.find('.tab-btn').removeClass('active');
                $(this).addClass('active');
                
                // Update chart based on type
                updateChart(card, type);
                
                // Load data via AJAX
                loadRekapData(type, card);
            });
        });

        function initializeCharts() {
            // Chart 1 - Pemasukan (Green)
            createChart('chart1', 100, '#28a745');
            
            // Chart 2 - Pengeluaran (Red)  
            createChart('chart2', 100, '#dc3545');
            
            // Chart 3 - Mixed (Green + Red)
            createMixedChart('chart3');
        }

        function createChart(canvasId, percentage, color) {
            var canvas = document.getElementById(canvasId);
            if (!canvas) return;
            
            var ctx = canvas.getContext('2d');
            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = 60;
            
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Draw full circle
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
            ctx.fillStyle = color;
            ctx.fill();
        }

        function createMixedChart(canvasId) {
            var canvas = document.getElementById(canvasId);
            if (!canvas) return;
            
            var ctx = canvas.getContext('2d');
            var centerX = canvas.width / 2;
            var centerY = canvas.height / 2;
            var radius = 60;
            
            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            // Draw green half (left)
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, Math.PI / 2, -Math.PI / 2);
            ctx.fillStyle = '#28a745';
            ctx.fill();
            
            // Draw red half (right)
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, -Math.PI / 2, Math.PI / 2);
            ctx.fillStyle = '#dc3545';
            ctx.fill();
        }

        function updateChart(card, type) {
            var canvas = card.find('canvas')[0];
            var chartInfo = card.find('.chart-info');
            
            // Remove existing chart classes
            card.removeClass('pemasukan-chart pengeluaran-chart semua-chart');
            
            switch(type) {
                case 'pemasukan':
                    card.addClass('pemasukan-chart');
                    createChart(canvas.id, 100, '#28a745');
                    updateChartInfo(chartInfo, '100%', 'Gaji', 'Rp 50.000', false);
                    break;
                    
                case 'pengeluaran':
                    card.addClass('pengeluaran-chart');
                    createChart(canvas.id, 100, '#dc3545');
                    updateChartInfo(chartInfo, '100%', 'Pengeluaran', 'Rp 50.000', false);
                    break;
                    
                case 'semua':
                    card.addClass('semua-chart');
                    createMixedChart(canvas.id);
                    updateChartInfo(chartInfo, '', '', '', true);
                    break;
            }
        }

        function updateChartInfo(chartInfo, percentage, label, amount, isMixed) {
            if (isMixed) {
                chartInfo.html(`
                    <div class="chart-legend">
                        <div class="legend-item">
                            <span class="legend-color bg-success"></span>
                            <span class="percentage">100%</span>
                            <span class="label">Gaji</span>
                            <span class="amount">Rp 50.000</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color bg-danger"></span>
                            <span class="percentage">100%</span>
                            <span class="label">Pengeluaran</span>
                            <span class="amount">Rp 50.000</span>
                        </div>
                    </div>
                `);
            } else {
                chartInfo.html(`
                    <div class="percentage">${percentage}</div>
                    <div class="label">${label}</div>
                    <div class="amount">${amount}</div>
                `);
            }
        }

        function loadRekapData(type, card) {
            $.ajax({
                url: '<?= base_url("rekap/ajax") ?>',
                type: 'GET',
                data: { type: type },
                dataType: 'json',
                success: function(response) {
                    // Update transaction list
                    updateTransactionList(card, response, type);
                    
                    // Update summary
                    updateSummary(card, response, type);
                },
                error: function(xhr, status, error) {
                    console.error('Error loading rekap data:', error);
                }
            });
        }

        function updateTransactionList(card, data, type) {
            var transactionContainer = card.find('.transaction-item').parent();
            var html = '';
            
            if (data && data.length > 0) {
                data.forEach(function(transaction) {
                    var icon = transaction.type === 'income' ? 
                        '<i class="fas fa-exchange-alt transaction-icon text-primary"></i>' :
                        '<i class="fas fa-ticket-alt transaction-icon text-info"></i>';
                    
                    var amountClass = transaction.type === 'income' ? 'text-success' : 'text-danger';
                    var amountPrefix = transaction.type === 'income' ? '+' : '-';
                    
                    html += `
                        <div class="transaction-item">
                            ${icon}
                            <span class="transaction-type">${transaction.description || transaction.category || transaction.type}</span>
                            <span class="transaction-amount ${amountClass}">${amountPrefix}Rp ${formatNumber(transaction.amount)}</span>
                        </div>
                    `;
                });
            } else {
                html = '<div class="text-center text-muted py-3">Tidak ada transaksi</div>';
            }
            
            // Replace existing transaction items
            card.find('.transaction-item').remove();
            card.find('.summary-section').after(html);
        }

        function updateSummary(card, data, type) {
            var total = 0;
            var prefix = '';
            var colorClass = '';
            
            if (data && data.length > 0) {
                data.forEach(function(transaction) {
                    if (type === 'semua') {
                        total += transaction.type === 'income' ? 
                            parseInt(transaction.amount) : -parseInt(transaction.amount);
                    } else {
                        total += parseInt(transaction.amount);
                    }
                });
            }
            
            if (type === 'pemasukan') {
                prefix = '+';
                colorClass = 'text-success';
            } else if (type === 'pengeluaran') {
                prefix = '-';
                colorClass = 'text-danger';
            } else {
                prefix = total >= 0 ? '+' : '';
                colorClass = total >= 0 ? 'text-success' : 'text-danger';
            }
            
            var summaryText = type === 'semua' ? 'Total Hari Ini' : 
                             (type === 'pemasukan' ? 'Total Pemasukan' : 'Total Pengeluaran');
            
            card.find('.summary-section .text-right strong').html(
                `<span class="${colorClass}">${prefix}Rp ${formatNumber(Math.abs(total))}</span>`
            );
            
            card.find('.summary-section .text-right small').text(summaryText);
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
</body>
</html>