@extends('layouts.main')

@section('main-content')
    <style>
        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.6; filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.4)); }
            50% { opacity: 1; filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.7)); }
        }
        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        @keyframes border-glow {
            0%, 100% { border-color: rgba(56, 189, 248, 0.25); }
            50% { border-color: rgba(16, 185, 129, 0.5); }
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .hover-lift:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(20, 35, 60, 0.6), 0 0 30px rgba(56, 189, 248, 0.2);
        }
        
        .hover-glow {
            transition: all 0.3s ease;
        }
        .hover-glow:hover {
            background: rgba(30, 41, 59, 0.6) !important;
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.2);
        }
        
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .stat-glow {
            text-shadow: 0 0 15px currentColor;
        }

        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -100%;
            width: 100%;
            height: 200%;
            background: linear-gradient(
                to right,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transform: rotate(30deg);
            transition: 0.8s;
            animation: shine 4s infinite;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 2.5rem; font-weight: 800; color: #f1f5f9; letter-spacing: -0.5px;">📈 Analytics & <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Reports</span></h2>
        </div>

        <!-- Farmer Statistics -->
        <div class="hover-lift" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 40px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); transition: border-color 0.3s ease;">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #f1f5f9; margin-bottom: 32px; display: flex; align-items: center; gap: 16px;">
                <span class="pulse-glow" style="background: rgba(56, 189, 248, 0.15); padding: 12px; border-radius: 16px; border: 1px solid rgba(56, 189, 248, 0.3);">👨‍🌾</span>
                Farmer Demographics
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Total Population</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #38BDF8; margin-top: 12px;">{{ $totalFarmers }}</p>
                </div>
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Verified Assets</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-top: 12px;">{{ $approvedFarmers }}</p>
                </div>
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Pending Audit</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #F59E0B; margin-top: 12px;">{{ $pendingFarmers }}</p>
                </div>
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Decommissioned</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #EF4444; margin-top: 12px;">{{ $rejectedFarmers }}</p>
                </div>
            </div>
        </div>

        <!-- Complaint Statistics -->
        <div class="hover-lift" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 40px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #f1f5f9; margin-bottom: 32px; display: flex; align-items: center; gap: 16px;">
                <span class="pulse-glow" style="background: rgba(239, 68, 68, 0.15); padding: 12px; border-radius: 16px; border: 1px solid rgba(239, 68, 68, 0.3);">🔧</span>
                Network Health & Complaints
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Total Incidents</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #EF4444; margin-top: 12px;">{{ $totalComplaints }}</p>
                </div>
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Critical Attention</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #F59E0B; margin-top: 12px;">{{ $pendingComplaints }}</p>
                </div>
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Resolved Issues</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-top: 12px;">{{ $resolvedComplaints }}</p>
                </div>
            </div>
        </div>

        <!-- Power Usage Statistics -->
        <div class="hover-lift" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 40px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #f1f5f9; margin-bottom: 32px; display: flex; align-items: center; gap: 16px;">
                <span class="pulse-glow" style="background: rgba(245, 158, 11, 0.15); padding: 12px; border-radius: 16px; border: 1px solid rgba(245, 158, 11, 0.3);">⚡</span>
                Energy Consumption Audit
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Gross Consumption (kWh)</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #F59E0B; margin-top: 12px;">{{ number_format($totalPowerUsage, 2) }}</p>
                </div>
                <div class="hover-glow" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 28px; border-radius: 24px;">
                    <p style="color: #94a3b8; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Mean Node Usage (kWh)</p>
                    <p class="stat-glow" style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-top: 12px;">{{ number_format($avgPowerUsage ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Summary Report -->
        <div class="hover-lift" style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 32px; padding: 40px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #f1f5f9; margin-bottom: 32px; display: flex; align-items: center; gap: 16px;">
                <span class="float-animation" style="background: rgba(255, 255, 255, 0.05); padding: 12px; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1);">📝</span>
                Executive Summary
            </h3>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div class="hover-glow" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; background: rgba(255,255,255,0.02); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1; font-weight: 500;">Verification Efficiency</span>
                    <span style="color: #10B981; font-weight: 800; font-size: 1.1rem; text-shadow: 0 0 10px rgba(16, 185, 129, 0.3);">{{ $totalFarmers > 0 ? number_format(($approvedFarmers / $totalFarmers) * 100, 2) : 0 }}%</span>
                </div>
                <div class="hover-glow" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; background: rgba(255,255,255,0.02); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1; font-weight: 500;">Resolution Accuracy</span>
                    <span style="color: #38BDF8; font-weight: 800; font-size: 1.1rem; text-shadow: 0 0 10px rgba(56, 189, 248, 0.3);">{{ $totalComplaints > 0 ? number_format(($resolvedComplaints / $totalComplaints) * 100, 2) : 0 }}%</span>
                </div>
                <div class="hover-glow" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; background: rgba(255,255,255,0.02); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1; font-weight: 500;">Total Monitored Nodes</span>
                    <span style="color: #f1f5f9; font-weight: 800; font-size: 1.1rem;">{{ $totalFarmers }}</span>
                </div>
                <div class="hover-glow" style="display: flex; justify-content: space-between; align-items: center; padding: 20px 24px; background: rgba(255,255,255,0.02); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1; font-weight: 500;">System-wide Energy Flow</span>
                    <span style="color: #F59E0B; font-weight: 800; font-size: 1.1rem; text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);">{{ number_format($totalPowerUsage, 2) }} units</span>
                </div>
            </div>
            
            <button class="btn-shine" style="margin-top: 40px; width: 100%; padding: 20px; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); border: none; border-radius: 20px; color: white; font-size: 1.1rem; font-weight: 800; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 15px 30px rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; gap: 12px;" onmouseover="this.style.transform='translateY(-5px) scale(1.01)'; this.style.boxShadow='0 20px 40px rgba(56, 189, 248, 0.4)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 15px 30px rgba(56, 189, 248, 0.3)'">
                <span style="font-size: 1.4rem;">📥</span> Download Executive State Report (PDF)
            </button>
        </div>
    </div>
@endsection