@extends('layouts.main')

@section('main-content')
    <div style="display: flex; flex-direction: column; gap: 28px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 2rem; font-weight: 800; color: #f1f5f9;">👨‍🌾 Farmers <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Information</span></h2>
        </div>

        <div style="background: rgba(20, 35, 60, 0.4); backdrop-filter: blur(20px); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 24px; padding: 32px; box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Name</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Contact</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Land Area</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Crop Type</th>
                            <th style="padding: 16px; text-align: left; color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid rgba(56, 189, 248, 0.1);">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($farmers as $farmer)
                            <tr style="transition: background 0.3s ease;" onmouseover="this.style.background='rgba(56, 189, 248, 0.05)'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 16px; color: #f1f5f9; font-weight: 600; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $farmer->user?->name ?? 'N/A' }}</td>
                                <td style="padding: 16px; color: #cbd5e1; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $farmer->user?->email ?? 'N/A' }}</td>
                                <td style="padding: 16px; color: #cbd5e1; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $farmer->land_area ?? 'N/A' }} acres</td>
                                <td style="padding: 16px; color: #cbd5e1; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">{{ $farmer->crop_type ?? 'N/A' }}</td>
                                <td style="padding: 16px; border-bottom: 1px solid rgba(56, 189, 248, 0.05);">
                                    @php
                                        $statusColor = $farmer->status === 'approved' ? '#10B981' : ($farmer->status === 'pending' ? '#F59E0B' : '#EF4444');
                                        $statusBg = $farmer->status === 'approved' ? 'rgba(16, 185, 129, 0.1)' : ($farmer->status === 'pending' ? 'rgba(245, 158, 11, 0.1)' : 'rgba(239, 68, 68, 0.1)');
                                    @endphp
                                    <span style="background: {{ $statusBg }}; color: {{ $statusColor }}; padding: 6px 12px; border-radius: 100px; font-size: 0.75rem; font-weight: 700; border: 1px solid {{ $statusColor }}40; text-transform: uppercase; letter-spacing: 0.5px;">
                                        {{ ucfirst($farmer->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 32px; text-align: center; color: #94a3b8; font-style: italic;">No farmers found under monitoring.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div style="margin-top: 24px; padding: 16px; border-top: 1px solid rgba(56, 189, 248, 0.1);">
                {{ $farmers->links() }}
            </div>
        </div>
    </div>
@endsection