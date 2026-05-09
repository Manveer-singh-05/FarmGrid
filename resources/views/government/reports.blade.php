@extends('layouts.main')

@section('main-content')
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #f1f5f9;">📈 Analytics & <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Reports</span></h2>
        </div>

        <!-- Farmer Statistics -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <span style="background: rgba(56, 189, 248, 0.1); padding: 8px; border-radius: 12px;">👨‍🌾</span>
                Farmer Statistics
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Total Farmers</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #38BDF8; margin-top: 8px;">{{ $totalFarmers }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Approved</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #10B981; margin-top: 8px;">{{ $approvedFarmers }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Pending</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #F59E0B; margin-top: 8px;">{{ $pendingFarmers }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Rejected</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #EF4444; margin-top: 8px;">{{ $rejectedFarmers }}</p>
                </div>
            </div>
        </div>

        <!-- Complaint Statistics -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <span style="background: rgba(239, 68, 68, 0.1); padding: 8px; border-radius: 12px;">🔧</span>
                Complaint Statistics
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Total Complaints</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #EF4444; margin-top: 8px;">{{ $totalComplaints }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Pending</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #F59E0B; margin-top: 8px;">{{ $pendingComplaints }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Resolved</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #10B981; margin-top: 8px;">{{ $resolvedComplaints }}</p>
                </div>
            </div>
        </div>

        <!-- Power Usage Statistics -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                <span style="background: rgba(245, 158, 11, 0.1); padding: 8px; border-radius: 12px;">⚡</span>
                Power Usage Statistics
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Total Usage (Units)</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #F59E0B; margin-top: 8px;">{{ number_format($totalPowerUsage, 2) }}</p>
                </div>
                <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); padding: 24px; border-radius: 20px;">
                    <p style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Average Usage (Units)</p>
                    <p style="font-size: 2rem; font-weight: 800; color: #10B981; margin-top: 8px;">{{ number_format($avgPowerUsage, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Summary Report -->
        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px;">📝 Summary Report</h3>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1;">Farmer Approval Rate</span>
                    <span style="color: #10B981; font-weight: 700;">{{ $totalFarmers > 0 ? number_format(($approvedFarmers / $totalFarmers) * 100, 2) : 0 }}%</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1;">Complaint Resolution Rate</span>
                    <span style="color: #38BDF8; font-weight: 700;">{{ $totalComplaints > 0 ? number_format(($resolvedComplaints / $totalComplaints) * 100, 2) : 0 }}%</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1;">Total Farmers Under Monitoring</span>
                    <span style="color: #f1f5f9; font-weight: 700;">{{ $totalFarmers }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 16px; background: rgba(255,255,255,0.02); border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <span style="color: #cbd5e1;">Total Power Consumption</span>
                    <span style="color: #F59E0B; font-weight: 700;">{{ number_format($totalPowerUsage, 2) }} units</span>
                </div>
            </div>
            <button style="margin-top: 32px; width: 100%; padding: 16px; background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); border: none; border-radius: 16px; color: white; font-weight: 700; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(56, 189, 248, 0.2);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 15px 25px rgba(56, 189, 248, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.2)'">
                📥 Download Detailed State Report (PDF)
            </button>
        </div>
    </div>
@endsection