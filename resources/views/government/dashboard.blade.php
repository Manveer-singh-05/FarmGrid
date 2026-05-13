@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(37, 99, 235, 0.25), 0 0 40px rgba(34, 197, 94, 0.2);
        }
        
        .hover-glow {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-glow:hover {
            border-color: rgba(56, 189, 248, 0.5);
            box-shadow: 0 0 30px rgba(56, 189, 248, 0.3);
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
        
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @media (max-width: 1024px) {
            .responsive-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .responsive-three-col {
                grid-template-columns: 1fr !important;
            }
        }
        @media (max-width: 768px) {
            .responsive-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <!-- Monitoring Hero Section -->
        <div
            style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 48px; box-shadow: 0 0 40px rgba(34, 197, 94, 0.2), 0 25px 80px rgba(37, 99, 235, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.1); position: relative; overflow: hidden;">
            <div
                style="position: absolute; top: -40%; right: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%); border-radius: 50%; filter: blur(60px); pointer-events: none;">
            </div>
            <div
                style="position: absolute; bottom: -20%; left: 5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); border-radius: 50%; filter: blur(60px); pointer-events: none;">
            </div>
            <div style="position: relative; z-index: 1;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
                    <div>
                        <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 12px;">Smart Grid <span
                                style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Monitoring Center</span></h2>
                        <p style="color: #cbd5e1; font-size: 1.2rem; margin-bottom: 32px; max-width: 800px;">National Agricultural Energy Supervisory System — State Overview.</p>
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <div class="pulse-glow" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.4); padding: 8px 16px; border-radius: 100px; color: #10B981; font-size: 0.85rem; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                            <span style="width: 8px; height: 8px; background: #10B981; border-radius: 50%;"></span>
                            SYSTEM LIVE
                        </div>
                    </div>
                </div>

                <!-- Monitoring Indicators -->
                <div style="display: flex; flex-wrap: wrap; gap: 24px; margin-top: 10px;">
                    <div style="flex: 1; min-width: 200px; background: rgba(255,255,255,0.03); border: 1px solid rgba(56, 189, 248, 0.1); border-radius: 20px; padding: 20px;">
                        <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Grid Stability</p>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <p style="font-size: 1.5rem; font-weight: 800; color: #10B981;">98.4%</p>
                            <div style="flex: 1; height: 4px; background: rgba(16, 185, 129, 0.2); border-radius: 2px;">
                                <div style="width: 98%; height: 100%; background: #10B981; border-radius: 2px;"></div>
                            </div>
                        </div>
                    </div>
                    <div style="flex: 1; min-width: 200px; background: rgba(255,255,255,0.03); border: 1px solid rgba(56, 189, 248, 0.1); border-radius: 20px; padding: 20px;">
                        <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Power Availability</p>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <p style="font-size: 1.5rem; font-weight: 800; color: #38BDF8;">92.1%</p>
                            <div style="flex: 1; height: 4px; background: rgba(56, 189, 248, 0.2); border-radius: 2px;">
                                <div style="width: 92%; height: 100%; background: #38BDF8; border-radius: 2px;"></div>
                            </div>
                        </div>
                    </div>
                    <div style="flex: 1; min-width: 200px; background: rgba(255,255,255,0.03); border: 1px solid rgba(56, 189, 248, 0.1); border-radius: 20px; padding: 20px;">
                        <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 8px;">Complaint Ratio</p>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <p style="font-size: 1.5rem; font-weight: 800; color: #F59E0B;">{{ ($totalComplaints ?? 0) > 0 ? round((($resolvedComplaints ?? 0) / $totalComplaints) * 100, 1) : 100 }}%</p>
                            <div style="flex: 1; height: 4px; background: rgba(245, 158, 11, 0.2); border-radius: 2px;">
                                @php
                                    $complaintRatio = ($totalComplaints ?? 0) > 0 ? round((($resolvedComplaints ?? 0) / $totalComplaints) * 100) : 100;
                                @endphp
                                <div style="width: {{ $complaintRatio }}%; height: 100%; background: #F59E0B; border-radius: 2px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Cards -->
        <div class="responsive-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px;">
            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(34, 197, 94, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Total Farmers</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ number_format($totalFarmers ?? 0) }}</p>
                    <span style="font-size: 1.5rem;" class="float-animation">👨‍🌾</span>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(56, 189, 248, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Active Connections</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #3B82F6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ number_format($approvedFarmers ?? 0) }}</p>
                    <span style="font-size: 1.5rem;" class="float-animation">⚡</span>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Electricity Distributed</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ number_format((float)($totalPowerUsage ?? 0)) }} <span style="font-size: 1rem;">kWh</span></p>
                    <span style="font-size: 1.5rem;" class="float-animation">🔋</span>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(239, 68, 68, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Pending Issues</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #EF4444 0%, #EC4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ ($totalComplaints ?? 0) - ($resolvedComplaints ?? 0) }}</p>
                    <span style="font-size: 1.5rem;" class="float-animation">⚠️</span>
                </div>
            </div>
        </div>

        <div class="responsive-three-col" style="display: grid; grid-template-columns: 2fr 1fr; gap: 28px;">
            <!-- Monitoring & Trends (Placeholder for Chart) -->
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9;">📈 State-wide Consumption Trends</h3>
                    <div style="display: flex; gap: 10px;">
                        <button id="btn-monthly" onclick="showTrend('monthly')" style="background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); color: #38BDF8; padding: 6px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">Monthly</button>
                        <button id="btn-daily" onclick="showTrend('daily')" style="background: transparent; border: 1px solid rgba(255,255,255,0.1); color: #94a3b8; padding: 6px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease;">Daily</button>
                    </div>
                </div>
                
                <!-- Chart Container -->
                <div id="chart-monthly" style="height: 300px; width: 100%; position: relative; display: flex; align-items: flex-end; gap: 12px; padding: 20px 0;">
                    @php
                        $safeMonthlyUsage = collect($monthlyUsage ?? []);
                        $maxTotal = $safeMonthlyUsage->max('total') ?: 100;
                    @endphp
                    @forelse($safeMonthlyUsage as $usage)
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="hover-lift" style="width: 100%; height: {{ (($usage->total ?? 0) / $maxTotal) * 100 }}%; background: linear-gradient(to top, rgba(56, 189, 248, 0.4), rgba(16, 185, 129, 0.4)); border-top: 2px solid #38BDF8; border-radius: 6px 6px 0 0;" title="{{ number_format((float)($usage->total ?? 0)) }} kWh"></div>
                            <span style="color: #64748b; font-size: 0.7rem; font-weight: 700;">{{ $usage->billing_month ?? 'N/A' }}</span>
                        </div>
                    @empty
                        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #64748b; font-style: italic;">No usage data recorded.</div>
                    @endforelse

                    <!-- Y-Axis Mockup -->
                    <div style="position: absolute; left: -20px; top: 0; bottom: 40px; display: flex; flex-direction: column; justify-content: space-between; color: #475569; font-size: 0.65rem; font-weight: 700;">
                        <span>{{ number_format($maxTotal) }}</span>
                        <span>{{ number_format($maxTotal * 0.75) }}</span>
                        <span>{{ number_format($maxTotal * 0.5) }}</span>
                        <span>{{ number_format($maxTotal * 0.25) }}</span>
                        <span>0</span>
                    </div>
                </div>

                <div id="chart-daily" style="height: 300px; width: 100%; position: relative; display: none; align-items: flex-end; gap: 8px; padding: 20px 0;">
                    @php
                        $safeDailyUsage = collect($dailyUsage ?? []);
                        $maxDailyTotal = $safeDailyUsage->max('total') ?: 100;
                    @endphp
                    @forelse($safeDailyUsage as $usage)
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="hover-lift" style="width: 100%; height: {{ (($usage->total ?? 0) / $maxDailyTotal) * 100 }}%; background: linear-gradient(to top, rgba(16, 185, 129, 0.4), rgba(56, 189, 248, 0.4)); border-top: 2px solid #10B981; border-radius: 4px 4px 0 0;" title="{{ number_format((float)($usage->total ?? 0)) }} kWh"></div>
                            <span style="color: #64748b; font-size: 0.6rem; font-weight: 700; transform: rotate(-45deg); margin-top: 10px;">{{ (isset($usage->date) && $usage->date !== 'unknown' && strlen($usage->date) > 5) ? \Carbon\Carbon::parse($usage->date)->format('M d') : 'N/A' }}</span>
                        </div>
                    @empty
                        <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #64748b; font-style: italic;">No daily data recorded.</div>
                    @endforelse

                    <!-- Y-Axis Mockup -->
                    <div style="position: absolute; left: -20px; top: 0; bottom: 40px; display: flex; flex-direction: column; justify-content: space-between; color: #475569; font-size: 0.65rem; font-weight: 700;">
                        <span>{{ number_format($maxDailyTotal) }}</span>
                        <span>{{ number_format($maxDailyTotal * 0.5) }}</span>
                        <span>0</span>
                    </div>
                </div>

                <script>
                    function showTrend(type) {
                        const monthly = document.getElementById('chart-monthly');
                        const daily = document.getElementById('chart-daily');
                        const btnMonthly = document.getElementById('btn-monthly');
                        const btnDaily = document.getElementById('btn-daily');

                        if (type === 'monthly') {
                            monthly.style.display = 'flex';
                            daily.style.display = 'none';
                            btnMonthly.style.background = 'rgba(56, 189, 248, 0.1)';
                            btnMonthly.style.borderColor = 'rgba(56, 189, 248, 0.3)';
                            btnMonthly.style.color = '#38BDF8';
                            btnDaily.style.background = 'transparent';
                            btnDaily.style.borderColor = 'rgba(255,255,255,0.1)';
                            btnDaily.style.color = '#94a3b8';
                        } else {
                            monthly.style.display = 'none';
                            daily.style.display = 'flex';
                            btnDaily.style.background = 'rgba(56, 189, 248, 0.1)';
                            btnDaily.style.borderColor = 'rgba(56, 189, 248, 0.3)';
                            btnDaily.style.color = '#38BDF8';
                            btnMonthly.style.background = 'transparent';
                            btnMonthly.style.borderColor = 'rgba(255,255,255,0.1)';
                            btnMonthly.style.color = '#94a3b8';
                        }
                    }
                </script>
            </div>

            <!-- System Alerts / Monitoring -->
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px;">🚨 Critical Alerts</h3>
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @forelse($alerts as $alert)
                        <div style="background: {{ str_replace('1)', '0.1)', $alert['color'] ?? 'rgba(56, 189, 248, 1)') }}; border: 1px solid {{ str_replace('1)', '0.3)', $alert['color'] ?? 'rgba(56, 189, 248, 1)') }}; border-radius: 16px; padding: 16px; border-left: 4px solid {{ $alert['color'] ?? '#38BDF8' }};">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                <p style="color: {{ $alert['color'] ?? '#38BDF8' }}; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">{{ $alert['title'] ?? 'Alert' }}</p>
                                <span style="color: #64748b; font-size: 0.65rem; font-weight: 600;">{{ $alert['time'] ?? 'Now' }}</span>
                            </div>
                            <p style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600;">{{ $alert['description'] ?? 'No description' }}</p>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 32px; background: rgba(255,255,255,0.03); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                            <p style="color: #94a3b8; font-size: 0.9rem; font-style: italic;">No critical alerts detected.</p>
                        </div>
                    @endforelse
                </div>
                <a href="{{ route('government.reports') }}" style="display: block; width: 100%; text-align: center; margin-top: 24px; color: #38BDF8; font-weight: 600; font-size: 0.9rem; text-decoration: none;" class="hover-glow">View Detailed Analytics →</a>
            </div>
        </div>

        <!-- Quick Monitoring Links -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px;">🏛️ Supervisory Quick Links</h3>
            <div class="responsive-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                <a href="{{ route('government.farmers') }}" class="hover-lift smooth-transition" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px; text-decoration: none;">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(56, 189, 248, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">👨‍🌾</div>
                        <div>
                            <p style="color: #f1f5f9; font-weight: 700;">Farmers Overview</p>
                            <p style="color: #94a3b8; font-size: 0.85rem;">Monitor registration & status</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('government.complaints') }}" class="hover-lift smooth-transition" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px; text-decoration: none;">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(239, 68, 68, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🔧</div>
                        <div>
                            <p style="color: #f1f5f9; font-weight: 700;">Complaints Analytics</p>
                            <p style="color: #94a3b8; font-size: 0.85rem;">Monitor issue resolution trends</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('government.reports') }}" class="hover-lift smooth-transition" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px; text-decoration: none;">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📈</div>
                        <div>
                            <p style="color: #f1f5f9; font-weight: 700;">Detailed Reports</p>
                            <p style="color: #94a3b8; font-size: 0.85rem;">Download district analytics</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection