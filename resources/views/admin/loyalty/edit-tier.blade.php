@extends('admin.layouts.app')

@section('title', 'Edit Membership Tier')

@section('content')
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                     
                        Edit Membership Tier: {{ $tier->tier_name }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.loyalty.tiers.update', $tier) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="food_discount" class="form-label">Food Discount (%) *</label>
                                    <input type="number" class="form-control" id="food_discount" name="food_discount" 
                                           value="{{ $tier->food_discount }}" min="0" max="100" step="0.01" required>
                                    <small class="text-muted">Percentage discount on food orders</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="room_discount" class="form-label">Room Discount (%) *</label>
                                    <input type="number" class="form-control" id="room_discount" name="room_discount" 
                                           value="{{ $tier->room_discount }}" min="0" max="100" step="0.01" required>
                                    <small class="text-muted">Percentage discount on room bookings</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="points_multiplier" class="form-label">Points Multiplier *</label>
                                    <input type="number" class="form-control" id="points_multiplier" name="points_multiplier" 
                                           value="{{ $tier->points_multiplier }}" min="0.1" max="10" step="0.1" required>
                                    <small class="text-muted">Points earned per ₱1 spent (1x = 1 point per ₱1)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="bonus_points" class="form-label">Bonus Points *</label>
                                    <input type="number" class="form-control" id="bonus_points" name="bonus_points" 
                                           value="{{ $tier->bonus_points }}" min="0" required>
                                    <small class="text-muted">Bonus points awarded on tier upgrade</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Additional Benefits</label>
                            <div id="benefits-container">
                                @foreach($tier->benefits ?? [] as $benefit)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="benefits[]" value="{{ $benefit }}" placeholder="Enter benefit">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeBenefit(this)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                @endforeach
                                @if(empty($tier->benefits))
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="benefits[]" placeholder="Enter benefit">
                                        <button type="button" class="btn btn-outline-secondary" onclick="addBenefit()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            @if(!empty($tier->benefits))
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addBenefit()">
                                    <i class="fas fa-plus me-1"></i> Add Benefit
                                </button>
                            @endif
                        </div>

                        <!-- Tier Information (Read-only) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Minimum Points Required</label>
                                    <input type="text" class="form-control" value="{{ number_format($tier->min_points) }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Minimum Spending Required</label>
                                    <input type="text" class="form-control" value="₱{{ number_format($tier->min_spent, 2) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.loyalty.tiers') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Tier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function addBenefit() {
    const container = document.getElementById('benefits-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="benefits[]" placeholder="Enter benefit">
        <button type="button" class="btn btn-outline-danger" onclick="removeBenefit(this)">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeBenefit(button) {
    button.parentElement.remove();
}
</script>
@endsection
