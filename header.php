<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Aplikasi Keuangan' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        /* Rekap Card Styles */
        .rekap-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: white;
            margin-bottom: 20px;
        }

        .rekap-card .card-header {
            background: transparent;
            border-bottom: 1px solid #f0f0f0;
            padding: 15px 20px;
        }

        .rekap-card .card-body {
            padding: 20px;
        }

        /* Tab Navigation */
        .tab-navigation {
            display: flex;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 4px;
        }

        .tab-btn {
            flex: 1;
            background: none;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            color: #666;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .tab-btn.active {
            background: #007bff;
            color: white;
        }

        .tab-btn:hover:not(.active) {
            background: #e9ecef;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        .chart-info {
            text-align: center;
            margin-top: 15px;
        }

        .chart-info .percentage {
            font-size: 12px;
            font-weight: bold;
            color: #28a745;
            background: #28a745;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 5px;
        }

        .chart-info .label {
            font-size: 14px;
            color: #333;
            margin: 5px 0;
        }

        .chart-info .amount {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        /* Mixed Chart Legend */
        .mixed-chart .chart-legend {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .legend-item .percentage {
            background: none;
            color: #333;
            padding: 0;
            font-size: 11px;
            min-width: 30px;
        }

        /* Summary Section */
        .summary-section {
            margin: 20px 0;
            padding: 15px 0;
            border-top: 1px solid #f0f0f0;
        }

        .summary-section small {
            font-size: 11px;
        }

        .summary-section strong {
            font-size: 14px;
        }

        /* Transaction Items */
        .transaction-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-top: 1px solid #f0f0f0;
        }

        .transaction-item:first-child {
            border-top: none;
        }

        .transaction-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            margin-right: 12px;
            font-size: 14px;
        }

        .transaction-type {
            flex: 1;
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .transaction-amount {
            font-size: 14px;
            font-weight: bold;
        }

        /* Bottom Navigation */
        .bottom-navigation {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e9ecef;
            padding: 10px 0;
            display: flex;
            justify-content: space-around;
            z-index: 1000;
        }

        .bottom-navigation .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #666;
            font-size: 20px;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .bottom-navigation .nav-item.active {
            color: #007bff;
            background: #f0f8ff;
        }

        .bottom-navigation .nav-item:hover {
            color: #007bff;
            text-decoration: none;
        }

        /* Chart Canvas */
        canvas {
            max-width: 120px !important;
            max-height: 120px !important;
        }

        /* Color variations for different chart types */
        .pemasukan-chart .chart-info .percentage {
            background: #28a745;
        }

        .pengeluaran-chart .chart-info .percentage {
            background: #dc3545;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 10px;
            }
            
            .rekap-card {
                margin-bottom: 15px;
            }
            
            .rekap-card .card-body {
                padding: 15px;
            }
            
            .tab-btn {
                font-size: 11px;
                padding: 6px 8px;
            }
            
            .bottom-navigation {
                padding-bottom: 20px;
            }
        }
    </style>
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 80px; /* Space for bottom navigation */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-content {
            min-height: calc(100vh - 80px);
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <div class="main-content">