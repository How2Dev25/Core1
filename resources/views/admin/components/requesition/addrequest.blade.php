<!-- DaisyUI + Tailwind CSS required -->
<!-- Manpower Requisition Modal (Hotel to HR) -->
<dialog id="manpowerModal" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">

        <!-- REAL FORM START -->
        <form id="manpowerForm" method="POST" action="/requestEmployee" class="space-y-4">
            @csrf
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                onclick="manpowerModal.close()">✕</button>

            <h3 class="font-bold text-lg text-primary">Manpower Requisition Form</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label"><span class="label-text">Position Requested</span></label>
                    <div class="flex gap-2">
                        <select name="position" class="select select-bordered flex-1" id="positionSelect" required>
                            <option disabled selected>Select position</option>
                            <option>Receptionist</option>
                            <option>Hotel Manager</option>
                            <option>Material Custodian</option>
                            <option>Room Manager</option>
                            <option>Maintenance Staff</option>
                            <option>Hotel Inventory Manager</option>
                            <option>Room Attendant</option>
                            <option>Guest Relationship Head</option>
                        </select>
                        <button type="button" class="btn btn-outline btn-primary"
                            onclick="addPositionModal.showModal()">+ Add</button>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Number of Personnel</span></label>
                    <input name="quantity" type="number" min="1" class="input input-bordered" required />
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Employment Type</span></label>
                    <select name="employment_type" class="select select-bordered" required>
                        <option>Regular</option>
                        <option>Probationary</option>
                        <option>Contractual</option>
                        <option>On-call / Reliever</option>
                    </select>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text">Preferred Shift</span></label>
                    <select name="shift" class="select select-bordered" required>
                        <option>Morning</option>
                        <option>Mid</option>
                        <option>Night</option>
                        <option>Rotational</option>
                    </select>
                </div>
            </div>

            <!-- Reason for Request -->
            <div class="form-control mt-2">
                <label class="label"><span class="label-text">Reason for Request</span></label>
                <select name="reason" id="reasonSelect" class="select select-bordered" required>
                    <option value="" disabled selected>Select reason</option>
                    <option value="Insufficient Manpower">Insufficient Manpower</option>
                    <option value="High occupancy / peak season">High occupancy / peak season</option>
                    <option value="Replacement (Resigned)">Replacement (Resigned)</option>
                    <option value="Replacement (AWOL)">Replacement (AWOL)</option>
                    <option value="Special Event">Special Event</option>
                    <option value="Other">Other</option>
                </select>
            </div>

        <div class="form-control mt-2 hidden" id="otherReasonContainer">
            <label class="label"><span class="label-text">Please specify</span></label>
            <textarea id="otherReason" name="reason" class="textarea textarea-bordered" placeholder="Enter reason"></textarea>
        </div>

            <!-- Modal Actions -->
            <div class="modal-action mt-4 justify-end gap-2">
                <button type="button" class="btn btn-outline" onclick="manpowerModal.close()">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </div>

        </form>
        <!-- REAL FORM END -->

    </div>
</dialog>

<!-- Add Position Modal -->
<dialog id="addPositionModal" class="modal">
    <div class="modal-box max-w-md">

        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
            onclick="addPositionModal.close()">✕</button>

        <h3 class="font-bold text-lg text-primary mb-4">Add New Position</h3>

        <div class="form-control">
            <label class="label"><span class="label-text">Position Name</span></label>
            <input type="text" id="newPositionInput" placeholder="e.g. Barista" class="input input-bordered" />
        </div>

        <div class="modal-action justify-end gap-2">
            <button class="btn btn-outline" onclick="addPositionModal.close()">Cancel</button>
            <button class="btn btn-primary" type="button" onclick="addPosition()">Add</button>
        </div>

    </div>
</dialog>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Reason "Other" logic
        const reasonSelect = document.getElementById('reasonSelect');
        const otherContainer = document.getElementById('otherReasonContainer');
        const otherReasonInput = document.getElementById('otherReason');
        const form = reasonSelect.closest('form');

        reasonSelect.addEventListener('change', function () {
            if (this.value === 'Other') {
                otherContainer.classList.remove('hidden');
                otherReasonInput.required = true;
                reasonSelect.removeAttribute('name'); // remove select name to avoid conflict
            } else {
                otherContainer.classList.add('hidden');
                otherReasonInput.required = false;
                reasonSelect.setAttribute('name', 'reason'); // restore select name
            }
        });

        form.addEventListener('submit', function () {
            if (!otherContainer.classList.contains('hidden')) {
                // If Other is selected, make sure textarea has name="reason"
                otherReasonInput.setAttribute('name', 'reason');
            }
        });

        // Add position logic
        const positionSelect = document.getElementById('positionSelect');
        const newPositionInput = document.getElementById('newPositionInput');

        function addPosition() {
            const positionName = newPositionInput.value.trim();
            if (!positionName) {
                alert('Please enter a position name.');
                return;
            }
            const exists = Array.from(positionSelect.options).some(opt => opt.value.toLowerCase() === positionName.toLowerCase());
            if (exists) {
                alert('Position already exists.');
                return;
            }

            const option = document.createElement('option');
            option.value = positionName;
            option.textContent = positionName;
            option.selected = true;
            positionSelect.appendChild(option);

            newPositionInput.value = '';
            addPositionModal.close();
        }

        newPositionInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addPosition();
            }
        });

        window.addPosition = addPosition; // expose globally
    });
</script>