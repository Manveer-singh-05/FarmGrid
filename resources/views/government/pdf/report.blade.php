<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>FarmGrid Executive State Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #10B981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1a2f50;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #64748b;
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section-title {
            color: #1a2f50;
            font-size: 20px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .stats-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 15px;
        }
        .stat-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            width: 50%;
        }
        .stat-label {
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .stat-value {
            color: #1a2f50;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .value-blue { color: #38BDF8; }
        .value-green { color: #10B981; }
        .value-orange { color: #F59E0B; }
        .value-red { color: #EF4444; }
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .summary-table th, .summary-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        .summary-table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
        }
        .summary-table td.value {
            font-weight: bold;
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FarmGrid Executive State Report</h1>
        <p>Generated on {{ date('F j, Y, g:i a') }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Farmer Demographics</h2>
        <table class="stats-grid">
            <tr>
                <td class="stat-card">
                    <div class="stat-label">Total Population</div>
                    <div class="stat-value value-blue">{{ $totalFarmers ?? 0 }}</div>
                </td>
                <td class="stat-card">
                    <div class="stat-label">Verified Assets</div>
                    <div class="stat-value value-green">{{ $approvedFarmers ?? 0 }}</div>
                </td>
            </tr>
            <tr>
                <td class="stat-card">
                    <div class="stat-label">Pending Audit</div>
                    <div class="stat-value value-orange">{{ $pendingFarmers ?? 0 }}</div>
                </td>
                <td class="stat-card">
                    <div class="stat-label">Decommissioned</div>
                    <div class="stat-value value-red">{{ $rejectedFarmers ?? 0 }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Network Health & Complaints</h2>
        <table class="stats-grid">
            <tr>
                <td class="stat-card">
                    <div class="stat-label">Total Incidents</div>
                    <div class="stat-value value-red">{{ $totalComplaints ?? 0 }}</div>
                </td>
                <td class="stat-card">
                    <div class="stat-label">Critical Attention</div>
                    <div class="stat-value value-orange">{{ $pendingComplaints ?? 0 }}</div>
                </td>
            </tr>
            <tr>
                <td class="stat-card" colspan="2" style="width: 100%;">
                    <div class="stat-label">Resolved Issues</div>
                    <div class="stat-value value-green">{{ $resolvedComplaints ?? 0 }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Energy Consumption Audit</h2>
        <table class="stats-grid">
            <tr>
                <td class="stat-card">
                    <div class="stat-label">Gross Consumption (kWh)</div>
                    <div class="stat-value value-orange">{{ number_format((float)($totalPowerUsage ?? 0), 2) }}</div>
                </td>
                <td class="stat-card">
                    <div class="stat-label">Mean Node Usage (kWh)</div>
                    <div class="stat-value value-green">{{ number_format((float)($avgPowerUsage ?? 0), 2) }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Executive Summary</h2>
        <table class="summary-table">
            <tbody>
                <tr>
                    <td>Verification Efficiency</td>
                    <td class="value value-green">{{ ($totalFarmers ?? 0) > 0 ? number_format((($approvedFarmers ?? 0) / $totalFarmers) * 100, 2) : '0.00' }}%</td>
                </tr>
                <tr>
                    <td>Resolution Accuracy</td>
                    <td class="value value-blue">{{ ($totalComplaints ?? 0) > 0 ? number_format((($resolvedComplaints ?? 0) / $totalComplaints) * 100, 2) : '0.00' }}%</td>
                </tr>
                <tr>
                    <td>Total Monitored Nodes</td>
                    <td class="value">{{ $totalFarmers ?? 0 }}</td>
                </tr>
                <tr>
                    <td>System-wide Energy Flow</td>
                    <td class="value value-orange">{{ number_format((float)($totalPowerUsage ?? 0), 2) }} units</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>This report contains confidential information intended for FarmGrid Government Officials.</p>
        <p>&copy; {{ date('Y') }} FarmGrid. All rights reserved.</p>
    </div>
</body>
</html>
