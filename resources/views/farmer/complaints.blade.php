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
            animation: shine 4s infinite;
        }

        .glass-container {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(56, 189, 248, 0.25); 
            border-radius: 32px; 
            padding: 40px; 
            box-shadow: 0 25px 80px rgba(37, 99, 235, 0.1);
        }

        .complaint-table th {
            padding: 20px 16px; 
            text-align: left; 
            color: #94a3b8; 
            font-size: 0.85rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.1);
            letter-spacing: 1px;
        }

        .complaint-table td {
            padding: 24px 16px; 
            color: #f1f5f9; 
            border-bottom: 1px solid rgba(56, 189, 248, 0.05);
            font-size: 0.95rem;
        }

        .complaint-row {
            transition: all 0.3s ease;
        }
        .complaint-row:hover {
            background: rgba(56, 189, 248, 0.04);
            transform: scale(1.002);
        }

        /* Status Badge System */
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

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
            border-color: rgba(245, 158, 11, 0.3);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.1);
        }

        .status-resolved {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.1);
        }

        .status-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.1);
        }

        .action-btn {
            background: rgba(56, 189, 248, 0.1);
            color: #38BDF8;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            border: 1px solid rgba(56, 189, 248, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .action-btn:hover {
            background: #38BDF8;
            color: #0f172a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 189, 248, 0.3);
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 32px; padding: 10px 0;">
        <!-- Header Section -->
        <div style="display: flex; flex-direction: column; sm:flex-row justify-content: space-between; align-items: flex-start; sm:items-center gap: 6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div class="pulse-glow" style="width: 64px; height: 64px; background: rgba(56, 189, 248, 0.1); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    🔧
                </div>
                <div>
                    <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                        Complaint <span style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Management</span>
                    </h2>
                    <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 4px;">Track and manage your agricultural electricity support requests.</p>
                </div>
            </div>

            <a href="{{ route('farmer.complaint.create') }}" 
               class="btn-shine"
               style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); color: white; padding: 16px 32px; border-radius: 16px; font-weight: 800; text-decoration: none; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 20px rgba(56, 189, 248, 0.2); transition: all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-4px) scale(1.02)'; this.style.boxShadow='0 15px 30px rgba(56, 189, 248, 0.4)'"
               onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.2)'">
                <span style="font-size: 1.2rem;">+</span> New Complaint
            </a>
        </div>

        <!-- Main Content Glass Card -->
        <div class="glass-container">
            <div style="overflow-x: auto;">
                <table class="complaint-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr>
                            <th>Submission Date</th>
                            <th>Service Category</th>
                            <th>Urgency</th>
                            <th>Summary</th>
                            <th>Current Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr class="complaint-row">
                                <td style="color: #94a3b8; font-weight: 500;">
                                    {{ $complaint->created_at->format('M d, Y') }}
                                </td>
                                <td style="font-weight: 700; color: #38BDF8;">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}
                                </td>
                                <td>
                                    @php
                                        $priorityClass = 'status-pending'; // default gold
                                        if($complaint->priority === 'high') $priorityClass = 'status-rejected'; // red
                                        if($complaint->priority === 'low') $priorityClass = 'status-resolved'; // green
                                    @endphp
                                    <div class="status-badge {{ $priorityClass }}" style="font-size: 0.65rem; padding: 4px 10px;">
                                        {{ ucfirst($complaint->priority ?? 'medium') }}
                                    </div>
                                </td>
                                <td style="color: #f1f5f9; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $complaint->description }}
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'status-pending';
                                        if($complaint->status === 'resolved') $statusClass = 'status-resolved';
                                        if($complaint->status === 'rejected') $statusClass = 'status-rejected';
                                    @endphp
                                    <div class="status-badge {{ $statusClass }}">
                                        <span style="width: 6px; height: 6px; background: currentColor; border-radius: 50%; box-shadow: 0 0 10px currentColor;"></span>
                                        {{ ucfirst($complaint->status) }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('farmer.complaint.show', $complaint->id) }}" class="action-btn">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 0;">
                                    <div style="padding: 100px 20px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 24px;">
                                        <div class="float-animation" style="width: 120px; height: 120px; background: rgba(56, 189, 248, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(56, 189, 248, 0.1);">
                                            <span style="font-size: 4rem; filter: drop-shadow(0 0 20px rgba(56, 189, 248, 0.4));">🛡️</span>
                                        </div>
                                        <div>
                                            <h3 style="color: #f1f5f9; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px;">No complaints submitted</h3>
                                            <p style="color: #64748b; font-size: 1.1rem; max-width: 450px; margin: 0 auto; line-height: 1.6;">
                                                You haven't filed any support requests yet. If you're experiencing any grid issues, use the button above to notify the regional grid controller.
                                            </p>
                                        </div>
                                        <a href="{{ route('farmer.complaint.create') }}" 
                                           style="margin-top: 10px; color: #38BDF8; font-weight: 700; text-decoration: none; font-size: 0.9rem; border-bottom: 2px solid rgba(56, 189, 248, 0.3); padding-bottom: 4px; transition: all 0.3s ease;"
                                           onmouseover="this.style.borderColor='#38BDF8'; this.style.letterSpacing='1px'"
                                           onmouseout="this.style.borderColor='rgba(56, 189, 248, 0.3)'; this.style.letterSpacing='0'">
                                            Submit your first request
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- System Message Card -->
        <div style="padding: 24px; background: rgba(245, 158, 11, 0.03); border: 1px dashed rgba(245, 158, 11, 0.2); border-radius: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="font-size: 2rem;">💡</div>
            <div>
                <p style="color: #f1f5f9; font-size: 0.95rem; font-weight: 700; margin-bottom: 4px;">Smart Grid Support Protocol</p>
                <p style="color: #94a3b8; font-size: 0.85rem; line-height: 1.5; margin: 0;">
                    Complaints are automatically routed to the nearest regional grid controller. Response times are typically under <strong style="color: #F59E0B;">24 hours</strong>. For urgent electrical hazards, please use the emergency contact on your regional board.
                </p>
            </div>
        </div>
    </div>
@endsection