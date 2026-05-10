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
        @keyframes shine {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .complaint-card {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(56, 189, 248, 0.2); 
            border-radius: 24px; 
            padding: 32px; 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .complaint-card:hover {
            transform: translateY(-8px) scale(1.01);
            border-color: rgba(56, 189, 248, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            background: rgba(20, 35, 60, 0.5);
        }

        /* Status Badge System */
        .status-badge {
            padding: 6px 12px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border-width: 1px;
            border-style: solid;
        }

        .status-resolved {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.1);
        }

        .status-in-progress {
            background: rgba(56, 189, 248, 0.1);
            color: #38BDF8;
            border-color: rgba(56, 189, 248, 0.3);
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.1);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
            border-color: rgba(245, 158, 11, 0.3);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.1);
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.1);
        }

        .glass-field {
            background: rgba(2, 6, 23, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 12px;
            padding: 10px 16px;
            color: #f1f5f9;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        .glass-field:focus {
            outline: none;
            border-color: #38BDF8;
            background: rgba(56, 189, 248, 0.05);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.1);
        }

        .btn-update {
            background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(56, 189, 248, 0.2);
        }
        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(56, 189, 248, 0.4);
        }

        .issue-desc {
            background: rgba(2, 6, 23, 0.3);
            border-radius: 16px;
            padding: 16px;
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 16px 0;
            border-left: 4px solid #38BDF8;
        }

        .admin-notes {
            background: rgba(56, 189, 248, 0.05);
            border-radius: 16px;
            padding: 16px;
            margin: 16px 0;
            border: 1px dashed rgba(56, 189, 248, 0.2);
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 40px; padding: 10px 0;">
        <!-- Header Section -->
        <div style="display: flex; align-items: center; gap: 24px;">
            <div class="pulse-glow" style="width: 64px; height: 64px; background: rgba(56, 189, 248, 0.1); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                🔧
            </div>
            <div>
                <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                    Complaint <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Management</span>
                </h2>
                <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 4px;">Review, monitor, and resolve farmer electricity complaints.</p>
            </div>
        </div>

        @if (session('success'))
            <div style="padding: 16px 24px; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 16px; color: #10B981; font-weight: 600; display: flex; align-items: center; gap: 12px; backdrop-filter: blur(10px);">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <div style="display: flex; flex-direction: column; gap: 8px;">
            @forelse ($complaints as $complaint)
                <div class="complaint-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                <h3 style="color: #f1f5f9; font-size: 1.3rem; font-weight: 800; margin: 0;">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}
                                </h3>
                                @php
                                    $statusClass = 'status-pending';
                                    if($complaint->status === 'resolved') $statusClass = 'status-resolved';
                                    if($complaint->status === 'in_progress') $statusClass = 'status-in-progress';
                                    if($complaint->status === 'rejected') $statusClass = 'status-rejected';
                                @endphp
                                <div class="status-badge {{ $statusClass }}">
                                    <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%; box-shadow: 0 0 10px currentColor;"></span>
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </div>
                                @php
                                    $priorityClass = 'status-pending'; 
                                    if($complaint->priority === 'high') $priorityClass = 'status-rejected'; 
                                    if($complaint->priority === 'low') $priorityClass = 'status-resolved'; 
                                @endphp
                                <div class="status-badge {{ $priorityClass }}" style="opacity: 0.8;">
                                    {{ ucfirst($complaint->priority ?? 'medium') }}
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 12px; color: #94a3b8; font-size: 0.85rem; font-weight: 600;">
                                <span style="display: flex; align-items: center; gap: 6px;">
                                    <span style="color: #38BDF8;">👤</span> {{ $complaint->farmer->user->name ?? 'Unknown' }}
                                </span>
                                <span style="color: rgba(56, 189, 248, 0.3);">|</span>
                                <span style="display: flex; align-items: center; gap: 6px;">
                                    <span style="color: #10B981;">🏡</span> {{ $complaint->farmer->village ?? 'Default Village' }}
                                </span>
                                <span style="color: rgba(56, 189, 248, 0.3);">|</span>
                                <span style="display: flex; align-items: center; gap: 6px;">
                                    <span style="color: #F59E0B;">⏰</span> {{ $complaint->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        <span style="background: rgba(56, 189, 248, 0.1); color: #38BDF8; padding: 4px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; border: 1px solid rgba(56, 189, 248, 0.2);">
                            #{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <div class="issue-desc">
                        {{ $complaint->description }}
                    </div>

                    @if ($complaint->admin_notes)
                        <div class="admin-notes">
                            <div style="color: #38BDF8; font-size: 0.7rem; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                                <span style="width: 12px; height: 1px; background: currentColor;"></span> Admin Resolution Notes
                            </div>
                            <p style="color: #f1f5f9; font-size: 0.9rem; margin: 0; line-height: 1.5;">{{ $complaint->admin_notes }}</p>
                        </div>
                    @endif

                    @if ($complaint->status !== 'resolved' && $complaint->status !== 'rejected')
                        <form action="{{ route('admin.complaint.resolve', $complaint->id) }}" method="POST" 
                              style="margin-top: 24px; padding-top: 24px; border-top: 1px solid rgba(56, 189, 248, 0.1); display: grid; grid-template-columns: 200px 1fr auto; gap: 16px; align-items: end;">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label style="display: block; color: #64748b; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; margin-bottom: 8px;">Status Protocol</label>
                                <select name="status" class="glass-field" style="width: 100%; cursor: pointer;" required>
                                    <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                                    <option value="resolved">✅ Mark Resolved</option>
                                    <option value="rejected">❌ Reject Issue</option>
                                </select>
                            </div>

                            <div>
                                <label style="display: block; color: #64748b; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; margin-bottom: 8px;">Response Note <span style="color: #EF4444;">*</span></label>
                                <input type="text" name="admin_notes" placeholder="Provide resolution details for the farmer..." class="glass-field" style="width: 100%;" required>
                            </div>

                            <button type="submit" class="btn-update">
                                Commit Update
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="float-animation" style="padding: 80px 20px; text-align: center; background: rgba(20, 35, 60, 0.4); border-radius: 24px; border: 1px dashed rgba(56, 189, 248, 0.2); backdrop-filter: blur(25px);">
                    <div style="font-size: 4rem; margin-bottom: 20px; filter: drop-shadow(0 0 15px rgba(56, 189, 248, 0.4));">🎉</div>
                    <h3 style="color: #f1f5f9; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px;">All issues cleared</h3>
                    <p style="color: #64748b; font-size: 1.1rem; max-width: 450px; margin: 0 auto;">The grid is operating at peak efficiency. No pending farmer complaints require attention at this time.</p>
                </div>
            @endforelse
        </div>

        @if ($complaints->hasPages())
            <div style="display: flex; justify-content: center; margin-top: 20px;">
                {{ $complaints->links() }}
            </div>
        @endif
    </div>
@endsection
