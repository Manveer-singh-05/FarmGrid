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

        .glass-panel {
            background: rgba(20, 35, 60, 0.4); 
            backdrop-filter: blur(25px); 
            border: 1px solid rgba(56, 189, 248, 0.3); 
            border-radius: 32px; 
            padding: 48px; 
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.5);
            max-width: 700px;
            margin: 20px auto;
        }

        .glass-field {
            background: rgba(2, 6, 23, 0.4);
            border: 1px solid rgba(56, 189, 248, 0.2);
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
            transform: scale(1.01);
        }
        .glass-field::placeholder {
            color: rgba(148, 163, 184, 0.5);
        }

        .field-label {
            display: block;
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 8px;
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

        .error-card {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 16px;
            padding: 16px 24px;
            color: #EF4444;
            margin-bottom: 32px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        /* Time picker styling hack for dark theme */
        input[type="time"]::-webkit-calendar-picker-indicator {
            filter: invert(0.8) sepia(100%) saturate(500%) hue-rotate(180deg);
            cursor: pointer;
        }
    </style>

    <div style="display: flex; flex-direction: column; gap: 40px; padding: 10px 0;">
        <!-- Header Hero Section -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div class="pulse-glow" style="width: 64px; height: 64px; background: rgba(56, 189, 248, 0.1); border-radius: 20px; border: 1px solid rgba(56, 189, 248, 0.3); display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    ✏️
                </div>
                <div>
                    <h2 style="font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0; letter-spacing: -0.5px;">
                        Edit <span style="background: linear-gradient(135deg, #38BDF8 0%, #10B981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Schedule</span>
                    </h2>
                    <p style="color: #94a3b8; font-size: 1.1rem; margin-top: 4px;">Modifying grid parameters for <strong>{{ $schedule->zone }}</strong></p>
                </div>
            </div>
            
            <a href="{{ route('admin.schedules') }}" 
               style="padding: 12px 24px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; color: #cbd5e1; font-weight: 700; text-decoration: none; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px;"
               onmouseover="this.style.background='rgba(255,255,255,0.08)'; this.style.transform='translateX(-5px)'"
               onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.transform='translateX(0)'">
                <span>←</span> Back to Monitor
            </a>
        </div>

        @if ($errors->any())
            <div class="error-card">
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    @foreach ($errors->all() as $error)
                        <li style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 1.2rem;">⚠️</span> {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Form Panel -->
        <div class="glass-panel float-animation">
            <form action="{{ route('admin.schedule.update', $schedule->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 32px;">
                @csrf
                @method('PATCH')

                <!-- Farmer Connection (Optional) -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="farmer_id" class="field-label">
                        <span style="color: #F59E0B;">👤</span> Linked Farmer Connection (Optional)
                    </label>
                    <select id="farmer_id" name="farmer_id" class="glass-field">
                        <option value="">-- Universal Zone Schedule --</option>
                        @foreach($farmers as $farmer)
                            <option value="{{ $farmer->id }}" {{ old('farmer_id', $schedule->farmer_id) == $farmer->id ? 'selected' : '' }}>
                                {{ $farmer->user->name }} - {{ $farmer->connection_no }} ({{ $farmer->village }})
                            </option>
                        @endforeach
                    </select>
                    @error('farmer_id')
                        <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Zone Name -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="zone" class="field-label">
                        <span style="color: #38BDF8;">🛰️</span> Target Grid Zone
                    </label>
                    <input type="text" id="zone" name="zone" value="{{ old('zone', $schedule->zone) }}"
                           placeholder="e.g. Northern District - Sector A"
                           class="glass-field @error('zone') border-red-500/50 @enderror"
                           required>
                    @error('zone')
                        <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Timings & Details Row -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="start_time" class="field-label">
                            <span style="color: #10B981;">🏁</span> Initiation Time
                        </label>
                        <input type="time" id="start_time" name="start_time" 
                               value="{{ old('start_time', \Carbon\Carbon::parse($schedule->start_time)->format('H:i')) }}"
                               class="glass-field @error('start_time') border-red-500/50 @enderror"
                               required>
                        @error('start_time')
                            <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="end_time" class="field-label">
                            <span style="color: #EF4444;">🛑</span> Termination Time
                        </label>
                        <input type="time" id="end_time" name="end_time" 
                               value="{{ old('end_time', \Carbon\Carbon::parse($schedule->end_time)->format('H:i')) }}"
                               class="glass-field @error('end_time') border-red-500/50 @enderror"
                               required>
                        @error('end_time')
                            <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="day_of_week" class="field-label">
                            <span style="color: #A855F7;">📅</span> Active Day
                        </label>
                        <select id="day_of_week" name="day_of_week" class="glass-field">
                            @foreach(['Daily', 'Weekdays', 'Weekends', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                <option value="{{ $day }}" {{ old('day_of_week', $schedule->day_of_week) == $day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="allocation_percentage" class="field-label">
                            <span style="color: #3B82F6;">📊</span> Allocation (%)
                        </label>
                        <input type="number" id="allocation_percentage" name="allocation_percentage" 
                               value="{{ old('allocation_percentage', $schedule->allocation_percentage) }}"
                               min="0" max="100" class="glass-field" required>
                    </div>
                </div>

                <!-- Status Selection -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="status" class="field-label">
                        <span style="color: #10B981;">🔄</span> Grid Operation Status
                    </label>
                    <select id="status" name="status" class="glass-field @error('status') border-red-500/50 @enderror" required>
                        <option value="active" {{ old('status', $schedule->status) === 'active' ? 'selected' : '' }}>✅ Operational / Active</option>
                        <option value="inactive" {{ old('status', $schedule->status) === 'inactive' ? 'selected' : '' }}>⛔ Suspended / Inactive</option>
                        <option value="maintenance" {{ old('status', $schedule->status) === 'maintenance' ? 'selected' : '' }}>🔧 Maintenance Mode</option>
                    </select>
                    @error('status')
                        <p style="color: #EF4444; font-size: 0.8rem; font-weight: 600; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label for="description" class="field-label">
                        <span style="color: #F59E0B;">📝</span> System parameters / Notes
                    </label>
                    <textarea id="description" name="description" rows="4"
                              placeholder="Specify maintenance notes or specific load parameters for this schedule..."
                              class="glass-field" style="resize: none;">{{ old('description', $schedule->description) }}</textarea>
                </div>

                <!-- Actions -->
                <div style="display: flex; align-items: center; gap: 20px; margin-top: 10px;">
                    <button type="submit" class="btn-shine"
                            style="flex: 2; padding: 18px; background: linear-gradient(135deg, #10B981 0%, #38BDF8 100%); color: white; border: none; border-radius: 18px; font-weight: 800; font-size: 1.1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(56, 189, 248, 0.2);"
                            onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 30px rgba(56, 189, 248, 0.4)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(56, 189, 248, 0.2)'">
                        Update Parameters
                    </button>
                    
                    <a href="{{ route('admin.schedules') }}" 
                       style="flex: 1; padding: 18px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 18px; color: #94a3b8; font-weight: 700; text-decoration: none; text-align: center; transition: all 0.3s ease;"
                       onmouseover="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.color='#EF4444'; this.style.borderColor='rgba(239, 68, 68, 0.2)'"
                       onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='#94a3b8'; this.style.borderColor='rgba(255,255,255,0.1)'">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Diagnostic Note -->
        <div style="max-width: 700px; margin: 0 auto; padding: 20px; background: rgba(56, 189, 248, 0.03); border: 1px dashed rgba(56, 189, 248, 0.2); border-radius: 20px; display: flex; align-items: center; gap: 16px;">
            <div style="font-size: 1.5rem;">🛡️</div>
            <p style="color: #64748b; font-size: 0.85rem; line-height: 1.5; margin: 0;">
                <strong style="color: #38BDF8;">Security Protocol:</strong> All modifications to grid schedules are logged and audited. Updated parameters will propagate to the specified zone immediately upon saving.
            </p>
        </div>
    </div>
@endsection
