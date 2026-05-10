@extends('layouts.main')

@section('page-title', 'Edit Complaint')
@section('page-subtitle', 'Modify your existing support request details')

@section('main-content')
    <style>
        .glass-panel {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(56, 189, 248, 0.2); 
            border-radius: 32px; 
            padding: 48px; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .form-label {
            display: block;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            margin-left: 4px;
        }

        .glass-field {
            background: rgba(2, 6, 23, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.15);
            border-radius: 16px;
            padding: 14px 20px;
            color: #f1f5f9;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1rem;
        }
        .glass-field:focus {
            outline: none;
            border-color: #38BDF8;
            background: rgba(56, 189, 248, 0.05);
            box-shadow: 0 0 20px rgba(56, 189, 248, 0.15);
            transform: scale(1.02);
        }

        .btn-submit {
            background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%);
            color: white;
            border: none;
            padding: 16px 40px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(56, 189, 248, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .btn-submit:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 35px rgba(56, 189, 248, 0.5);
        }

        .btn-cancel {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: 700;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            transform: translateY(-2px);
        }

        select option {
            background-color: #0f172a;
            color: white;
            padding: 10px;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
    </style>

    <div style="max-width: 850px; margin: 0 auto; display: flex; flex-direction: column; gap: 40px; padding: 20px 0;">
        
        <!-- Header Section -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 24px;">
                <div style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); border-radius: 20px; border: 1px solid rgba(16, 185, 129, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2.2rem;">
                    ✏️
                </div>
                <div>
                    <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -1px;">
                        Edit <span style="background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Complaint</span>
                    </h2>
                    <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 4px;">Update details for Complaint #{{ $complaint->id }}</p>
                </div>
            </div>
            
            <div style="padding: 12px 24px; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 100px; display: flex; align-items: center; gap: 10px;">
                <span style="width: 8px; height: 8px; background: #F59E0B; border-radius: 50%; box-shadow: 0 0 10px #F59E0B;"></span>
                <span style="color: #F59E0B; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Status: {{ ucfirst($complaint->status) }}</span>
            </div>
        </div>

        @if ($errors->any())
            <div style="padding: 20px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 16px; color: #fca5a5;">
                <ul style="list-style: disc inside; margin: 0; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="glass-panel float-animation">
            <form action="{{ route('farmer.complaint.update', $complaint->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 32px;">
                @csrf
                @method('PATCH')

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <!-- Issue Type -->
                    <div>
                        <label class="form-label">
                            <span style="color: #38BDF8; font-size: 1rem; margin-right: 6px;">🔧</span> Issue Category
                        </label>
                        <select name="complaint_type" required class="glass-field" style="cursor: pointer;">
                            <option value="no_electricity" {{ old('complaint_type', $complaint->issue_type) === 'no_electricity' ? 'selected' : '' }}>⚡ No Electricity</option>
                            <option value="low_voltage" {{ old('complaint_type', $complaint->issue_type) === 'low_voltage' ? 'selected' : '' }}>⚠️ Low Voltage</option>
                            <option value="transformer_issue" {{ old('complaint_type', $complaint->issue_type) === 'transformer_issue' ? 'selected' : '' }}>🔌 Transformer Problem</option>
                            <option value="line_fault" {{ old('complaint_type', $complaint->issue_type) === 'line_fault' ? 'selected' : '' }}>📡 Line Fault</option>
                            <option value="billing_issue" {{ old('complaint_type', $complaint->issue_type) === 'billing_issue' ? 'selected' : '' }}>💳 Billing Issue</option>
                            <option value="meter_problem" {{ old('complaint_type', $complaint->issue_type) === 'meter_problem' ? 'selected' : '' }}>📟 Meter Problem</option>
                            <option value="other" {{ old('complaint_type', $complaint->issue_type) === 'other' ? 'selected' : '' }}>❓ Other Issue</option>
                        </select>
                    </div>

                    <!-- Priority -->
                    <div>
                        <label class="form-label">
                            <span style="color: #F59E0B; font-size: 1rem; margin-right: 6px;">⚡</span> Priority Level
                        </label>
                        <select name="priority" required class="glass-field" style="cursor: pointer;">
                            <option value="low" {{ old('priority', $complaint->priority) === 'low' ? 'selected' : '' }}>Routine Support</option>
                            <option value="medium" {{ old('priority', $complaint->priority) === 'medium' ? 'selected' : '' }}>Standard Response</option>
                            <option value="high" {{ old('priority', $complaint->priority) === 'high' ? 'selected' : '' }}>Urgent Intervention</option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="form-label">
                        <span style="color: #10B981; font-size: 1rem; margin-right: 6px;">📝</span> Technical Description
                    </label>
                    <textarea name="description" rows="6" class="glass-field" required style="resize: none;" 
                        placeholder="Please describe the issue in detail...">{{ old('description', $complaint->description) }}</textarea>
                </div>

                <!-- Footer -->
                <div style="margin-top: 20px; padding-top: 40px; border-top: 1px solid rgba(56, 189, 248, 0.1); display: flex; align-items: center; justify-content: space-between;">
                    <a href="{{ route('farmer.complaints') }}" class="btn-cancel">
                        <span>←</span> Cancel Changes
                    </a>

                    <button type="submit" class="btn-submit">
                        Update Request 💾
                    </button>
                </div>
            </form>
        </div>

        <div style="padding: 24px; background: rgba(56, 189, 248, 0.03); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="font-size: 2rem;">💡</div>
            <p style="color: #64748b; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                <strong style="color: #f1f5f9;">Note:</strong> You can only edit complaints while they are in <span style="color: #F59E0B; font-weight: 800;">Pending</span> status. Once a technician is assigned or the issue is resolved, modifications are restricted.
            </p>
        </div>
    </div>
@endsection
