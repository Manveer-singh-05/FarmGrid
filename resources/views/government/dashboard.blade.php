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
                            <p style="font-size: 1.5rem; font-weight: 800; color: #F59E0B;">{{ $totalComplaints > 0 ? round(($resolvedComplaints / $totalComplaints) * 100, 1) : 100 }}%</p>
                            <div style="flex: 1; height: 4px; background: rgba(245, 158, 11, 0.2); border-radius: 2px;">
                                <div style="width: {{ $totalComplaints > 0 ? round(($resolvedComplaints / $totalComplaints) * 100) : 100 }}%; height: 100%; background: #F59E0B; border-radius: 2px;"></div>
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
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ number_format($totalFarmers) }}</p>
                    <span style="font-size: 1.5rem;" class="float-animation">👨‍🌾</span>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(56, 189, 248, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Active Connections</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #38BDF8 0%, #3B82F6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ number_format($approvedFarmers) }}</p>
                    <span style="font-size: 1.5rem;" class="float-animation">⚡</span>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Electricity Distributed</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ number_format($totalPowerUsage) }} <span style="font-size: 1rem;">kWh</span></p>
                    <span style="font-size: 1.5rem;" class="float-animation">🔋</span>
                </div>
            </div>

            <div class="hover-lift hover-glow smooth-transition" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(239, 68, 68, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.05); cursor: pointer;">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Pending Issues</h3>
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <p style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #EF4444 0%, #EC4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">{{ $totalComplaints - $resolvedComplaints }}</p>
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
                        <button style="background: rgba(56, 189, 248, 0.1); border: 1px solid rgba(56, 189, 248, 0.3); color: #38BDF8; padding: 6px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 600;">Monthly</button>
                        <button style="background: transparent; border: 1px solid rgba(255,255,255,0.1); color: #94a3b8; padding: 6px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 600;">Daily</button>
                    </div>
                </div>
                
                <!-- Chart Mockup -->
                <div style="height: 300px; width: 100%; position: relative; display: flex; align-items: flex-end; gap: 12px; padding: 20px 0;">
                    @php
                        $data = [45, 62, 58, 75, 90, 82, 95, 88, 70, 85, 92, 78];
                        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    @endphp
                    @foreach($data as $index => $val)
                        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                            <div class="hover-lift" style="width: 100%; height: {{ $val }}%; background: linear-gradient(to top, rgba(56, 189, 248, 0.4), rgba(16, 185, 129, 0.4)); border-top: 2px solid #38BDF8; border-radius: 6px 6px 0 0;"></div>
                            <span style="color: #64748b; font-size: 0.7rem; font-weight: 700;">{{ $months[$index] }}</span>
                        </div>
                    @endforeach
                    
                    <!-- Y-Axis Mockup -->
                    <div style="position: absolute; left: -20px; top: 0; bottom: 40px; display: flex; flex-direction: column; justify-content: space-between; color: #475569; font-size: 0.65rem; font-weight: 700;">
                        <span>100%</span>
                        <span>75%</span>
                        <span>50%</span>
                        <span>25%</span>
                        <span>0%</span>
                    </div>
                </div>
            </div>

            <!-- System Alerts / Monitoring -->
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px;">🚨 Critical Alerts</h3>
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 16px; padding: 16px; border-left: 4px solid #EF4444;">
                        <p style="color: #fca5a5; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Voltage Drop</p>
                        <p style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600; margin-top: 4px;">North District Sector 4 reported low voltage (180V).</p>
                    </div>
                    <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 16px; padding: 16px; border-left: 4px solid #F59E0B;">
                        <p style="color: #fde68a; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Demand Spike</p>
                        <p style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600; margin-top: 4px;">15% increase in irrigation demand in Southern Zone.</p>
                    </div>
                    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 16px; padding: 16px; border-left: 4px solid #10B981;">
                        <p style="color: #a7f3d0; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Resolution Sync</p>
                        <p style="color: #f1f5f9; font-size: 0.9rem; font-weight: 600; margin-top: 4px;">Complaints resolved in last 24h: 42 Issues.</p>
                    </div>
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