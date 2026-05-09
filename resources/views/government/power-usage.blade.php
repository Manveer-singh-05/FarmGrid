@extends('layouts.main')

@section('main-content')
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #f1f5f9;">⚡ Power Usage <span style="background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Reports</span></h2>
        </div>

        <!-- Summary Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(245, 158, 11, 0.1);">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase;">Total Usage</h3>
                <p style="font-size: 2rem; font-weight: 800; color: #F59E0B;">{{ number_format($totalUsage, 2) }} <span style="font-size: 1rem; color: #94a3b8;">Units</span></p>
            </div>
            <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 28px; box-shadow: 0 0 20px rgba(16, 185, 129, 0.1);">
                <h3 style="color: #94a3b8; font-size: 0.85rem; font-weight: 600; margin-bottom: 12px; text-transform: uppercase;">Average Usage</h3>
                <p style="font-size: 2rem; font-weight: 800; color: #10B981;">{{ number_format($avgUsage, 2) }} <span style="font-size: 1rem; color: #94a3b8;">Units</span></p>
            </div>
        </div>

        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Farmer</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Units Used</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Meter Reading</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($powerUsage as $usage)
                            <tr style="transition: background 0.3s ease;" onmouseover="this.style.background='rgba(245, 158, 11, 0.05)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 16px; color: #f1f5f9; font-weight: 600; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $usage->farmer->user->name ?? 'N/A' }}</td>
                                <td style="padding: 16px; color: #F59E0B; font-weight: 700; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $usage->units_used }}</td>
                                <td style="padding: 16px; color: #cbd5e1; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $usage->meter_reading }} kWh</td>
                                <td style="padding: 16px; color: #94a3b8; font-size: 0.85rem; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $usage->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="padding: 32px; text-align: center; color: #94a3b8; font-style: italic;">No power usage records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div style="margin-top: 24px; padding: 16px; border-top: 1px solid rgba(56, 189, 248, 0.1);">
                {{ $powerUsage->links() }}
            </div>
        </div>
    </div>
@endsection