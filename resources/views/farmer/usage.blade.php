@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.4)); }
            50% { filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.7)); }
        }
        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .glass-container {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(56, 189, 248, 0.25); 
            border-radius: 32px; 
            padding: 40px; 
            box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);
        }

        .analytics-card {
            background: rgba(15, 23, 42, 0.5) !important;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 28px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .analytics-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(56, 189, 248, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(56, 189, 248, 0.2);
        }

        .usage-table th {
            padding: 20px 16px; 
            text-align: left; 
            color: #94a3b8; 
            font-size: 0.85rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 1px;
        }

        .usage-table td {
            padding: 24px 16px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.05);
            font-size: 0.95rem;
        }

        .usage-row {
            transition: all 0.3s ease;
        }
        .usage-row:hover {
            background: rgba(56, 189, 248, 0.04);
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-width: 1px;
            border-style: solid;
        }

        .status-paid {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.1);
        }

        .status-unpaid {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.1);
        }

        .stat-glow {
            text-shadow: 0 0 15px currentColor;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 40px; padding: 10px 0;">
        <!-- Header Hero Section -->
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div class="pulse-glow" style="width: 72px; height: 72px; background: rgba(56, 189, 248, 0.1); border-radius: 24px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                    ⚡
                </div>
                <div>
                    <h2 style="font-size: 2.8rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                        Power Usage <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">& Billing</span>
                    </h2>
                    <p style="color: #94a3b8; font-size: 1.2rem; margin-top: 4px; font-weight: 500;">Real-time energy consumption analytics and billing oversight.</p>
                </div>
            </div>
        </div>

        <!-- Analytics Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Current Month Usage -->
            <div class="analytics-card p-8 relative overflow-hidden group">
                <div class="absolute inset-0 opacity-5 pointer-events-none">
                    <div class="w-full h-[1px] bg-sky-400 absolute animate-[scan_5s_linear_infinite]"></div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                    <div style="width: 48px; height: 48px; background: rgba(56, 189, 248, 0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📊</div>
                    <span style="color: #10B981; font-size: 0.75rem; font-weight: 800; background: rgba(16, 185, 129, 0.1); padding: 4px 10px; border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.2);">LIVE</span>
                </div>
                <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Current Month Usage</h3>
                <p class="stat-glow" style="font-size: 2.8rem; font-weight: 900; color: #38BDF8; margin: 0;">
                    {{ count($usages) > 0 ? $usages->first()->units : '--' }} <span style="font-size: 1.2rem; font-weight: 600; color: #64748b;">kWh</span>
                </p>
            </div>

            <!-- Current Bill Amount -->
            <div class="analytics-card p-8 relative overflow-hidden group">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                    <div style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">💳</div>
                    <span style="color: #38BDF8; font-size: 0.75rem; font-weight: 800; background: rgba(56, 189, 248, 0.1); padding: 4px 10px; border-radius: 8px; border: 1px solid rgba(56, 189, 248, 0.2);">UNPAID</span>
                </div>
                <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Current Bill Amount</h3>
                <p class="stat-glow" style="font-size: 2.8rem; font-weight: 900; color: #10B981; margin: 0;">
                    <span style="font-size: 1.5rem; vertical-align: middle;">₹</span>{{ count($usages) > 0 ? $usages->first()->amount : '--' }}
                </p>
            </div>

            <!-- Last Payment -->
            <div class="analytics-card p-8 relative overflow-hidden group">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                    <div style="width: 48px; height: 48px; background: rgba(245, 158, 11, 0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📅</div>
                </div>
                <h3 style="color: #94a3b8; font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Last Payment Status</h3>
                <p class="stat-glow" style="font-size: 1.8rem; font-weight: 900; color: #F59E0B; margin: 0; line-height: 1.2;">
                    {{ count($usages) > 1 ? ucfirst($usages->skip(1)->first()->status) : 'No History' }}
                </p>
                <span style="color: #64748b; font-size: 0.85rem; font-weight: 600; display: block; margin-top: 4px;">Verified on Cloud Sync</span>
            </div>
        </div>

        <!-- Main Usage History Table Container -->
        <div class="glass-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h3 style="font-size: 1.5rem; font-weight: 800; color: #f1f5f9; display: flex; align-items: center; gap: 12px;">
                    <span style="color: #38BDF8;">📊</span> Consumption History
                </h3>
                <div style="padding: 6px 16px; background: rgba(255,255,255,0.03); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); color: #94a3b8; font-size: 0.8rem; font-weight: 700;">
                    Last 12 Months
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="usage-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th>Billing Month</th>
                            <th>Units Consumed</th>
                            <th>Bill Amount</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usages as $usage)
                            <tr class="usage-row">
                                <td style="font-weight: 700; color: #f1f5f9;">{{ $usage->month }}</td>
                                <td style="color: #38BDF8; font-weight: 800;">{{ $usage->units }} <span style="font-size: 0.75rem; color: #64748b;">kWh</span></td>
                                <td style="color: #10B981; font-weight: 800;">₹{{ $usage->amount }}</td>
                                <td>
                                    @php
                                        $statusClass = $usage->status === 'paid' ? 'status-paid' : 'status-unpaid';
                                    @endphp
                                    <div class="status-badge {{ $statusClass }}">
                                        <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%; box-shadow: 0 0 10px currentColor;"></span>
                                        {{ ucfirst($usage->status) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 0;">
                                    <div style="padding: 100px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 24px;">
                                        <div class="float-animation" style="width: 120px; height: 120px; background: rgba(56, 189, 248, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(56, 189, 248, 0.1);">
                                            <span style="font-size: 4rem; filter: drop-shadow(0 0 20px rgba(56, 189, 248, 0.4));">📑</span>
                                        </div>
                                        <div>
                                            <h3 style="color: #f1f5f9; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px;">No usage data available</h3>
                                            <p style="color: #64748b; font-size: 1.1rem; max-width: 450px; margin: 0 auto; line-height: 1.6;">
                                                Your electricity consumption records will be generated automatically at the end of the billing cycle.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Energy Efficiency Tip -->
        <div style="padding: 24px; background: rgba(56, 189, 248, 0.03); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="font-size: 2rem;">💡</div>
            <div>
                <p style="color: #f1f5f9; font-size: 0.95rem; font-weight: 700; margin-bottom: 4px;">Energy Optimization Protocol</p>
                <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.5; margin: 0;">
                    Monitoring your <strong style="color: #38BDF8;">Consumption History</strong> helps in identifying peak usage times. Try shifting heavy agricultural loads to off-peak hours as specified in your <a href="{{ route('farmer.schedules') }}" style="color: #38BDF8; text-decoration: underline;">Schedule</a> to optimize grid stability.
                </p>
            </div>
        </div>
    </div>
@endsection