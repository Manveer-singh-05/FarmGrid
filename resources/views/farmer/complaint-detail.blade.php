@extends('layouts.main')

@section('page-title', 'Complaint Details')
@section('page-subtitle', 'Track support request status and grid response')

@section('main-content')
    <style>
        .glass-card {
            background: rgba(20, 35, 60, 0.4);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(56, 189, 248, 0.25);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);
        }

        .info-label {
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-value {
            color: #f1f5f9;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .status-pill {
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #F59E0B;
            border: 1px solid rgba(245, 158, 11, 0.4);
        }

        .status-resolved {
            background: rgba(16, 185, 129, 0.15);
            color: #10B981;
            border: 1px solid rgba(16, 185, 129, 0.4);
        }

        .btn-action {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-edit {
            background: rgba(56, 189, 248, 0.15);
            color: #38BDF8;
            border: 1px solid rgba(56, 189, 248, 0.4);
        }

        .btn-edit:hover {
            background: #38BDF8;
            color: #0f172a;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.15);
            color: #EF4444;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        .btn-delete:hover {
            background: #EF4444;
            color: white;
            transform: translateY(-2px);
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.05);
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(-4px);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .float-icon {
            animation: float 4s ease-in-out infinite;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px;">
        <!-- Breadcrumb & Actions -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('farmer.complaints') }}" class="btn-action btn-back">
                <span>←</span> Back to History
            </a>
            
            <div style="display: flex; gap: 12px;">
                @if($complaint->status === 'pending')
                    <a href="{{ route('farmer.complaint.edit', $complaint->id) }}" class="btn-action btn-edit">
                        <span>✏️</span> Edit Complaint
                    </a>
                    <form action="{{ route('farmer.complaint.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('Delete this complaint permanentely?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete">
                            <span>🗑️</span> Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Details Card -->
        <div class="glass-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; border-bottom: 1px solid rgba(56, 189, 248, 0.1); padding-bottom: 24px;">
                <div style="display: flex; gap: 24px; align-items: center;">
                    <div class="float-icon" style="width: 64px; height: 64px; background: rgba(56, 189, 248, 0.1); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                        📋
                    </div>
                    <div>
                        <p class="info-label" style="margin-bottom: 4px;">Complaint ID: #{{ $complaint->id }}</p>
                        <h2 style="font-size: 2rem; font-weight: 800; color: #f1f5f9; margin: 0;">{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</h2>
                    </div>
                </div>
                <div class="status-pill {{ $complaint->status === 'resolved' ? 'status-resolved' : 'status-pending' }}">
                    <span style="width: 8px; height: 8px; background: currentColor; border-radius: 50%; box-shadow: 0 0 10px currentColor;"></span>
                    {{ ucfirst($complaint->status) }}
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 32px; margin-bottom: 40px;">
                <div>
                    <p class="info-label">Submission Date</p>
                    <p class="info-value">📅 {{ $complaint->created_at->format('M d, Y') }}</p>
                    <p style="color: #64748b; font-size: 0.85rem; margin-top: 4px;">{{ $complaint->created_at->format('H:i A') }}</p>
                </div>
                <div>
                    <p class="info-label">Urgency Level</p>
                    @php
                        $priorityColor = $complaint->priority === 'high' ? '#EF4444' : ($complaint->priority === 'low' ? '#10B981' : '#F59E0B');
                    @endphp
                    <p class="info-value" style="color: {{ $priorityColor }};">
                        {{ $complaint->priority === 'high' ? '🚨' : ($complaint->priority === 'low' ? '✅' : '⏳') }} 
                        {{ ucfirst($complaint->priority ?? 'medium') }}
                    </p>
                </div>
                <div>
                    <p class="info-label">Grid Location</p>
                    <p class="info-value">📍 {{ $complaint->farmer->village ?? 'Assigned Grid' }}</p>
                </div>
                <div>
                    <p class="info-label">Connection No</p>
                    <p class="info-value">⚡ {{ $complaint->farmer->connection_no ?? 'N/A' }}</p>
                </div>
            </div>

            <div style="margin-bottom: 40px;">
                <p class="info-label">Detailed Description</p>
                <div style="background: rgba(2, 6, 23, 0.3); border: 1px solid rgba(56, 189, 248, 0.1); border-radius: 16px; padding: 24px; color: #cbd5e1; line-height: 1.6; font-size: 1.05rem;">
                    {{ $complaint->description }}
                </div>
            </div>

            @if($complaint->admin_notes)
                <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(56, 189, 248, 0.1) 100%); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 20px; padding: 28px; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -10px; right: -10px; font-size: 4rem; opacity: 0.1;">💬</div>
                    <p class="info-label" style="color: #10B981;">Regional Grid Response</p>
                    <p style="color: #f1f5f9; font-size: 1.1rem; line-height: 1.6; margin: 0; font-style: italic;">
                        "{{ $complaint->admin_notes }}"
                    </p>
                    <div style="margin-top: 16px; display: flex; align-items: center; gap: 10px;">
                        <span style="color: #94a3b8; font-size: 0.85rem;">Status updated on: {{ $complaint->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            @else
                <div style="background: rgba(245, 158, 11, 0.05); border: 1px dashed rgba(245, 158, 11, 0.3); border-radius: 20px; padding: 24px; display: flex; align-items: center; gap: 16px;">
                    <span style="font-size: 1.5rem;">⏳</span>
                    <p style="color: #94a3b8; font-size: 0.95rem; margin: 0;">
                        This complaint is currently <strong style="color: #F59E0B;">Under Review</strong>. A regional grid controller will evaluate your request and provide a response shortly.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection