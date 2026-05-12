@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.4)); }
            50% { filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.7)); }
        }
        @keyframes scan-line {
            0% { transform: translateY(-100%); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: translateY(100%); opacity: 0; }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .glass-card {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(56, 189, 248, 0.2); 
            border-radius: 24px; 
            padding: 24px; 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .glass-card:hover {
            transform: translateY(-8px);
            border-color: rgba(56, 189, 248, 0.5);
            background: rgba(20, 35, 60, 0.6);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 900;
            margin: 8px 0;
            letter-spacing: -1px;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            background: rgba(56, 189, 248, 0.1);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 16px;
            border: 1px solid rgba(56, 189, 248, 0.2);
        }

        .progress-track {
            background: rgba(2, 6, 23, 0.5);
            border-radius: 100px;
            height: 12px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(56, 189, 248, 0.1);
        }
        .progress-fill {
            background: linear-gradient(90deg, #38BDF8, #10B981);
            height: 100%;
            border-radius: 100px;
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.5);
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: scan-line 2s linear infinite;
        }

        .section-divider {
            color: #38BDF8;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 40px 0 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(56, 189, 248, 0.3), transparent);
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 40px; padding: 10px 0;">
        <!-- Header Section -->
        <div style="display: flex; align-items: center; gap: 24px;">
            <div class="pulse-glow" style="width: 64px; height: 64px; background: rgba(56, 189, 248, 0.1); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                📈
            </div>
            <div>
                <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                    System <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Analytics</span>
                </h2>
                <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 4px;">Monitor grid performance, farmer statistics, and network usage insights.</p>
            </div>
        </div>

        <!-- Farmer Statistics Section -->
        <div class="section-divider">
            👨‍🌾 Farmer Ecosystem
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px;">
            <div class="glass-card float-animation">
                <div class="icon-box" style="color: #38BDF8;">📊</div>
                <div class="stat-label">Total Registered</div>
                <div class="stat-value">{{ number_format($totalFarmers ?? 0) }}</div>
                <div style="color: #38BDF8; font-size: 0.75rem; font-weight: 700;">Global Network Base</div>
            </div>

            <div class="glass-card float-animation" style="animation-delay: 1s;">
                <div class="icon-box" style="color: #10B981;">✅</div>
                <div class="stat-label">Approved Grid Base</div>
                <div class="stat-value" style="background: linear-gradient(135deg, #fff 0%, #10B981 100%); -webkit-background-clip: text;">{{ number_format($approvedFarmers ?? 0) }}</div>
                <div style="color: #10B981; font-size: 0.75rem; font-weight: 700;">Active Connections</div>
            </div>

            <div class="glass-card float-animation" style="animation-delay: 2s;">
                <div class="icon-box" style="color: #F59E0B;">⏳</div>
                @php $pending = ($totalFarmers ?? 0) - ($approvedFarmers ?? 0); @endphp
                <div class="stat-label">Pending / Rejected</div>
                <div class="stat-value" style="background: linear-gradient(135deg, #fff 0%, #F59E0B 100%); -webkit-background-clip: text;">{{ number_format($pending) }}</div>
                <div style="color: #F59E0B; font-size: 0.75rem; font-weight: 700;">Awaiting Protocol</div>
            </div>

            <div class="glass-card float-animation" style="animation-delay: 3s;">
                <div class="icon-box" style="color: #8B5CF6;">📈</div>
                @php $approvalRate = ($totalFarmers ?? 0) > 0 ? round((($approvedFarmers ?? 0) / ($totalFarmers ?? 1)) * 100) : 0; @endphp
                <div class="stat-label">Approval Velocity</div>
                <div class="stat-value" style="background: linear-gradient(135deg, #fff 0%, #8B5CF6 100%); -webkit-background-clip: text;">{{ $approvalRate }}%</div>
                <div style="color: #8B5CF6; font-size: 0.75rem; font-weight: 700;">Network Growth Rate</div>
            </div>
        </div>

        <!-- Complaint Statistics Section -->
        <div class="section-divider">
            🔧 Network Integrity
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div class="glass-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <div class="stat-label">Total Complaints</div>
                        <div class="stat-value">{{ number_format($totalComplaints ?? 0) }}</div>
                    </div>
                    <div class="icon-box">🔧</div>
                </div>
                <div style="margin-top: 24px;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.75rem; margin-bottom: 8px;">
                        <span style="color: #94a3b8; font-weight: 700; text-transform: uppercase;">Resolution Efficiency</span>
                        @php $resolutionRate = ($totalComplaints ?? 0) > 0 ? round((($resolvedComplaints ?? 0) / $totalComplaints) * 100) : 0; @endphp
                        <span style="color: #10B981; font-weight: 900;">{{ $resolutionRate }}%</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $resolutionRate }}%"></div>
                    </div>
                </div>
            </div>

            <div class="glass-card">
                <div style="display: flex; gap: 20px; align-items: center;">
                    <div class="icon-box" style="color: #10B981; margin: 0;">🛡️</div>
                    <div>
                        <div class="stat-label">Resolved Issues</div>
                        <div class="stat-value" style="font-size: 1.8rem; margin: 4px 0;">{{ number_format($resolvedComplaints ?? 0) }}</div>
                    </div>
                </div>
                <p style="color: #64748b; font-size: 0.8rem; margin-top: 16px; font-weight: 600;">System stability maintained through active intervention.</p>
            </div>

            <div class="glass-card">
                <div style="display: flex; gap: 20px; align-items: center;">
                    <div class="icon-box" style="color: #F59E0B; margin: 0;">⚡</div>
                    @php $pendingComplaints = ($totalComplaints ?? 0) - ($resolvedComplaints ?? 0); @endphp
                    <div>
                        <div class="stat-label">Active Tickets</div>
                        <div class="stat-value" style="font-size: 1.8rem; margin: 4px 0;">{{ number_format($pendingComplaints) }}</div>
                    </div>
                </div>
                <p style="color: #64748b; font-size: 0.8rem; margin-top: 16px; font-weight: 600;">Maintenance teams assigned to high-priority zones.</p>
            </div>
        </div>

        <!-- Power Usage Section -->
        <div class="section-divider">
            ⚡ Consumption Analytics
        </div>
        <div class="glass-card" style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px; align-items: center; padding: 40px;">
            <div style="text-align: center; border-right: 1px solid rgba(56, 189, 248, 0.1); padding-right: 40px;">
                <div class="icon-box pulse-glow" style="margin: 0 auto 24px; width: 80px; height: 80px; font-size: 2.5rem; background: rgba(56, 189, 248, 0.05);">
                    📉
                </div>
                <div class="stat-label">Total Data Points</div>
                <div class="stat-value" style="font-size: 3.5rem; margin: 12px 0;">{{ number_format($totalUsageRecords ?? 0) }}</div>
                <div style="color: #38BDF8; font-size: 0.8rem; font-weight: 800; text-transform: uppercase;">Metering Records Logged</div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 24px;">
                <div>
                    <h4 style="color: #f1f5f9; font-size: 1.4rem; font-weight: 800; margin-bottom: 12px;">Smart-Grid Monitoring</h4>
                    <p style="color: #94a3b8; font-size: 1.1rem; line-height: 1.6;">
                        Usage records represent historical consumption data processed for all approved connections. These data points drive the automated billing and regional load-balancing algorithms.
                    </p>
                </div>
                <div style="display: flex; gap: 16px;">
                    <div style="flex: 1; padding: 20px; background: rgba(56, 189, 248, 0.05); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.1);">
                        <div style="color: #38BDF8; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Update Frequency</div>
                        <div style="color: #f1f5f9; font-weight: 800;">Monthly Billing Cycle</div>
                    </div>
                    <div style="flex: 1; padding: 20px; background: rgba(16, 185, 129, 0.05); border-radius: 20px; border: 1px solid rgba(16, 185, 129, 0.1);">
                        <div style="color: #10B981; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; margin-bottom: 8px;">Network Health</div>
                        <div style="color: #f1f5f9; font-weight: 800;">Stable Distribution</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status Note -->
        <div style="max-width: 800px; margin: 20px auto 0; padding: 24px; background: rgba(56, 189, 248, 0.03); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 24px; display: flex; align-items: center; gap: 20px;">
            <div class="pulse-glow" style="font-size: 2rem;">🛡️</div>
            <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin: 0;">
                <strong style="color: #38BDF8;">Security Insight:</strong> Analytics are computed in real-time from the primary grid database. Automated connection audits are performed daily to ensure 100% telemetry accuracy across all distribution zones.
            </p>
        </div>
    </div>
@endsection
