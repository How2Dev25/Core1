<dialog id="expire_reward_{{$points->loyaltyID}}" class="modal">
  <div class="modal-box max-w-md">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <i data-lucide="x" class="w-4 h-4"></i>
      </button>
    </form>

    <h3 class="text-lg font-bold text-warning mb-4 flex items-center gap-2">
      <i data-lucide="trash-2" class="w-5 h-5"></i>
      Confirm Changes
    </h3>

    <p class="mb-6 text-sm text-gray-700">Are you sure you want this Loyaty Reward  <span class="font-bold">{{$points->loyaltyID}} for Room {{$points->roomID}} {{$points->roomtype}} to be Expired?</span> This action cannot be undone.</p>

    <form  method="POST" action="/expirelar/{{$points->loyaltyID}}">
      @csrf
      @method('PUT')
      <div class="modal-action">
        <button  type="button" onclick="expire_reward_{{$points->loyaltyID}}.close()" class="btn btn-ghost">Cancel</button>
        <button  type="submit" class="btn btn-warning">
          <i data-lucide="trash" class="w-4 h-4 mr-1"></i>
          Change to Expired
        </button>
      </div>
    </form>
  </div>

  <!-- Click outside to close -->
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
