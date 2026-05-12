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
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(56, 189, 248, 0.25); 
            border-radius: 32px; 
            padding: 48px; 
            box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);
        }

        .analytics-card {
            background: rgba(15, 23, 42, 0.5) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(56, 189, 248, 0.2);
            border-radius: 28px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 220px;
        }
        .analytics-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: rgba(56, 189, 248, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 20px rgba(56, 189, 248, 0.2);
        }

        .usage-table th {
            padding: 24px 20px; 
            text-align: left; 
            color: #94a3b8; 
            font-size: 0.75rem; 
            font-weight: 800; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 1.5px;
        }

        .usage-table td {
            padding: 28px 20px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 1rem;
        }

        .usage-row {
            transition: all 0.3s ease;
        }
        .usage-row:hover {
            background: rgba(56, 189, 248, 0.04);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-width: 1px;
            border-style: solid;
        }

        .status-paid {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.1);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
            border-color: rgba(245, 158, 11, 0.3);
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.1);
        }

        .status-overdue {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 15px rgba(239, 68, 68, 0.1);
        }

        .stat-glow {
            text-shadow: 0 0 20px rgba(56, 189, 248, 0.3);
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 56px; padding: 12px 0;">
        
        <!-- Header Hero Section & Connection Switcher -->
        <div style="display: flex; flex-direction: column; gap: 24px; margin-bottom: 8px;">
            <div style="display: flex; flex-direction: column; md:flex-row justify-content: space-between; align-items: flex-start; md:items-center gap: 20px;">
                <div style="display: flex; align-items: center; gap: 28px;">
                    <div class="pulse-glow" style="width: 80px; height: 80px; background: rgba(56, 189, 248, 0.1); border-radius: 26px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2.8rem;">
                        ⚡
                    </div>
                    <div>
                        <h2 style="font-size: 3.2rem; font-weight: 950; color: #f1f5f9; margin: 0; letter-spacing: -1.5px; line-height: 1.1;">
                            Power Usage <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">& Billing</span>
                        </h2>
                        <p style="color: #64748b; font-size: 1.25rem; margin-top: 8px; font-weight: 500; letter-spacing: 0.2px;">Real-time energy consumption analytics for: <span style="color: #38BDF8;">{{ $farmer->connection_no ?? 'Unknown' }}</span></p>
                    </div>
                </div>

                @if(isset($connections) && $connections->count() > 1)
                    <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(56, 189, 248, 0.3); padding: 12px 24px; border-radius: 20px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px); align-self: flex-end;">
                        <span style="color: #94a3b8; font-size: 0.9rem; font-weight: 700;">SELECT CONNECTION:</span>
                        <select onchange="window.location.href='?connection_id='+this.value" 
                                style="background: transparent; color: #38BDF8; border: none; font-weight: 800; font-size: 1.1rem; cursor: pointer; outline: none;">
                            @foreach($connections as $conn)
                                <option value="{{ $conn->id }}" {{ ($farmer->id ?? null) == $conn->id ? 'selected' : '' }} style="background: #0f172a; color: #f1f5f9;">
                                    {{ $conn->connection_no ?? 'Unknown' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>

        <!-- Analytics Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Current Month Usage -->
            <div class="analytics-card p-10 relative overflow-hidden group">
                <div class="absolute inset-0 opacity-5 pointer-events-none">
                    <div class="w-full h-[1px] bg-sky-400 absolute animate-[scan_5s_linear_infinite]"></div>
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                        <div style="width: 56px; height: 56px; background: rgba(56, 189, 248, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">📊</div>
                        <span style="color: #10B981; font-size: 0.7rem; font-weight: 900; background: rgba(16, 185, 129, 0.1); padding: 6px 12px; border-radius: 10px; border: 1px solid rgba(16, 185, 129, 0.3); letter-spacing: 1px;">LIVE</span>
                    </div>
                    <h3 style="color: #64748b; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">Monthly Consumption</h3>
                    <p class="stat-glow" style="font-size: 3.2rem; font-weight: 950; color: #38BDF8; margin: 0; line-height: 1;">
                        {{ isset($usages) && count($usages) > 0 ? number_format($usages->first()->units_consumed ?? 0, 1) : '--' }} <span style="font-size: 1.4rem; font-weight: 700; color: #475569; margin-left: 4px;">kWh</span>
                    </p>
                </div>
            </div>

            <!-- Current Bill Amount -->
            <div class="analytics-card p-10 relative overflow-hidden group">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                        <div style="width: 56px; height: 56px; background: rgba(16, 185, 129, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">💳</div>
                        <span style="color: #38BDF8; font-size: 0.7rem; font-weight: 900; background: rgba(56, 189, 248, 0.1); padding: 6px 12px; border-radius: 10px; border: 1px solid rgba(56, 189, 248, 0.3); letter-spacing: 1px;">PENDING</span>
                    </div>
                    <h3 style="color: #64748b; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">Outstanding Balance</h3>
                    <p class="stat-glow" style="font-size: 3.2rem; font-weight: 950; color: #10B981; margin: 0; line-height: 1;">
                        <span style="font-size: 1.8rem; vertical-align: middle; margin-right: 2px;">₹</span>{{ isset($usages) && count($usages) > 0 ? number_format($usages->where('payment_status', '!=', 'paid')->sum('bill_amount') ?? 0, 2) : '--' }}
                    </p>
                </div>
            </div>

            <!-- Last Payment -->
            <div class="analytics-card p-10 relative overflow-hidden group">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                        <div style="width: 56px; height: 56px; background: rgba(245, 158, 11, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">📅</div>
                    </div>
                    <h3 style="color: #64748b; font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px;">Recent Status</h3>
                    <p class="stat-glow" style="font-size: 2.2rem; font-weight: 950; color: #F59E0B; margin: 0; line-height: 1.1;">
                        {{ isset($usages) && count($usages) > 0 ? ucfirst($usages->first()->payment_status ?? 'No Data') : 'No Records' }}
                    </p>
                </div>
                <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255, 255, 255, 0.05);">
                    <span style="color: #475569; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                        <span style="color: #F59E0B;">●</span> Cloud Verified
                    </span>
                </div>
            </div>
        </div>

        <!-- Main Usage History Table Container -->
        <div class="glass-container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 48px; padding-bottom: 24px; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">
                <h3 style="font-size: 1.75rem; font-weight: 900; color: #f1f5f9; display: flex; align-items: center; gap: 16px;">
                    <span style="color: #38BDF8; font-size: 2rem;">📈</span> Consumption History
                </h3>
                <div style="padding: 8px 20px; background: rgba(56, 189, 248, 0.05); border-radius: 14px; border: 1px solid rgba(56, 189, 248, 0.15); color: #38BDF8; font-size: 0.85rem; font-weight: 800; letter-spacing: 0.5px;">
                    Annual Overview
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="usage-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th>Billing Cycle</th>
                            <th>Units Metered</th>
                            <th>Invoice Amount</th>
                            <th>Settlement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usages as $usage)
                            <tr class="usage-row">
                                <td style="font-weight: 800; color: #f1f5f9;">{{ $usage->billing_month ?? 'Unknown' }}</td>
                                <td style="color: #38BDF8; font-weight: 900; font-size: 1.1rem;">{{ number_format($usage->units_consumed ?? 0, 1) }} <span style="font-size: 0.8rem; color: #475569; font-weight: 600;">kWh</span></td>
                                <td style="color: #10B981; font-weight: 900; font-size: 1.1rem;">₹{{ number_format($usage->bill_amount ?? 0, 2) }}</td>
                                <td>
                                    @php
                                        $statusVal = $usage->payment_status ?? 'pending';
                                        $statusClass = 'status-' . $statusVal;
                                    @endphp
                                    <div class="status-badge {{ $statusClass }}">
                                        <span style="width: 8px; height: 8px; background: currentColor; border-radius: 50%; box-shadow: 0 0 12px currentColor;"></span>
                                        {{ ucfirst($statusVal) }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 0;">
                                    <div style="padding: 120px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 32px;">
                                        <div class="float-animation" style="width: 140px; height: 140px; background: rgba(56, 189, 248, 0.03); border-radius: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(56, 189, 248, 0.1); transform: rotate(5deg);">
                                            <span style="font-size: 4.5rem; filter: drop-shadow(0 0 25px rgba(56, 189, 248, 0.4)); transform: rotate(-5deg);">📊</span>
                                        </div>
                                        <div>
                                            <h3 style="color: #f1f5f9; font-size: 2rem; font-weight: 950; margin-bottom: 16px; letter-spacing: -0.5px;">No Records Detected</h3>
                                            <p style="color: #64748b; font-size: 1.15rem; max-width: 500px; margin: 0 auto; line-height: 1.7; font-weight: 500;">
                                                Energy consumption analytics will synchronize automatically once the regional grid audit completes.
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
        <div style="padding: 32px; background: rgba(56, 189, 248, 0.04); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 28px; display: flex; align-items: center; gap: 28px; margin-bottom: 20px;">
            <div style="font-size: 2.5rem; filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.4));">💡</div>
            <div style="flex: 1;">
                <p style="color: #f1f5f9; font-size: 1.1rem; font-weight: 800; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">Optimization Insight</p>
                <p style="color: #64748b; font-size: 1rem; line-height: 1.6; margin: 0; font-weight: 500;">
                    Your data indicates consistent agricultural load distribution. Shifting heavy machinery operations to off-peak hours as specified in your <a href="{{ route('farmer.schedules') }}" style="color: #38BDF8; text-decoration: none; border-bottom: 1px solid rgba(56, 189, 248, 0.3); padding-bottom: 2px; transition: all 0.3s ease;">Active Schedule</a> can significantly improve regional grid stability.
                </p>
            </div>
        </div>
    </div>
@endsection