<dialog id="update_listing_{{$channel->channelID}}" class="modal">
  <div class="modal-box max-w-4xl">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-2xl font-bold flex items-center gap-2">
        <i data-lucide="pencil" class="w-6 h-6 text-primary"></i>
        Update Room Listing
      </h3>
      <form method="dialog">
        <button class="btn btn-circle btn-ghost btn-sm">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </form>
    </div>

    <form action="/updatelisting/{{$channel->channelID}}" method="POST">
      @csrf
      @method('PUT')


      <div class="card bg-base-100 shadow-md mb-6">
        <figure class="relative h-48 overflow-hidden rounded-t-box">
          <img src="{{ asset($channel->roomphoto) }}" class="w-full h-full object-cover" alt="Room image">
        </figure>

        <div class="card-body p-4">
          <div class="flex justify-between items-center mb-2">
            <h2 class="card-title text-sm">
              Room #{{ $channel->roomID }} {{ $channel->roomtype ?? '' }}
            </h2>
            <span class="badge badge-primary badge-sm">
              {{ $channel->roomstatus ?? 'Active' }}
            </span>
          </div>
          <div class="flex items-center gap-1 text-xs text-base-content/60">
            <i data-lucide="square" class="w-3 h-3"></i>
            <span>{{ $channel->roomsize ?? '—' }} sq.ft</span>
            <i data-lucide="users" class="w-3 h-3 ml-2"></i>
            <span>{{ $channel->roommaxguest ?? '—' }} Guests</span>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="form-control">
          <label class="label">
            <span class="label-text flex items-center gap-1">
              <i data-lucide="globe" class="w-4 h-4"></i>
              Channel
              <span class="text-error">*</span>
            </span>
          </label>
          <select name="channelListingID" class="select select-bordered w-full" required>
            <option disabled>Select a Channel</option>
            @foreach ($channelListing as $listings)
              <option value="{{ $listings->channelListingID }}" {{ $listings->channelListingID == $channel->channelListingID ? 'selected' : '' }}>
                {{ $listings->channelName }}
              </option>
            @endforeach

          </select>
        </div>
      </div>

      <div class="modal-action">
        <button onclick="update_listing_{{$channel->channelID}}.close()" type="button" class="btn btn-ghost btn-sm">
          Cancel
        </button>
        <button type="submit" class="btn btn-primary btn-sm gap-2">
          <i data-lucide="save" class="w-4 h-4"></i>
          Update Listing
        </button>
      </div>
    </form>
  </div>

  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>