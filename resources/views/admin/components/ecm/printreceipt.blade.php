<dialog id="print_receipt_{{$reservation->eventbookingID}}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Generate Receipt</h3>
        <p class="py-4">Are you sure you want to generate a receipt for this reservation?
        </p>
        <div class="modal-action">
            <!-- Cancel button -->
            <form method="dialog">
                <button class="btn">Cancel</button>
            </form>
            <!-- Confirm button -->
            <a href="/printeventreceipt/{{$reservation->eventbookingID}}" target="_blank" class="btn btn-primary"
                style="background-color: #001f54; color: white;">
                Yes, Generate
            </a>
        </div>
    </div>
</dialog>